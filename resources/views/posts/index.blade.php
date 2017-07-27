@extends('layout')
@section('head')

<style>
    .bg {
        padding-top: 20px;
        padding-bottom: 20px;
        text-align: center;
        line-height: 1.7;
    }
    .bg.-grey {
        background-color: #EEEEEE;
        color: #616161;
    }
    @media (min-width: 768px) {
        .bg {
            font-size: 18px;
        }
    }
    .posts-block ul {
        list-style-type: none;
        padding: 0px;
    }
    .post-item {
        padding: 15px;
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


    <div class='bg -grey'>
    <div class='container'>
        <div class='row'>
            <div class='col-md-12'>
                <h3>Cafe Nomad 討論版</h3>
                歡迎大家在這裡討論咖啡廳、喝咖啡、工作、閒聊... 等等的各種話題！
            </div>
        </div>
    </div>
    </div>

    <br>

    <div class='container'>

        <div class='row'>
            <div class='col-md-3'>
                @if(Auth::check())
                <a href="/new-post" class='btn btn-primary btn-block' style="margin-top: 15px;">發佈貼文</a>
                <br>
                @else
                <a href="/login?path=/new-post" class='btn btn-primary btn-block' style="margin-top: 15px;">登入之後發佈貼文</a>
                <br>
                @endif

            </div>
            <div class='col-md-9'>
                <div class="posts-block">
                    <ul>
                    @foreach($discussions as $discussion)
                    <li>
                        {!!$discussion->presentBlock()!!}
                    </li>
                    @endforeach
                    </ul>
                </div>
            </div>

        </div>
    </div>

    <script>
        $(document).ready(function(){

            moment.locale('zh-tw');

            $('.timestamp').map(function(e){
                if ($.isNumeric($(this).text())) {
                    $(this).text(moment.unix($(this).text()).fromNow());
                }
            });

        });
    </script>

@endsection
