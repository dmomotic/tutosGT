<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Document;
use App\Course;
use DB;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
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
        $enumoptions = $this->getEnumValues('documents','type');

        $courseoptions =Course::all();
        
        return view('admin.documents.create')
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
            'tittle.required' => 'Es necesario ingresar un titulo para el documento',
            'type.required' => 'Es necesario ingresar el tipo de documento',
            'description.required' => 'Es necesarion ingresar una descripcion para el documento',
            'file.file' => 'Es necesario subir un archivo',
            'course_id.required' => 'Es necesario indicar el curso al que pertenece el documento',
        ];

        $this->validate($request, $rules, $messages);

        $course = Course::find($request->input('course_id'));
        if(!$course){
            $alert = 'Ocurrio algun error durante la carga';
            return back()->with(compact('alert'));   
        }
        
        //Captura de datos
        $document = $request->file('document');
        
        $extension = $document->extension();
        if($extension != 'pdf'){
            $alert = 'Solo se permiten documentos con extension pdf';
            return back()->with(compact('alert'));
        }

        $folder = 'documents/free';
        if($request->input('type') == 'premium'){
            $folder = 'documents/premium';
        }

        $fileName = uniqid() . $document->getClientOriginalName();

        $folder = $folder.'/'.$course->name;

        //Carga del document hacia DigitalOcean
        $path = Storage::disk('do_spaces')->putFileAs($folder, $document, $fileName);

        //Creacion de registro en tabla documents
        if($path){
            $document = new Document();
            $document->tittle = $request->input('tittle');
            $document->course_id = $course->id;
            $document->uploaded_by = auth()->user()->id;
            $document->type = $request->input('type');
            $document->description = $request->input('description');
            $document->source = $path;
            $document->save();

            $success = 'Documento cargado correctamente';
            return back()->with(compact('success'));
        }

        $alert = 'Ocurrio algun error durante la carga';
        return back()->with(compact('alert'));        

    }
}
