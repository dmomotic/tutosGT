<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Video;
use App\Course;
use DB;
use Illuminate\Support\Facades\Storage;
use Thumbnail;

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

        //ini_set('memory_limit','1024M');

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

        $folder = 'videos/free';
        if($request->input('type') == 'premium'){
            $folder = 'videos/premium';
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

    public function createThumbnail()
    {
        $videos = Video::all(['id','tittle','type','source', 'thumbnail']);
        return view('admin.videos.thumbnail')->with(compact('videos'));
    }

    public function thumbnail(Request $request)
    {
        
        //Capturo datos del request
        $id = $request->input('id');
        $second = $request->input('second');

        $file_name = $id . '.jpg';
        $video = Video::find($id);

        //Si ya tiene miniatura la elimino para generar la nueva
        if($video->thumbnail != '')
        {
            if(\File::exists(public_path($video->thumbnail)))
            {
                \File::delete(public_path($video->thumbnail));
            }
        }

        //Genero los paths de origen y almacenamiento
        $url_source = Storage::disk('do_spaces')->temporaryUrl($video->source, now()->addMinutes(30));
        $path = '/files/thumbs/';

        //Genero miniatura
        $thumbnail_status = Thumbnail::getThumbnail($url_source,public_path($path),$file_name,$second);
        if($thumbnail_status)
        {
            $success = 'Se genero la miniatura correctamente';
            $video->thumbnail = $path.$file_name;
            $video->save();
            return back()->with(compact('success'));
        }

        //Error al generar miniatura
        $alert = 'Error al generar miniatura';
        return back()->with(compact('alert'));
    }
}
