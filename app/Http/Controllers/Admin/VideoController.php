<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Video;
use App\Course;
use DB;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
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
        $enumoptions = $this->getEnumValues('videos','type');

        $courseoptions =Course::all();
        
        return view('admin.videos.create')
                ->with(compact('enumoptions', 'courseoptions'));
    }

    public function store(Request $request){

        //Validaciones
        $rules = [
            'tittle' => 'required',
            'type' => 'required',
            'description' => 'required',
            'file' => 'file',
            'course_id' => 'required',
        ];

        //Mensajes
        $messages = [
            'tittle.required' => 'Es necesario ingresar un titulo para el video',
            'type.required' => 'Es necesario ingresar el tipo de video',
            'description.required' => 'Es necesarion ingresar una descripcion para el video',
            'file.file' => 'Es necesario subir un archivo',
            'course_id.required' => 'Es necesario indicar el curso al que pertenece el video',
        ];

        $this->validate($request, $rules, $messages);

        $course = Course::find($request->input('course_id'));
        if(!$course){
            $alert = 'Ocurrio algun error durante la carga';
            return back()->with(compact('alert'));   
        }
        
        //Captura de datos
        $video = $request->file('video');
        
        $extension = $video->extension();
        if($extension != 'mp4'){
            $alert = 'Solo se permiten videos con extension mp4';
            return back()->with(compact('alert'));
        }

        $folder = 'free';
        if($request->input('type') == 'premium'){
            $folder = 'premium';
        }

        $fileName = uniqid() . $video->getClientOriginalName();

        $folder = $folder.'/'.$course->name;

        //Carga del video hacia DigitalOcean
        $path = Storage::disk('do_spaces')->putFileAs($folder, $video, $fileName);

        //Creacion de registro en tabla videos
        if($path){
            $video = new Video();
            $video->tittle = $request->input('tittle');
            $video->course_id = $course->id;
            $video->uploaded_by = auth()->user()->id;
            $video->type = $request->input('type');
            $video->description = $request->input('description');
            $video->source = $path;
            $video->save();

            $success = 'Video cargado correctamente';
            return back()->with(compact('success'));
        }

        $alert = 'Ocurrio algun error durante la carga';
        return back()->with(compact('alert'));        

    }
}
