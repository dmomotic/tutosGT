@extends('layouts.app')

@section('title', 'Documentos Premium')

@section('body-class', 'profile-page')

@section('content')
<div class="header header-filter" style="background-image: url('/img/m1.jpg');"></div>

<div class="main main-raised">
    <div class="profile-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center" >
                    <h3>Puedes hacer clic en el título de los documentos para poder visualizarlos.</h3>
                </div>

                <div class="section">

                	<?php 
                		$cont = 1;
                	?>

                	@foreach ($documents as $document)
	                    <div class="col-md-12">
	                        <h3><a href="{{ url('/documents/math/premium/'.$document->id) }}" class="title" target="_blank"><?php echo $cont++; ?>.-  {{ $document->tittle }}</a></h3>
	                        <h5>{{ $document->description }}</h5>
                            <br>
	                    </div>
                    @endforeach
                    
                </div>
            </div>
            		
            

        </div>
    </div>
</div>

@include('includes.footer')

@endsection
