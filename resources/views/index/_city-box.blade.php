<div class='city-box'>
    <div class='navigation'>
        <a href='/{{$city}}/list' class='btn btn-default'><i class="fa fa-list"></i>&nbsp; {{Config::get('city.' . $city . '.zh')}}</a>
    </div>
    <div class='info'>
            <span class='green'>{{ App\City::numOfCafes($city) }}</span> {{trans('homepage.info.shops')}},
            <span class='blue'>{{ App\City::numOfReviews($city) }}</span> {{trans('homepage.info.reviews')}},
            <span class='orange'>{{ App\City::numOfComments($city) }}</span> {{trans('homepage.info.comments')}},
            <span class='yellow'>{{ App\City::numOfVisits($city) }}</span> {{trans('homepage.info.checkins')}}
    </div>
</div>
