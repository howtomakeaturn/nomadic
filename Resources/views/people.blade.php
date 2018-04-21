@extends('layout')
@section('head')

<script src="/vendor/linkify/linkify.min.js"></script>
<script src="/vendor/linkify/linkify-jquery.min.js"></script>

<style>
    .bg {
        padding-top: 20px;
        padding-bottom: 20px;
        text-align: center;
        line-height: 1.7;
    }

    .bg.-grey {
        background-color: #EEEEEE;
    }
    .-grey-bg {
        background-color: #EEEEEE;
    }
    .bg.-main {
        color: white;
        padding-top: 40px;
        padding-bottom: 40px;
    }

    .bg-img {
        background-position: center bottom;
        background-size: auto 100%;
    }

    .overlay {
        background: rgba(0, 0, 0, .35);
        overflow: hidden;
        height: 100%;
        z-index: 2;
    }

    @media (min-width: 768px) {
        .bg {
            font-size: 18px;
        }
        .bg.-main {
            padding-top: 100px;
            padding-bottom: 100px;
        }
        .bg-img {
            background-size: 100% auto;
        }
    }

    .cafe-box {
        box-shadow: 1px 1px 20px #888;
        padding-right: 20px;
        padding-top: 20px;
        padding-bottom: 10px;
        margin-top: 15px;
        margin-bottom: 20px;
    }
    .navbar {
        margin-bottom: 0;
    }

</style>
@endsection
@section('content')

<div class='bg'>
<div class='container'>
    <div class='row'>
        <div class='col-md-12'>
            <h3>咖啡廳裡的人們都在忙什麼？<img src='/img/thinking-face.png' style="width: 50px;"></h3>
            我
            <img src='https://graph.facebook.com/v2.8/1320392734647045/picture?type=square' style='border-radius: 50%; width: 30px;'>
            每次去咖啡廳工作的時候，都很好奇其他人在忙什麼。<br>
            店內的客人來自各行各業，如果能互相交流一下，一定有許多很棒的合作機會！<br>
            所以，一起來分享一下自己的工作＆最近在咖啡廳忙什麼吧！<br>
            <br>
            <a href='/people/me' class="btn btn-primary btn-lg" style="">
                <i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;
                好的，讓我來跟大家分享
            </a>
            <br>
            <br>
        </div>
    </div>
</div>
</div>

<div class="-grey-bg">
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <center>
                <br>
                <h3>
                    <img src='/img/smiling-face-with-sunglasses.png' style="width: 40px;">
                    咖啡廳裡的人們
                    <img src='/img/smiling-face-with-sunglasses.png' style="width: 40px;">
                </h3>
                <br>
            </center>
        </div>

        <div class="col-md-8 col-md-offset-2 ">
            @foreach($doings as $doing)
            <div class="card">
                <div style="">
                    <img src='{{$doing->user->profile->avatar}}' style='border-radius: 50%; display: inline-block;'>
                    <div style="display: inline-block; vertical-align: top; padding-left: 5px;">
                        <div>{{$doing->user->name}}</div>
                        @if($doing->job)
                        <div>{{$doing->job}}</div>
                        @endif
                        @if($doing->city)
                        <div>近期出沒地區：{{trans("global.city." . $doing->city)}}</div>
                        @endif
                    </div>
                </div>
                <section style="margin-top: 20px;">
                    {!!nl2br(htmlspecialchars($doing->content))!!}
                </section>
                @if($doing->show_facebook_link)
                <div style="margin-top: 20px;">
                臉書連結：<a target='_blank' href='https://www.facebook.com/{{$doing->user->socialCredentials->first()->social_id}}' style="margin-top: 20px; word-break: break-all;">
                    https://www.facebook.com/{{$doing->user->socialCredentials->first()->social_id}}
                </a>
                </div>
                @endif
                @if(Auth::check() && Auth::user()->id == $doing->user_id)
                <footer>
                    <span class="remove-doing-btn" data-id='{{$doing->id}}'>刪除</span>
                </footer>
                @endif
            </div>
            @endforeach
        </div>
    </div>
    <br>
    <br>
</div>
</div>

@include('partial/_footer')

<style>
    .card {
        background-color: white;
        border: 1px solid #E0E0E0;
        padding: 20px 30px;
        margin-bottom: 20px;
    }

    .card footer {
        text-align: right;
        margin-top: 20px;
        color: #9E9E9E;
    }
    .remove-doing-btn:hover {
        cursor: pointer;
    }

</style>

<script>
    $(document).ready(function(){

        $('.card section').linkify({
            target: "_blank"
        });

        $('.remove-doing-btn').click(function(){
            if (confirm('刪除這篇貼文嗎？')) {
                post('/people/remove', {
                    doing_id: $(this).data('id'),
                    _token: '{{csrf_token()}}'
                });
            }
        });

    });
</script>

@endsection
