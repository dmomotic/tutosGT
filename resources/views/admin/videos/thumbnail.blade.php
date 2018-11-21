@extends('layouts.app')

@section('title', 'Manejo miniaturas')

@section('content')
<div class="header header-filter" style="background-image: url('/img/m1.jpg');">
</div>

<div class="main main-raised">
    <div class="container">

        <div class="section ">
            <h2 class="title text-center">Administracion de miniaturas</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('alert'))
                <div class="alert alert-danger">
                    {{ session('alert') }}
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="table-responsive">
              <table class="table table-striped">
			    <thead>
			      <tr>
			        <th>ID</th>
			        <th>TITULO</th>
			        <th>TIPO</th>
			        <th>SOURCE</th>
			        <th>THUMB</th>
			        <th>OPCIONES</th>
			      </tr>
			    </thead>
			    <tbody>
			      @foreach($videos as $video)
			      	<form method="POST" id="form{{$video->id}}" action="{{ url('/admin/videos/thumbnails') }}">
			      		{{ csrf_field() }}
				      	<tr>
					        <td>{{ $video->id }}</td>
					        <td>{{ $video->tittle }}</td>
					        <td>{{ $video->type }}</td>
					        <td>{{ $video->source }}</td>
					        <td>
					        	@if($video->thumbnail != '')
					        		si
					        	@else
					        		no
					        	@endif
					        </td>
					        <td>
					        	<input type="number" name="second" class="form-control" required form="form{{$video->id}}"> 
					        </td>
					        <input type="hidden" name="id" value="{{ $video->id }}">
					        <input type="hidden" name="title" value="{{ $video->tittle }}">
					        <input type="hidden" name="type" value="{{ $video->type }}">
					        <input type="hidden" name="source" value="{{ $video->source }}">
					        <td><button type="submit" class="btn btn-primary">Generar</button></td>
					    </tr>
					</form>
			      @endforeach
			    </tbody>
			  </table>
			</div>
        </div>

    </div>

</div>

@include('includes.footer')

@endsection
