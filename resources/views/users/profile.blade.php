@extends('layouts.app')

@section('title', 'Perfil')

@section('body-class', 'product-page')

@section('content')
<div class="header header-filter" style="background-image: url('/img/m1.jpg');">
</div>

<div class="main main-raised">
    <div class="container">

        <div class="section">
            <h2 class="title text-center">Datos Personales</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="row">
                <div class="form-group label-floating">
                    <div class="col-sm-6">
                        <i class="material-icons" style="font-size: 40px">face</i>
                        <span class="label label-default" style="font-size: 20px">{{ Auth::user()->name }}</span>
                    </div>

                    <div class="col-sm-6">
                        <i class="material-icons" style="font-size: 40px">email</i>
                        <span class="label label-default" style="font-size: 20px">{{ Auth::user()->email }}</span>
                    </div>
                </div>

                <div class="form-group label-floating">
                    <div class="col-sm-6">
                        <i class="material-icons" style="font-size: 40px">verified_user</i>
                        @if(Auth::user()->is_premium())
                            <span class="label label-default" style="font-size: 20px">Usuario con cuenta premium</span>
                        @elseif(Auth::user()->admin)
                            <span class="label label-default" style="font-size: 20px">Usuario administrador</span>
                        @else
                            <span class="label label-default" style="font-size: 20px">Usuario con cuentra gratuita</span>
                        @endif
                    </div>

                    <div class="col-sm-6">
                        @if(Auth::user()->is_premium())
                            <i class="material-icons" style="font-size: 40px">date_range</i>
                            <span class="label label-default" style="font-size: 20px">Premium hasta: {{ Auth::user()->premium_until() }}</span>
                        @endif
                    </div>
                </div>


            </div> 

        </div>

    </div>

</div>


@include('includes.footer')

@endsection