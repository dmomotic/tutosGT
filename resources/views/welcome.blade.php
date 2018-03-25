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

@section('content')
<div class="header header-filter" style="background-image: url('/img/m1.jpg');">
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
        <div class="section text-center section-landing">

            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h2 class="text-center title">¿Por qué TutosGT?</h2>
                    <h5 class="description">Todo nuestro material ha sido elaborado en base a exámenes de admisión de la Universidad de San Carlos de Guatemala. Te enseñamos cómo se resuelven los problemas planteados correctamente y de una forma rápida.</h5>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h2 class="text-center title">¿Cómo funciona?</h2>
                    <h5 class="description">1.- Registrate para tener acceso a nuestro material, animate es completamente gratis.</h5>
                    <h5 class="description">2.- Estudia y repasa el contenido las veces que desees.</h5>
                    <h5 class="description">3.- Si en algun momento lo deseas puedes volverte usuario premium para obtener mayores beneficios.</h5>
                </div>
            </div>

            <div class="section landing-section">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h2 class="text-center title">Beneficios que brindamos</h2>
                        <img src="{{ url('/img/comparativa.jpg') }}" class="img-responsive" alt="Chania">  
                    </div>
                </div>
            </div>

            <div class="section landing-section">
                <h2 class="text-center title">Nuestras caracteristicas</h2>
                <div class="row">
                    <div class="col-md-4">
                        <div class="info">
                            <div class="icon icon-primary">
                                <i class="material-icons">chat</i>
                            </div>
                            <h4 class="info-title">Atendemos tus dudas</h4>
                            <p>Atendemos rápidamente cualquier consulta que tengas vía chat en nuestra página oficial de facebook. No estás solo, siempre estamos atentos a tus inquietudes.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info">
                            <div class="icon icon-success">
                                <i class="material-icons">verified_user</i>
                            </div>
                            <h4 class="info-title">Pago seguro</h4>
                            <p>Cuando desees tener acceso premium a nuestra plataforma nunca te solicitaremos tarjeta de credito ni debito, ya que manejaremos los pagos por medio de deposito bancario.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info">
                            <div class="icon icon-danger">
                                <i class="material-icons">important_devices</i>
                            </div>
                            <h4 class="info-title">Acceso multiplataforma</h4>
                            <p>Podrás acceder a nuestro sitio desde cualquier dispositivo que disponga de una conexión a internet.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <h5 class="description">
                    “Aprender es como remar contra corriente: en cuanto se deja, se retrocede.” - Edward Benjamin Britten.
                </h5>
            </div>

            
        </div>

    </div>


</div>

@include('includes.footer')

@endsection
