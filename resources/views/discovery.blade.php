@extends('layout')
@section('head')
@if(App\Layout::isMobile())
<style>

    body {
        font-size: 12px;
    }

</style>
@endif

<style>
    body {
        font-size: 16px;
        /*
        background-color: #EEEEEE;
        */
    }
</style>
@endsection
@section('content')

<div class='container'>
    <div class='row'>
        <div class='col-md-12'>
            <div class='head'>
                <p class='home'><a href='/'>Cafe Nomad</a></p>
                <br>
                <p>Cafe Nomad 社群的網友們一起寫的咖啡廳食記&評鑑！</p>
            </div>
            <br>
            <br>
            <br>
            @foreach($cafes as $cafe)
                <div class='discovery-box'>
                    <img src='/upload_photos/width-600/{{$cafe->photos->first()->name}}' style='display: block; margin: 0 auto; max-width: 100%;'>
                    <h3><a href='/shop/{{$cafe->id}}'>{{$cafe->name}}</a></h3>
                    <br>
                    @if($cafe->url)
                    <p><a href='{{$cafe->url}}'>{{$cafe->url}}</a></p>
                    @endif
                    @if($cafe->address)
                    <p>{{$cafe->address}}</p>
                    @endif
                    @if($cafe->open_time)
                    <p>營業時間：{{$cafe->open_time}}</p>
                    @endif
                    @foreach($cafe->comments as $comment)
                    <div class='comment'>
                        {{$comment->body}}
                        <img src='{{$comment->user->profile->avatar}}'>
                    </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</div>

<style>
    .head {
        padding-top: 40px;
        text-align: center;
    }
    .head .home {
        font-weight: bold;
    }

    .discovery-box {
        background-color: white;
        /*
        border: 1px solid #E0E0E0;
        padding: 10px 15px;
        */
        padding-bottom: 130px;
        text-align: center;
        word-wrap:break-word;
    }
    .discovery-box .comment {
        font-style: italic;
        color: #757575;
        padding-top: 20px;
        padding-left: 50px;
        padding-right: 50px;
    }

    .discovery-box .comment img {
        width: 40px;
        border-radius: 50%;
        display: inline-block;
        margin-left: 10px;
    }

    @media (min-width: 768px) {
      .container {
        width: 700px;
      }
    }
    a {
        color: rgb(51, 51, 51);
        text-decoration: underline;
    }
    a:hover {
        color: rgb(51, 51, 51);
        text-decoration: underline;
    }
</style>

@endsection
