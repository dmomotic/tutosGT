<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    //$ticket->accesses
    public function accesses(){
    	return $this->hasMany(Access::class)->get()->toArray();
    }
}
