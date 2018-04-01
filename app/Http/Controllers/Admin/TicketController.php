<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ticket;
use App\Access;
use DB;

class TicketController extends Controller
{

	public function getEnumValues($table, $column) {
        $type = DB::select(DB::raw("SHOW COLUMNS FROM $table WHERE Field = '{$column}'"))[0]->Type ;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $enum = array();
        foreach( explode(',', $matches[1]) as $value )
        {
            $v = trim( $value, "'" );
            $enum = array_add($enum, $v, $v);
        }
        return $enum;
    }

    public function create(){
    	$enumoptions = $this->getEnumValues('tickets','bank');
    	return view('admin.tickets.create')
    			->with(compact('enumoptions'));
    }

    public function store(Request $request){

    	//mensajes
    	$messages = [
    		'payday.required' => 'Es necesario ingresar una fecha de deposito',
    		'number.required' => 'El numero de boleta es obligatorio',
    		'amount.required' => 'La cantidad es obligatoria',
    		'amount.numeric' => 'La cantidad debe ser un campo numerico',
    		'amount.min' => 'El precio debe ser mayor o igual a 150',
            'individual_price.required' => 'El precio por individuo es requerido',
            'individual_price.numeric' => 'El precio por individuo debe ser numerico',
            'number_of_people.required' => 'El numero de personas es requerido',
            'number_of_people.numeric' => 'El campo numero de personas debe ser numerico',
            'number_of_people.min' => 'El numero de personas debe ser mayor o igual a 1',
    	];

    	//validaciones
    	$rules = [
    		'payday' => 'required',
    		'number' => 'required',
    		'amount' => 'required|numeric|min:150',
            'individual_price' => 'required|numeric',
            'number_of_people' => 'required|numeric|min:1',
    	];

    	$this->validate($request, $rules, $messages);

        //Registro boletas
		$ticket = new Ticket();
		$ticket->payday = $request->input('payday');
		$ticket->number = $request->input('number');
		$ticket->bank = $request->input('bank');
		$ticket->amount = $request->input('amount');
        $ticket->number_of_people = $request->input('number_of_people');
        $ticket->individual_price = $request->input('individual_price');
        $ticket->user_id = auth()->user()->id;

		$ticket->save();
		
		$notification = 'Boleta registrada exitosamente ';

        //Generamos codigos de acceso
		$this->generateAccess($ticket->amount,$ticket->number,$ticket->id,$ticket->individual_price);

        //Capturo todos los accesses generados
        $accesses = $ticket->accesses();
        $access_codes = 'Codigos generados:';
        foreach($accesses as $access){
            $access_codes = $access_codes . ' ' .$access['code'];
        }

		return back()->with(compact('notification', 'access_codes')); //  admin/tickets
    }

    protected function generateAccess($amount, $ticketnumber, $ticketid, $individual_price){
        $quantity = intdiv($amount, $individual_price);
    	if($quantity > 0 ){
    		for($i=1; $i<=$quantity; $i++){
                $code = uniqid() . $ticketnumber;
    			$access = new Access();
    			$access->code = $code;
    			$access->ticket_id = $ticketid;
    			$access->description = 'Generacion automatica';
    			$access->save();
    		}
    	}
    }

    
}
