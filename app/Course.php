<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //$course->videos
    public function videos(){
    	return $this->hasMany(Video::class);
    }

    //$course->documents
    public function documents(){
    	return $this->hasMany(Document::class);
    }
}
