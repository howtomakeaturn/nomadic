@extends('layout')
@section('head')
<style>
    .bg {
        padding-top: 20px;
        padding-bottom: 20px;
    }

    .bg.-grey {
        background-color: #EEEEEE;
    }

    @media (min-width: 768px) {
        .bg {
            padding-top: 40px;
            padding-bottom: 40px;
        }
    }

    .greeting-box {
        text-align: center;
        padding-top: 12px;
        line-height: 1.7;
    }
    .greeting-box .title {
        font-size: 24px;
    }
    .greeting-box .slogan {
        font-size: 16px;
        margin-top: 10px;
        padding-left: 40px;
        padding-right: 40px;
    }
    @media (min-width: 768px) {
        .greeting-box {
            padding-top: 30px;
        }
        .greeting-box .title {
            font-size: 36px;
        }
        .greeting-box .slogan {
            font-size: 24px;
        }
    }

    .section-title {
        text-align: center;
        padding-top: 0px;
        padding-bottom: 12px;
    }
    .section-title .name {
        font-size: 18px;
        margin-bottom: 6px;
    }
    .section-title .description {

    }

    @media (min-width: 768px) {
        .section-title {
            text-align: center;
            padding-top: 0px;
            padding-bottom: 20px;
        }
        .section-title .name {
            font-size: 24px;
            margin-bottom: 12px;
        }
        .section-title .description {
            font-size: 18px;
        }
    }


</style>
@endsection
@section('content')

<div class='greeting-box'>
    <div class='title'>
        {{config('nomadic.homepage.title')}}
    </div>
    <div class='slogan'>

        {{config('nomadic.homepage.slogan-1')}}<br>

        {{config('nomadic.homepage.slogan-2')}}<br>

    </div>
</div>

<div class='bg'>
    <div class='container'>
        <div class='row no-padding'>
            @foreach(Modules\NomadiCore\City::getOnlineCities() as $city)
            <div class='col-md-3' style='padding-left: 5px; padding-right: 5px;'>
                @include('index/_city-box')
            </div>
            @endforeach
        </div>
    </div>
</div>

<br>

@include('partial/_footer')

@include('_open-modal')

@endsection
