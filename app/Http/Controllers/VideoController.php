<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Video;
use App\Course;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    //Videos de Matematica
    public function free(){
        $course = Course::where('name','Matematica')->first();
    	$videos = $course->videos()->where('type','free')->get();
    	return view('videos.free')
    			->with(compact('videos'));
    }

    public function showfree($id){
    	$video= Video::find($id);
    	$url = Storage::disk('do_spaces')->temporaryUrl($video->source, now()->addMinutes(10));
        return view('videos.show')
    			->with(compact('url', 'video'));
    }

    public function premium(){
        $course = Course::where('name','Matematica')->first();
        $videos = $course->videos()->where('type','premium')->get();
        return view('videos.premium')
                ->with(compact('videos'));    
    }

    public function showpremium($id){
        $video= Video::find($id);
        $url = Storage::disk('do_spaces')->temporaryUrl($video->source, now()->addMinutes(10));
        return view('videos.show')
                ->with(compact('url', 'video'));
    }
}
