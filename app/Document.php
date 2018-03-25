<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    //$document->course
    public function course(){
    	return $this->belongsTo(Course::class);
    }
}
