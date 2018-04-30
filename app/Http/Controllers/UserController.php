<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Access;
use App\Membership;
use Carbon\Carbon;
use Illuminate\Mail\Mailable;
use Mail;


class UserController extends Controller
{
    public function index(){
    	return view('users.bepremium');
    }

    public function premium(Request $request, $id){

        //Validaciones
        $rules = [
            'access_code' => 'required',
        ];

        //Mensajes
        $messages = [
            'access_code.required' => 'Es necesario ingresar un codigo',
        ];

        $this->validate($request, $rules, $messages);

        //Verifico que el id recibido corresponda al usuario logueado
        if($id != auth()->user()->id){
            $message = 'Error al procesar su solicitud';
            return back()->with(compact('message'));
        }

        //Verifico si el usuario puede volverse premium
    	$user = User::find($id);
    	if($user->is_premium()){
            $message = 'No puede cambiar el codigo porque aun es un usuario premium hasta el '.$user->premium_until();
    		return back()->with(compact('message'));
    	}
    	
        //Buscamos el codigo ingresado
    	$access_code = $request->input('access_code');
        $access = Access::find($access_code);

        //Verificamos si ya fue utilizado el codigo anteriormente 
        if(!$access  || $access->is_used()){
            $message = 'El codigo que ingreso es incorrecto';
            return back()->with(compact('message'));
        }

        //Calculamos fecha de expiracion
        $valid_until = Carbon::now('America/Guatemala')->startOfDay()->addMonth();

        //Creamos membresia
        $membership = new Membership();
        $membership->user_id = $id;
        $membership->access_code = $access_code;
        $membership->last_day = $valid_until;
        $membership->save();

        //Actualizamos el access_code a utilizado
        $access->status = true;
        $access->save();

        $success = 'Codigo procesado exitosamente, ya es un usuario premium';
        return redirect('/users/profile')->with(compact('success'));

    }

    public function profile(){
        return view('users.profile');
    }

    public function verify($code){
        $user = User::where('confirmation_code', $code)->first();

        if (! $user){
            $notification = 'Tu cuenta ya se encuentra validada!';
            return redirect('/users/profile')->with(compact('notification'));
        }

        $user->confirmed = true;
        $user->confirmation_code = null;
        $user->save();

        $success = 'Has confirmado correctamente tu correo!';
        return redirect('/users/profile')->with(compact('success'));
    }

    public function update(Request $request){
        //Validaciones
        $rules = [
            'user_id' => 'required',
            'name' => 'required',
            'email' => 'required',
        ];

        //Mensajes
        $messages = [
            'user_id.required' => 'Error al procesar la actualizacion',
            'name.required' => 'El nombre es requerido en la actualizacion de datos',
            'email.required' => 'El correo es requerido en la actualizacion de datos',
        ];

        $this->validate($request, $rules, $messages);

        //Actualizacion
        $user = User::find($request->input('user_id'));
        if(!$user){
            $notification = 'Error al procesar la actualizacion';
            return redirect('/users/profile')->with(compact('notification'));
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        $success = 'Datos actualizados correctamente';
        return redirect('/users/profile')->with(compact('success'));
    }

    public function new_verify(Request $request){
        $user = User::find($request->input('user_id'));

        if($user->confirmed){
            $success = 'Su cuenta ya ha sido validada!';
            return redirect('/users/profile')->with(compact('success'));
        }

        $data = array(
            'name' => $user->name,
            'confirmation_code' => $user->confirmation_code,
            'email' => $user->email,
            'name' => $user->name,
        );

        Mail::send('emails.confirmation_code', $data, function($message) use ($data) {
                    $message->to($data['email'], $data['name'])->subject('Por favor confirma tu correo');
                });

        $success = 'Hemos enviado nuevamente el correo de confirmacion!';
        return redirect('/users/profile')->with(compact('success'));
    }
}
