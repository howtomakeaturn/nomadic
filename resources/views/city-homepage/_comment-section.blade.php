<div class="bg -grey">

    <div class='section-title'>
        <div class='description'>
            近期留言
        </div>
    </div>

    <div class='container'>
        <div class='row no-padding'>
            @foreach($comments->sortByDesc('created_at') as $comment)
                <div class='col-md-3' style='padding-left: 5px; padding-right: 5px;'>
                    <div class="feed-box -comment">
                        <header>
                            <img class='userimg' src='{{$comment->user->profile->avatar}}'>
                            <div class='title'>
                                <div class='top'>
                                    <!--
                                    <a href='#'>{{$comment->user->name}}</a>
                                    -->
                                    對
                                    <a href='/shop/{{$comment->entity->id}}'>[{{$comment->entity->presentCity()}}] {{$comment->entity->name}}</a>
                                    留言
                                </div>
                                <div class='bottom'>
                                    <span class='timestamp'>{{$comment->created_at->timestamp}}</span>
                                <div>
                            </div>
                        </header>
                        <section>
                            {{$comment->body}}
                        </section>
                    </div>
                </div>
            @endforeach

            @if($comments->count() === 0)
                <center>
                    <i>{{Config::get('nomadic.category-homepage.empty-comment-text')}}</i>
                </center>
            @endif

        </div>
    </div>


</div>

<style>

    .feed-box {
        background-color: white;
        border: 1px solid #E0E0E0;
        padding: 10px 15px;
        margin-bottom: 3px;
        overflow: auto;
    }

    @media (min-width: 768px) {
        .feed-box.-comment {
            height: 180px;
        }
        .feed-box.-review {
            height: 240px;
        }
        .feed-box.-photo {
            height: 350px;
        }
    }

    .feed-box .userimg {
        border-radius: 50%;
        width: 40px;
    }

    .feed-box header {
        color: #9E9E9E;
    }

    .feed-box .userimg {
        display: inline-block;
    }

    .feed-box header .title {
        display: inline-block;
        vertical-align: top;
        margin-left: 5px;
        width: calc(100% - 50px);
    }

    .feed-box header .title .top {
        margin-bottom: 1px;
    }

    .feed-box header .title .bottom {
        font-size: 14px;
    }

    .feed-box section {
        padding-top: 7px;
    }

</style>
