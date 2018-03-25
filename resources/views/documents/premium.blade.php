@extends('layouts.app')

@section('title', 'Documentos Premium')

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

                	@foreach ($documents as $document)
	                    <div class="row">
	                        <a href="{{ url('/documents/math/premium/'.$document->id) }}" class="title" target="_blank"><?php echo $cont++; ?>.-  {{ $document->tittle }}</a>
	                        <h6>{{ $document->description }}</h6>
	                    </div>
                    @endforeach
                    
                </div>
            </div>
            		
            

        </div>
    </div>
</div>

@include('includes.footer')

@endsection
