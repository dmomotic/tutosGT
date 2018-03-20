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
            <div class="col-md-6">
                <h1 class="title">Bienvenido a TutosGT</h1>
                <h4>Refuerza tus conocimientos con los mejores tutores de matematica</h4>
                <br />
                <a target=”_blank” href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" class="btn btn-success btn-raised btn-lg col-md-6">
                    <i class="fa fa-play"></i> Como funciona?
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
                    <h2 class="title">Por que TutosGT?</h2>
                    <h5 class="description">Puedes registrate completamente gratis y tendras acceso inmediato a una cantidad limitada de problemas resueltos, en ningun momento estaras comprometido a realizar ningun pago a menos que tu lo decidas y desees tener accesos ilimitado a todos los videos.</h5>
                </div>
            </div>

            <div class="features">
                <div class="row">
                    <div class="col-md-4">
                        <div class="info">
                            <div class="icon icon-primary">
                                <i class="material-icons">chat</i>
                            </div>
                            <h4 class="info-title">Atendemos tus dudas</h4>
                            <p>Atendemos rapidamente cualquier consulta que tengas via chat. No estas solo, sino que siempre estamos atentos a tus inquietudes.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info">
                            <div class="icon icon-success">
                                <i class="material-icons">verified_user</i>
                            </div>
                            <h4 class="info-title">Pago seguro</h4>
                            <p>No solicitamos tarjetas de credito ni debito, puedes efecutar tu pago con deposito bancario.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info">
                            <div class="icon icon-danger">
                                <i class="material-icons">fingerprint</i>
                            </div>
                            <h4 class="info-title">Informacion privada</h4>
                            <p>Los pedidos que realices solo los conoceras tu a traves de tu panel de usuario. Nadie mas tiene acceso a esta informacion.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

@include('includes.footer')

@endsection
