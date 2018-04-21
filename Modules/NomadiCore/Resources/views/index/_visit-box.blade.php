<div class='reviews-block'>
    <header>近期 Nomad 評分</header>
    @foreach($reviews as $review)
    <div class="comment-box">
        <img src='{{$review->user->profile->avatar}}'>
        <div class='body'>
            <header>
                <i class="fa fa-pencil-square-o"></i>
                <div class='cafename'>
                    <a href='/shop/{{$review->cafe->id}}'>[{{$review->cafe->presentCity()}}] {{$review->cafe->name}}</a>
                </div>
            </header>
            <section>
                {{ $review->presentSummary() }}
            </section>
        </div>
    </div>
    @endforeach
    <!--
    <a href='#' style='padding: 15px 20px; display: block;'>顯示更多</a>
    -->
</div>
