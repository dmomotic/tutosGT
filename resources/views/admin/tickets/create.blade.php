@extends('layouts.app')

@section('title', 'Registro de Boletas')

@section('body-class', 'product-page')

@section('content')
<div class="header header-filter" style="background-image: url('/img/m1.jpg');">
</div>

<div class="main main-raised">
    <div class="container">

        <div class="section ">
            <h2 class="title text-center">Registrar Boleta</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('notification'))
                <div class="alert alert-success">
                    {{ session('notification') }}
                </div>
            @endif

            @if (session('access_codes'))
                <div class="alert alert-success">
                    {{ session('access_codes') }}
                </div>
            @endif
            
            <form method="post" action="{{ url('/admin/tickets') }}">
                {{ csrf_field() }}


                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group label-floating">
                            <label class="control-label">Fecha de pago</label>
                            <!-- markup -->
                            <input class="datepicker form-control" type="text" value="" name="payday" data-date-format="yyyy-mm-dd"/>

                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group label-floating">
                            <label class="control-label">Numero de Boleta</label>
                            <input type="text" class="form-control" name="number">
                        </div>
                    </div>
                </div>      

                 <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group label-floating">
                            <label class="control-label">Banco</label>
                            <select name="bank" id="bank" >
                                @foreach ($enumoptions as $enumoption)                                
                                <option value="{{ $enumoption }}">{{ $enumoption }}</option>
                                @endforeach
                            </select> 
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group label-floating">
                            <label class="control-label">Monto depositado</label>
                            <input type="number" class="form-control" name="amount">
                        </div>
                    </div>
                </div>   


                <button type="submit" class="btn btn-primary btn-round">Registrar Boleta</button> 

            </form>

        </div>

    </div>

</div>

@include('includes.footer')

@endsection