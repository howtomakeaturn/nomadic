@extends('nomadicore::layout')
@section('head')

<style>
    #map {
        height: 200px;
        width: 100%;
    }

    body {
        background-color: #EEEEEE;
    }
</style>

@endsection
@section('content')

    <div class='container'>
        <div class='row'>
            <div class='col-md-3'>
                @if(Auth::check())
                    @include('nomadicore::index/_personal-profile-side')
                @endif
            </div>
            <div class='col-md-6'>

                @include('nomadicore::index/_feeds')

            </div>

            <div class='col-md-3'>
                @include('nomadicore::index/_new-cafe-promotion-side')
            </div>
        </div>
    </div>

    <br>

@endsection
