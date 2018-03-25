@extends('layouts.app')

@section('title', 'Reinicio contraseña')

@section('body-class', 'product-page')

@section('content')
<div class="header header-filter" style="background-image: url('/img/m1.jpg');"></div>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Solicitud de reinicio de contraseña</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($errors->has('email'))
                        <div class="alert alert-danger">
                            {{ $errors->first('email') }}
                        </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}
                        
                        
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="form-group label-floating">
                                    <span class="input-group-addon">
                                        <i class="material-icons">email</i>
                                    </span>
                                </div>
                            </div>

                            <div class="col-sm-10">
                                <div class="form-group label-floating">
                                    <input placeholder="Email..." id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                </div>
                            </div>

                            
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Reiniciar contraseña
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('includes.footer')

@endsection
