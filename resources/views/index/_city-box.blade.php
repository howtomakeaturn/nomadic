<div class='city-box'>
    <div class='name'>{{Config::get('city.' . $city . '.zh')}}</div>
    <div class='navigation'>
        <a href='/{{$city}}' class='btn btn-default'><i class="fa fa-home"></i>&nbsp; {{trans('global.mode.homepage')}}</a>
        <a href='/{{$city}}/list' class='btn btn-default'><i class="fa fa-list"></i>&nbsp; {{trans('global.mode.list')}}</a>
    </div>
    <div class='info' style='height: 40px;'>
            <span class='green'>{{ App\City::numOfCafes($city) }}</span> {{Config::get('nomadic.category-homepage.unit-amount')}},
            <span class='blue'>{{ App\City::numOfReviews($city) }}</span> {{trans('homepage.info.reviews')}},
            <span class='orange'>{{ App\City::numOfComments($city) }}</span> {{trans('homepage.info.comments')}},
            <span class='yellow'>{{ App\City::numOfVisits($city) }}</span> {{Config::get('nomadic.category-homepage.checkin-amount')}}
    </div>
</div>
