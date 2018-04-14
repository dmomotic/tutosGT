@extends('layouts.app')

@section('title', 'Vuelvete Premium')

@section('body-class', 'product-page')

@section('content')
<div class="header header-filter" style="background-image: url('/img/m1.jpg');">
</div>

<div class="main main-raised">
    <div class="container">

        <div class="section ">
            <h2 class="title text-center">Vuelvete Premium</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('message'))
                <div class="alert alert-danger">
                    {{ session('message') }}
                </div>
            @endif

            <div class="container">
                <h5>Ingresa el código que te fue proporcionado para tener un acceso premium a nuestra plataforma. Si aún no tienes ningún código comunicate con nosotros a través de un mensaje en nuestra <a href="https://www.facebook.com/tutosoficialgt/" target="_blank">página de facebook</a> o escribe a nuestro correo tutoriasgtoficial@gmail.com y con gusto te indicaremos los pasos a seguir.</h5>
            </div>
            
            <form method="post" action="{{ url('/users/premium/' . auth()->user()->id ) }}" >
                {{ csrf_field() }}


                <div class="form-group label-floating">
                    <label class="control-label">Codigo de acceso</label>
                    <input type="text" class="form-control" name="access_code">
                </div>


                <button type="submit" class="btn btn-primary btn-round">Aceptar</button> 

            </form>

        </div>

    </div>

</div>

@include('includes.footer')

@endsection