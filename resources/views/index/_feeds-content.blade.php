@foreach($feeds as $feed)
    @if(get_class($feed) === 'App\Comment')
    <?php $comment = $feed ?>
    <div class="feed-box -comment">
        <header>
            <img class='userimg' src='{{$comment->user->profile->avatar}}'>
            <div class='title'>
                <div class='top'>
                    <!--
                    <a href='#'>{{$comment->user->name}}</a>
                    -->
                    對
                    <a href='/shop/{{$comment->cafe->id}}'>[{{$comment->cafe->presentCity()}}] {{$comment->cafe->name}}</a>
                    新增了一筆留言。
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
    @endif
    @if(get_class($feed) === 'App\Review')
    <?php $review = $feed ?>
    <div class="feed-box -review">
        <header>
            <img class='userimg' src='{{$review->user->profile->avatar}}'>
            <div class='title'>
                <div class='top'>
                    <!--
                    <a href='#'>{{$review->user->name}}</a>
                    -->
                    對
                    <a href='/shop/{{$review->cafe->id}}'>[{{$review->cafe->presentCity()}}] {{$review->cafe->name}}</a>
                    新增了一則評分。
                </div>
                <div class='bottom'>
                    <span class='timestamp'>{{$review->created_at->timestamp}}</span>
                <div>
            </div>
        </header>
        <section>
            {!!$review->presentRichSummary()!!}
        </section>
    </div>
    @endif
    @if(get_class($feed) === 'App\Photo')
    <?php $photo = $feed ?>
    <div class="feed-box -photo">
        <header>
            <img class='userimg' src='{{$photo->user->profile->avatar}}'>
            <div class='title'>
                <div class='top'>
                    <!--
                    <a href='#'>{{$photo->user->name}}</a>
                    -->
                    對
                    <a href='/shop/{{$photo->cafe->id}}'>[{{$photo->cafe->presentCity()}}] {{$photo->cafe->name}}</a>
                    新增了一張照片。
                </div>
                <div class='bottom'>
                    <span class='timestamp'>{{$photo->created_at->timestamp}}</span>
                <div>
            </div>
        </header>
        <section>
            <img src='/upload_photos/width-600/{{$photo->name}}' style='max-width: 100%; margin-top: 5px;'>
        </section>
    </div>
    @endif
@endforeach
