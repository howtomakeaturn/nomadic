<header style="padding: 10px; background-color: white; border: 1px solid #E0E0E0; margin-bottom: 10px;">
    <div style="display: inline-block;">
        <img src='{{ $user->profile->avatar }}' style='border-radius: 50%; width: 40px;'>
    </div>
    <div style="display: inline-block; vertical-align: top; margin-left: 10px; width: calc(100% - 60px);">
        <div> <a href='/user/{{$user->id}}'>{{ $user->name }}</a> </div>
        <div>Experience: {{ $user->getScore() }}</div>
        <div style="margin-top: 5px;">
            <!--
            <div style="display: inline-block;">
                <i class="fa fa-calendar"></i>
                <a href='/calendar/my'>
                    行事曆
                </a>
            </div>
            &nbsp;
            -->
            <div style="display: inline-block;">
                <i class="fa fa-map-o"></i>
                <a href='/user/{{Auth::user()->id}}/map'>
                    地圖
                </a>
            </div>
        </div>

    </div>
</header>

@if($readyToReviewCafes->count() > 0)
<div class='sidelink-box'>
    <div class='item'>
        <i class="fa fa-check-square-o"></i>&nbsp;
        <a href='#' onclick="$('.item.-ready-to-review').slideToggle(); return false;">
            有 {{$readyToReviewCafes->count()}} 間去過的店尚未評分 <span class="caret"></span>
        </a>
    </div>
    @foreach($readyToReviewCafes as $cafe)
    <div class='item -ready-to-review' style="display: none;">
        <i class="fa fa-map-marker"></i>&nbsp;
        <a href='/review/{{$cafe->id}}' target="_blank">
            {{$cafe->name}}
        </a>
    </div>
    @endforeach
</div>
@endif

@if(Auth::user()->wishes->count() > 0)
<div class='sidelink-box'>
    <div class='item'>
        <i class="fa fa-heart-o"></i>&nbsp;
        <a href='#' onclick="$('.item.-wish-to-go').slideToggle(); return false;">
            想去清單內有 {{Auth::user()->wishes->count()}} 間店 <span class="caret"></span>
        </a>
    </div>
    @foreach(Auth::user()->wishes->sortByDesc('created_at') as $wish)
    <?php $cafe = $wish->cafe ?>
    <div class='item -wish-to-go' style="display: none;">
        <i class="fa fa-heart"></i>&nbsp;
        <a href='/shop/{{$cafe->id}}' target="_blank">
            {{$cafe->name}}
        </a>
    </div>
    @endforeach
</div>
@endif

<style>
    .sidelink-box {
        background-color: white;
        border: 1px solid #E0E0E0;
        margin-bottom: 10px;
    }

    .sidelink-box > .item {
        padding: 10px;
        border-bottom: 1px solid #E0E0E0;
    }

    .sidelink-box > .item > a {
        display: inline-block;
        width: calc(100% - 30px);
    }
</style>
