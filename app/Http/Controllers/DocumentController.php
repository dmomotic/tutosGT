<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Document;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function free(){
        $course = Course::where('name','Matematica')->first();
    	$documents = $course->documents()->where('type','free')->get();
    	return view('documents.free')
    			->with(compact('documents'));
    }

    public function showfree($id){
    	$document= Document::find($id);
    	if(!$document){
    		return 'Ocurrio un error al buscar el documento solicitado';
    	}

    	$file = Storage::disk('do_spaces')->get($document->source);

    	if(!$file){
    		return 'Ocurrio un error al buscar el documento solicitado';
    	}
    	
    	$headers = [
    		'Content-Type' => 'application/pdf',
    	];

    	return response($file,200,$headers);
    }

    public function premium(){
        $course = Course::where('name','Matematica')->first();
    	$documents = $course->documents()->where('type','premium')->get();
    	return view('documents.premium')
    			->with(compact('documents'));
    }

    public function showpremium($id){
    	$document= Document::find($id);
    	if(!$document){
    		return 'Ocurrio un error al buscar el documento solicitado';
    	}

    	$file = Storage::disk('do_spaces')->get($document->source);

    	if(!$file){
    		return 'Ocurrio un error al buscar el documento solicitado';
    	}
    	
    	$headers = [
    		'Content-Type' => 'application/pdf',
    	];

    	return response($file,200,$headers);
    }
}
