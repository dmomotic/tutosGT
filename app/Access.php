<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Access extends Model
{
	protected $primaryKey = 'code';
	protected $keyType = 'string';

	public function is_used(){
		return $this->status;
	}

	//$access->membership
	public function membership(){
		return $this->belongsTo(Membership::class);
	}

}
