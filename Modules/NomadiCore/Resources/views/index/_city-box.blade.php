<div class='city-box'>
    <div class='name'>{{Config::get('city.' . $city . '.zh')}}</div>
    <div class='navigation'>
        <a href='/{{$city}}' class='btn btn-default'><i class="fa fa-home"></i>&nbsp; {{trans('global.mode.homepage')}}</a>
        <a href='/{{$city}}/list' class='btn btn-default'><i class="fa fa-list"></i>&nbsp; {{trans('global.mode.list')}}</a>
        @if(config('nomadic.map-enabled'))
        <a href='/{{$city}}/map' class='btn btn-default'><i class="fa fa-globe"></i>&nbsp; {{trans('global.mode.map')}}</a>
        @endif
    </div>
    <div class='info' style='height: 40px;'>
            <span class='green'>{{ Modules\NomadiCore\City::numOfCafes($city) }}</span> {{Config::get('nomadic.category-homepage.unit-amount')}},
            <span class='blue'>{{ Modules\NomadiCore\City::numOfReviews($city) }}</span> {{trans('homepage.info.reviews')}},
            <span class='orange'>{{ Modules\NomadiCore\City::numOfComments($city) }}</span> {{trans('homepage.info.comments')}},
            <span class='yellow'>{{ Modules\NomadiCore\City::numOfVisits($city) }}</span> {{Config::get('nomadic.category-homepage.checkin-amount')}}
    </div>
</div>
