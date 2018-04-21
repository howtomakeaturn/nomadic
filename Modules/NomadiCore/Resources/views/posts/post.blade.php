@extends('nomadicore::layout')
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
        color: #616161;
    }
    @media (min-width: 768px) {
        .bg {
            font-size: 18px;
        }
    }

    .post-block {
        border-bottom: 1px solid #eeeeee;
        margin-bottom: 20px;
    }

    .post-block img {
        display: inline-block;
    }

    .post-block article {
        display: inline-block;
        width: 100%;
        vertical-align: top;
        word-wrap:break-word;
    }

    .post-block header {
        color: #9E9E9E;
    }

    .post-block footer {
        text-align: right;
        margin-bottom: 30px;
    }

    .post-block footer a {
        color: #9E9E9E;
    }

    .post-block section {
        padding-top: 15px;
        line-height: 1.5;
        margin-bottom: 10px;
    }

    .post-block img.-big {
        display: none;
    }
    .post-block img.-small {
        display: inline-block;
    }

    @media (min-width: 768px) {
        .post-block img.-big {
            display: inline-block;
        }
        .post-block img.-small {
            display: none;
        }
        .post-block article {
            display: inline-block;
            width: calc( 100% - 80px);
            vertical-align: top;
            padding-left: 15px;
        }
    }

    /*
    @media (min-width: 768px) {
        .post-block footer a {
            visibility: hidden;
            opacity: 0;
            transition: visibility 0s, opacity 0.1s linear;
        }
    }

    .post-block:hover footer a {
        visibility: visible;
        opacity: 1;
    }
    */

</style>

@endsection
@section('content')


    <div class='bg -grey'>
    <div class='container'>
        <div class='row'>
            <div class='col-md-12'>
                <h3>{{$discussion->title}}</h3>
            </div>
        </div>
    </div>
    </div>

    <br>

    <div class='container'>

        <div class='row'>
            <div class='col-md-2'>

                <a href="/forum" style="margin-top: 15px;">&#171; 回到討論版首頁</a>
                <br>
                <br>
            </div>
            <div class='col-md-10'>
                @foreach($discussion->posts as $post)
                <div class="post-block" id='post-{{$post->id}}'>
                    <img src='{{$post->user->profile->avatar}}' style="border-radius: 50%;" class='-big'>
                    <article>
                        <header>
                            <img src='{{$post->user->profile->avatar}}' style="border-radius: 50%; width: 40px;" class='-small'>
                            {{$post->user->name}}

                            發佈於
                            <span class="timestamp">{{$post->created_at->timestamp}}</span>
                            @if($post->created_at != $post->updated_at)
                            編輯於
                            <span class="timestamp">{{$post->updated_at->timestamp}}</span>
                            @endif
                        </header>
                        <section>
                            {!!nl2br(htmlspecialchars($post->content))!!}
                        </section>
                        <footer>
                            <a href='#' onclick='$("#comment-form-for-post-{{$post->id}}").toggle(); return false;'>留言</a>
                            &nbsp;
                            @if(Auth::check() && Auth::user()->id == $post->user_id)
                            <a href='/post/edit/{{$post->id}}'>編輯</a>
                            &nbsp;
                            <span class="remove-post-btn" data-id='{{$post->id}}'>刪除</span>
                            @endif
                        </footer>
                        @foreach($post->comments as $comment)
                        <div style='border-top: 1px solid #eeeeee; padding: 10px 0;' id='comment-{{$comment->id}}'>
                            <img src='{{$comment->user->profile->avatar}}' style='border-radius: 50%; width: 30px;'>
                            <div style='display: inline-block; width: calc(100% - 40px); vertical-align: top; padding-left: 10px;'>
                                {{$comment->content}}
                                <span style="color: #9E9E9E;"> – {{$comment->user->name}}</span>
                                <span style="color: #9E9E9E;">於</span>
                                <span class="timestamp" style="color: #9E9E9E;">{{$comment->created_at->timestamp}}</span>
                            </div>
                        </div>
                        @endforeach
                        <div style='border-top: 1px solid #eeeeee; padding: 10px 0; display: none;' id='comment-form-for-post-{{$post->id}}'>
                            @if(Auth::check())
                            <img src='{{Auth::user()->profile->avatar}}' style='border-radius: 50%; width: 30px;'>
                            <div style='display: inline-block; width: calc(100% - 40px); vertical-align: top; padding-left: 10px;'>
                                <form method="post" action='/comment-to-post'>
                                    <input type='text' name='content' class="form-control" style='display: inline-block; width: calc(100% - 60px);'>
                                    {{csrf_field()}}
                                    <input type='hidden' name='post_id' value='{{$post->id}}'>
                                    <input type='submit' class="btn btn-primary" value="留言" onclick="this.disabled=true; this.value='處理中，請稍候...'; this.form.submit();">
                                </form>
                            </div>
                            @else
                            <a href="/login?path=/post/{{$discussion->id}}" class='btn btn-primary'>登入之後留言</a>
                            @endif
                        </div>
                    </article>
                </div>
                @endforeach

                @if(Auth::check())
                <div class="post-block" style="border: 0px; padding: 0px;">
                    <img src='{{Auth::user()->profile->avatar}}' style="border-radius: 50%;" class='-big'>
                    <article>
                        <header>
                            <img src='{{Auth::user()->profile->avatar}}' style="border-radius: 50%; width: 40px;" class='-small'>
                            {{Auth::user()->name}} 回覆貼文
                        </header>
                        <section>
                            <form method="post" action="/reply-post">
                                <textarea placeholder="回覆內容..." class="form-control" style='height: 200px;' name='content' required></textarea>
                                <br>
                                {{csrf_field()}}
                                <input type='hidden' name='discussion_id' value='{{$discussion->id}}'>
                                <input type='submit' value='回覆貼文' class="btn btn-primary btn-lg" onclick="this.disabled=true; this.value='處理中，請稍候...'; this.form.submit();">
                            </form>
                        </section>
                    </article>
                </div>
                @else
                <a href="/login?path=/post/{{$discussion->id}}" class='btn btn-primary btn-lg' style="margin-top: 15px;">登入之後回覆貼文</a>
                <br>
                <br>
                <br>
                @endif



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

            $('.post-block article section').linkify({
                target: "_blank"
            });

            $('.remove-post-btn').click(function(){
                if (confirm('刪除這篇貼文嗎？')) {
                    post('/remove-post', {
                        post_id: $(this).data('id'),
                        _token: '{{csrf_token()}}'
                    });
                }
            });

        });
    </script>

    <style>
        .remove-post-btn {
            color: #9e9e9e;
        }
        .remove-post-btn:hover {
            cursor: pointer;
        }
    </style>

@endsection
