<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    public function getUrlAttribute(){
    	return 'https://tutosgt.nyc3.digitaloceanspaces.com/'.$this->source;
    }

    //$video->course
    public function course(){
    	return $this->belongsTo(Video::class);
    }
}
