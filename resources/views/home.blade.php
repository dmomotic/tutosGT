@extends('layouts.app')

@section('title', 'TutosGT')

@section('body-class', 'product-page')

@section('content')
<div class="header header-filter" style="background-image: url('/img/m1.jpg');">
</div>

<div class="main main-raised">
    <div class="container">

        <div class="section ">
            <h2 class="title text-center">Bienvenido</h2>

            @if (session('notification'))
                <div class="alert alert-success">
                    <h5>{{ session('notification') }}</h5>
                </div>
            @endif

            @if(!Auth::user()->confirmed)
                <div class="alert alert-success">
                    <h5>Debe validar su correo electronico antes de continuar</h5>
                </div>
                <h5>
                    Hemos enviado a tu dirección de email: <b>{{ Auth::user()->email }}</b> un enlace al cual deberas dar clic para poder validar tu cuenta. Una vez validada tendras acceso de forma inmediata a todo nuestro material gratuito.
                </h5>
            @endif
            <h5>
                Cualquier duda, comentario, sugerencia o queja no dudes en contactarnos a través de nuestra <a href="https://www.facebook.com/tutosoficialgt/" target="_blank">página oficial de facebook</a> o escribenos a tutoriasgtoficial@gmail.com
            </h5>
        </div>

    </div>

</div>

@include('includes.footer')

@endsection