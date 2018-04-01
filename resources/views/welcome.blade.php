@extends('layouts.app')

@section('title', 'Bienvenido a TutosGT')

@section('body-class', 'landing-page')

@section('styles')
    <style>
        .team .row .col-md-4{
            margin-bottom: 5em;
        }
        .row {
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display:         flex;
            flex-wrap: wrap;
        }
        .row > [class*='col-'] {
            display: flex;
            flex-direction: column;
        }

    </style>
@endsection

@section('begin')
    <li><a href="#begin_option">Inicio</a></li>
@endsection

@section('sliding_options')

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"
type="text/javascript" charset="utf-8"></script>

<script >
    $(function(){

     $('a[href*=#]').click(function() {

     if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'')
         && location.hostname == this.hostname) {

             var $target = $(this.hash);

             $target = $target.length && $target || $('[name=' + this.hash.slice(1) +']');

             if ($target.length) {

                 var targetOffset = $target.offset().top;

                 $('html,body').animate({scrollTop: targetOffset}, 1000);

                 return false;

            }

       }

   });

});
</script>

    <li><a href="#more_info_option">Informarción</a></li>
    <li><a href="#benefits_option">Beneficios</a></li>
    <li><a href="#characteristics_option">Características</a></li>

@endsection

@section('content')
<div class="header header-filter" style="background-image: url('/img/m1.jpg');" id="begin_option">
    <div class="container">
        <div class="row">
            @if (session('notification'))
                <div class="alert alert-success">
                    {{ session('notification') }}
                </div>
            @endif
            <div class="col-md-6">
                <h1 class="title">Bienvenido a TutosGT</h1>
                <h4>Refuerza tus conocimientos con los mejores tutores de matemática</h4>
                <br />
                <a target=”_blank” href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" class="btn btn-success btn-raised btn-lg col-md-6">
                    <i class="fa fa-play"></i> Guía rapida
                </a>
            </div>
        </div>
    </div>
</div>

<div class="main main-raised">
    <div class="container">
        <div class="section text-center section-landing" id="more_info_option">

            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h2 class="text-center title">¿Por qué TutosGT?</h2>
                    <h5 class="text">Todo nuestro material ha sido elaborado en base a exámenes de admisión de la Universidad de San Carlos de Guatemala. Te enseñamos la forma correcta y rápida de resolver los problemas planteados.</h5>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h2 class="text-center title">¿Cómo funciona?</h2>
                    <h5 class="text">1.- Debes registrarte en nuestra plataforma con tu nombre y correo electrónico. ¡Animate es completamente gratis!.</h5>
                    <h5 class="text">2.- Enviaremos a tu correo electrónico un enlace de confirmación. Deberás dar clic al enlace e inmediatamente tendrás acceso a todo nuestro material gratuito.</h5>
                    <h5 class="text">3.- Estudia y repasa nuestro material las veces que lo desees.</h5>
                    <h5 class="text">4.- Si en algún momento deseas tener acceso a material y beneficios adicionales, puedes solicitar tu membresía premium de 1 mes por Q 150.00 .</h5>
                    <h5 class="text">5.- Cualquier duda, comentario, queja o sugerencia puedes hacerla llegar a nuestra página oficial de facebook o al correo: tutoriasgtoficial@gmail.com y con mucho gusto te atenderemos.</h5>
                </div>
            </div>

            <div class="section landing-section" id="benefits_option">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h2 class="text-center title">Beneficios que brindamos</h2>
                        <img src="{{ url('/img/comparativa.jpg') }}" class="img-responsive" alt="Chania">  
                    </div>
                </div>
            </div>

            <div class="section landing-section" id="characteristics_option">
                <h2 class="text-center title">Nuestras caracteristicas</h2>
                <div class="row">
                    <div class="col-md-4">
                        <div class="info">
                            <div class="icon icon-primary">
                                <i class="material-icons">chat</i>
                            </div>
                            <h4 class="info-title">Atendemos tus dudas</h4>
                            <h4> <small>Atendemos rápidamente cualquier consulta que tengas vía chat en nuestra página oficial de facebook. No estás solo, siempre estamos atentos a tus inquietudes.</small></h4>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info">
                            <div class="icon icon-success">
                                <i class="material-icons">verified_user</i>
                            </div>
                            <h4 class="info-title">Pago seguro</h4>
                            <h4> <small> Cuando desees tener acceso premium a nuestra plataforma nunca te solicitaremos tarjeta de credito ni debito, ya que manejaremos los pagos por medio de deposito bancario.</small> </h4>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info">
                            <div class="icon icon-danger">
                                <i class="material-icons">important_devices</i>
                            </div>
                            <h4 class="info-title">Acceso multiplataforma</h4>
                            
                            <h4> <small> Podrás acceder a nuestro sitio desde cualquier dispositivo que disponga de una conexión a internet.</small></h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <h5 class="text">
                    “Aprender es como remar contra corriente: en cuanto se deja, se retrocede.” - Edward Benjamin Britten.
                </h5>
            </div>

        </div>

    </div>
</div>

@include('includes.footer')

@endsection
