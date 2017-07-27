@extends('layout')
@section('head')

<link rel="stylesheet" href="/css/chat.css">

<style>
    #map {
        height: 200px;
        width: 100%;
    }

    body {
        background-color: #EEEEEE;
    }

    .post-item {
        padding: 15px;
        background-color: white;
        border-bottom: 1px solid #E0E0E0;
    }
    .post-item:hover {
        background-color: #F5F5F5;
    }

    .post-item img {
        display: inline-block;
    }

    .post-item a {
        display: inline-block;
        vertical-align: top;
        margin-left: 10px;
        width: calc(100% - 100px);
    }

    .post-item a:hover {
        text-decoration: none;
    }

    .post-item .title {
        margin: 0px;
        color: #616161;
        margin-bottom: 5px;
    }

    .post-item footer {
        color: #9E9E9E;
        font-size: 12px;
    }

    .post-item aside {
        display: inline-block;
        width: 40px;
        text-align: right;
    }

</style>

@endsection
@section('content')

    <div class='container'>


        <div class='row small-padding'>
            <div class='col-md-3'>

                @include('index/_personal-profile-side')

            </div>


            <div class='col-md-6'>
                <?php Carbon\Carbon::setLocale('zh-TW'); ?>

                <a style="display: block; color: #616161; margin-bottom: 10px; margin-left: 15px; margin-top: 5px;" href='/chat'>聊天室最新訊息</a>

                <div style='background-color: white; border: 1px solid #E0E0E0; padding: 20px; padding-bottom: 10px;'>
                    @foreach($messages as $message)
                    <div class="message">
                        <img src="{{$message->user->profile->avatar}}" class="left">
                        <div class="right">
                            <div class="info">
                                <span class="name">{{$message->user->name}}</span>&nbsp;&nbsp;
                                <span class="timestamp">{{$message->created_at->format('h:m a')}}</span>
                            </div>
                            <div class="text">{{$message->content}}</div>
                        </div>
                    </div>
                    @endforeach
                    <a href='/chat' style="text-align: center; display: block; border-top: 1px solid #E0E0E0; padding-top: 10px;">前往聊天室</a>
                </div>
                <a style="display: block; color: #616161; margin-bottom: 10px; margin-left: 15px; margin-top: 15px;" href='/forum'>討論版最新貼文</a>

                <div style='border: 1px solid #E0E0E0; border-bottom: 0px;'>
                @foreach($discussions as $discussion)
                    {!!$discussion->presentBlock()!!}
                @endforeach
                </div>

                <div style='height: 15px;'>&nbsp;</div>

                @include('index/_feeds')

            </div>

            <div class='col-md-3'>

                @include('index/_donated-cafe-promotion-side')

                <br>

                @include('index/_new-cafe-promotion-side')

            </div>
        </div>
    </div>

    <br>

    @include('partial/_footer')

@endsection
