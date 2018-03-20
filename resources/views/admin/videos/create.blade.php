@extends('layouts.app')

@section('title', 'Bienvenido a App Shop')

@section('body-class', 'product-page')

@section('content')
<div class="header header-filter" style="background-image: url('/img/m1.jpg');">
</div>

<div class="main main-raised">
    <div class="container">

        <div class="section ">
            <h2 class="title text-center">Agregar nuevo video</h2>

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

            
            <form method="post" action="{{ url('/admin/videos') }}" enctype="multipart/form-data">
                {{ csrf_field() }}

                <input type="file" name="video" required>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group label-floating">
                            <label class="control-label">Titulo</label>
                            <input type="text" class="form-control" name="tittle" value="{{ old('tittle') }}">
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group label-floating">
                            <label class="control-label">Type</label>
                            <select name="type" id="type" >
                                @foreach ($enumoptions as $enumoption)                                
                                <option value="{{ $enumoption }}">{{ $enumoption }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group label-floating">
                            <label class="control-label">Curso</label>
                            <select name="course_id" id="course_id" >
                                @foreach ($courseoptions as $courseoption)                                
                                <option value="{{ $courseoption->id }}">{{ $courseoption->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>              

                <textarea class="form-control" placeholder="Descripcion" rows="5" name="description">{{ old('description') }}</textarea>

                <button type="submit" class="btn btn-primary btn-round">Agregar Video</button> 

            </form>

        </div>

    </div>

</div>

@include('includes.footer')

@endsection