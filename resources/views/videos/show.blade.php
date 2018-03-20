@extends('layouts.app')

@section('title', 'App Shop | Reproduccion')

@section('body-class', 'product-page')

@section('content')
<div class="header header-filter" style="background-image: url('/img/m1.jpg');">
</div>

<div class="main main-raised">
    <div class="container">

        <div class="section ">
            <h2 class="title text-center">{{ $video->tittle }}</h2>

            @if (session('notification'))
                <div class="alert alert-success">
                    {{ session('notification') }}
                </div>
            @endif

            <div style="text-align:center;">
        		<video width="720" height="480" controls controlsList="nodownload" poster="{{ url('/img/city.jpg') }}">
		    		<source src="{{ $url }}" type="video/mp4">
				</video>
            </div>

        </div>

    </div>

</div>

@include('includes.footer')

@endsection