@extends('layouts.app')

@section('title', 'Videos Gratuitos')

@section('body-class', 'profile-page')

@section('styles')
    <style>
        .team .row .col-md-4{
            margin-bottom: 3em;
        }
    </style>
@endsection

@section('content')
<div class="header header-filter" style="background-image: url('/img/m1.jpg');"></div>

<div class="main main-raised">
    <div class="profile-content">
        <div class="container-fluid content-row">
            <div class="row">

                <div class="col-md-12 text-center" >
                    <br>
                    <h2>Seccion de videos gratuitos de Matematica</h2>
                </div>
            </div>

            <div class="team">
                <div class="row">

                    @foreach ($videos as $video)
                    @if($video->thumbnail != '')
                        <div class="col-md-4 text-center">
                            <div class="team-player">
                                <img src="{{ $video->thumbnail }}" alt="Thumbnail Image" class="img-raised">
                                <h4 class="title">
                                    {{ $video->tittle }}
                                    <br>
                                    <a class="btn btn-primary" href="{{ url('/videos/free/'.$video->id) }} }}">ver video</a>
                                </h4>
                                <p class="desc">{{ $video->description }}</p>
                            </div>
                        </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@include('includes.footer')

@endsection
