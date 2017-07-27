<div class='social-feed'>
    <div style='font-size: 18px; font-weight: bold; margin-bottom: 5px; padding-left: 20px;'>近期 Nomad 留言</div>
    @foreach($comments as $comment)
    <div class="comment-box">
        <img src='{{$comment->user->profile->avatar}}'>
        <div class='body'>
            <header>
                <i class="fa fa-commenting-o"></i>
                <div class='cafename'>
                    <a href='/shop/{{$comment->cafe->id}}'>[{{$comment->cafe->presentCity()}}] {{$comment->cafe->name}}</a>
                </div>
            </header>
            <section>
            {{$comment->body}}
            </section>
        </div>
    </div>
    @endforeach
    <!--
    <a href='#' style='padding: 15px 20px; display: block;'>顯示更多</a>
    -->
</div>

<style>
    .social-feed {
        padding-top: 20px;
        background-color: white;
        border: 1px solid #E0E0E0;
        margin-bottom: 10px;
    }

    .comment-box {
        padding: 10px 15px;
        border-bottom: 1px solid #E0E0E0;
    }

    .comment-box > img {
        display: inline-block;
        border-radius: 50%;
    }

    .comment-box > .body {
        display: inline-block;
        vertical-align: top;
        width: calc(100% - 55px);
    }

    .comment-box .body > header > .username {
        display: inline-block;
        color: #757575;
    }

    .comment-box .body > header > .cafename {
        display: inline-block;
    }

    .comment-box .body > header > .timestamp {
        display: inline-block;
        color: #9E9E9E;
    }

    .comment-box .body > section {
        padding-top: 5px;
        padding-bottom: 5px;
        padding-left: 20px;
    }

    .comment-box .body > footer {
        color: #9E9E9E;
        padding-left: 20px;
    }
</style>
