<div class="bg -grey">

    <div class='section-title'>
        <div class='description'>
            近期評分
        </div>
    </div>

    <div class='container'>
        <div class='row no-padding'>
            @foreach($reviews->sortByDesc('created_at') as $review)
            <div class='col-md-3' style='padding-left: 5px; padding-right: 5px;'>
                <div class="feed-box -review">
                    <header>
                        <img class='userimg' src='{{$review->user->profile->avatar}}'>
                        <div class='title'>
                            <div class='top'>
                                <!--
                                <a href='#'>{{$review->user->name}}</a>
                                -->
                                對
                                <a href='/shop/{{$review->entity->id}}'>[{{$review->entity->presentCity()}}] {{$review->entity->name}}</a>
                                評分
                            </div>
                            <div class='bottom'>
                                <span class='timestamp'>{{$review->created_at->timestamp}}</span>
                            <div>
                        </div>
                    </header>
                    <section>
                        {!!$review->presentRichSummarySmall()!!}
                    </section>
                </div>
            </div>
            @endforeach

            @if($reviews->count() === 0)
                <center>
                    <i>{{Config::get('nomadic.category-homepage.empty-review-text')}}</i>
                </center>
            @endif

        </div>
    </div>


</div>
