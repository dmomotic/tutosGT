<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Access;
use App\Membership;
use Carbon\Carbon;



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
            $notification = 'Ocurrio un error durante la validacion, es probable que su cuenta ya este validada o el codigo es incorrecto';
            return redirect('/')->with(compact('notification'));
        }

        $user->confirmed = true;
        $user->confirmation_code = null;
        $user->save();

        return redirect('/users/profile')->with('notification', 'Has confirmado correctamente tu correo!');
    }
}
