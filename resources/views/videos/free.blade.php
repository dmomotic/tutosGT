@extends('layouts.app')

@section('title', 'Videos Gratuitos')

@section('body-class', 'profile-page')

@section('content')
<div class="header header-filter" style="background-image: url('/img/m1.jpg');"></div>

<div class="main main-raised">
    <div class="profile-content">
        <div class="container">
            <div class="row">
                <div class="section">
                	<?php 
                		$cont = 1;
                	?>

                	@foreach ($videos as $video)
	                    <div class="row">
	                        <a href="{{ url('/videos/free/'.$video->id) }}" class="title"><?php echo $cont++; ?>.-  {{ $video->tittle }}</a>
	                        <h6>{{ $video->description }}</h6>
	                    </div>
                    @endforeach
                    
                </div>
            </div>
            		
            

        </div>
    </div>
</div>

@include('includes.footer')

@endsection
