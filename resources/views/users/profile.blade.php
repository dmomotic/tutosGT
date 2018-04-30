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

            @if (session('notification'))
                <div class="alert alert-success">
                    {{ session('notification') }}
                </div>
            @endif


            @if(!Auth::user()->confirmed)
                <div class="alert alert-danger">
                    Por favor valida tu cuenta de correo electronico
                </div>
                
                <h5>Si aun no has recibido el correo de confirmacion podemos enviarlo nuevamente a tu direccion de correo registrada o puedes cambiar la direccion haciendo clic en el boton modificar datos, recuerda revisar tu carpeta de spam.</h5>

                <div class="row">
                    <div class="form-group text-center">
                        <form method="post" action="{{ url('/users/new/verify') }}">
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-success btn-round">Enviar correo de confirmacion</button>    
                        </form>
                    </div>
                </div>
                    
            @endif

            <div class="row">
                <div class="form-group label-floating">
                    <div class="col-sm-6">
                        <i class="material-icons" style="font-size: 40px">face</i>
                        <span style="font-size: 20px">{{ Auth::user()->name }}</span>
                    </div>

                    <div class="col-sm-6">
                        <i class="material-icons" style="font-size: 40px">email</i>
                        <span style="font-size: 20px">{{ Auth::user()->email }}</span>
                    </div>
                </div>

                <div class="form-group label-floating">
                    <div class="col-sm-6">
                        <i class="material-icons" style="font-size: 40px">verified_user</i>
                        @if(Auth::user()->is_premium())
                            <span style="font-size: 20px">Usuario con cuenta premium</span>
                        @elseif(Auth::user()->admin)
                            <span style="font-size: 20px">Usuario administrador</span>
                        @else
                            <span style="font-size: 20px">Usuario con cuenta gratuita</span>
                        @endif
                    </div>

                    <div class="col-sm-6">
                        @if(Auth::user()->is_premium())
                            <i class="material-icons" style="font-size: 40px">date_range</i>
                            <span style="font-size: 20px">Premium hasta: {{ Auth::user()->premium_until() }}</span>
                        @endif
                    </div>
                </div>


            </div> 

            <!-- Button trigger modal -->
            <div class="form-group text-center">
                <button class="btn btn-success btn-round" data-toggle="modal" data-target="#modalUpdateProfile">
                    <i class="material-icons">autorenew</i> Modificar datos
                </button>
            </div>
            
        </div>

    </div>

</div>



<!-- Modal Core -->
<div class="modal fade" id="modalUpdateProfile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">ACTUALIZAR DATOS</h4>
      </div>
      <form method="post" action="{{ url('/users/profile') }}">
        {{ csrf_field() }}
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
          <div class="modal-body">
            <div class="form-group label-floating">
                <label class="control-label">Nombre</label>
                <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control">
            </div>

            <div class="form-group label-floating">
                <label class="control-label">Correo Electronico</label>
                <input type="email" name="email" value="{{ Auth::user()->email }}" class="form-control">
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default " data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-info ">Actualizar</button>
          </div>
      </form>
    </div>
  </div>
</div>

@include('includes.footer')

@endsection