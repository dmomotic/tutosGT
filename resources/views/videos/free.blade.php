@extends('layouts.app')

@section('title', 'Videos Gratuitos')

@section('body-class', 'profile-page')

@section('content')
<div class="header header-filter" style="background-image: url('/img/m1.jpg');"></div>

<div class="main main-raised">
    <div class="profile-content">
        <div class="container-fluid content-row">
            <div class="row">

                <div class="section">
                	@foreach ($videos as $video)
                        @if($video->thumbnail != '')
                            <div class="col-sm-12 col-lg-3">
                                <div class="card h-100" >
                                   <img src="{{ url($video->thumbnail) }}" alt="Avatar" style="width:100%">
                                  <div class="card-body">
                                    <h5 class="card-title">
                                        {{ $video->tittle }}
                                    </h5>
                                    <p class="card-text">{{ $video->description }}</p>
                                    <a href="{{ url('/videos/free/'.$video->id) }}" class="btn btn-primary">Ver video</a>
                                  </div>
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
