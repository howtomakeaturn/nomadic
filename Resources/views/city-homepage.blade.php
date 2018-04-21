@extends('layout')
@section('head')

<style>
    #map {
        height: 200px;
        width: 100%;
    }

    .ad-container {
        direction: rtl;
        margin-bottom: 15px;
    }

</style>

<style>
    .bg {
        padding-top: 20px;
        padding-bottom: 20px;
    }

    .bg.-grey {
        background-color: #EEEEEE;
    }

    @media (min-width: 768px) {
        .bg {
            padding-top: 40px;
            padding-bottom: 40px;
        }
    }


    .greeting-box {
        text-align: center;
        padding-top: 12px;
        line-height: 1.7;
        padding-bottom: 20px;
    }
    .greeting-box .title {
        font-size: 24px;
    }
    .greeting-box .slogan {
        font-size: 16px;
        margin-top: 10px;
    }

    @media (min-width: 768px) {
        .greeting-box {
            padding-top: 0px;
        }
        .greeting-box .title {
            font-size: 36px;
        }
        .greeting-box .slogan {
            font-size: 24px;
        }
    }

    .section-title {
        text-align: center;
        padding-top: 0px;
        padding-bottom: 12px;
    }
    .section-title .name {
        font-size: 18px;
        margin-bottom: 6px;
    }
    .section-title .description {

    }

    @media (min-width: 768px) {
        .section-title {
            text-align: center;
            padding-top: 0px;
            padding-bottom: 20px;
        }
        .section-title .name {
            font-size: 24px;
            margin-bottom: 12px;
        }
        .section-title .description {
            font-size: 18px;
        }
    }

    .-hide {
        display: none;
    }

    .more {
        text-align: center;
    }
    .more:hover {
        cursor: pointer;
        text-decoration: underline;
    }
</style>

@endsection
@section('content')

    <div class='greeting-box'>
        <div class='title'>
            {{Config::get('city.' . $city . '.zh')}}
        </div>
        <div class='slogan'>
            <a href='/{{$city}}' class='btn btn-default'><i class="fa fa-home"></i>&nbsp; {{trans('global.mode.homepage')}}</a>
            <a href='/{{$city}}/list' class='btn btn-default'><i class="fa fa-list"></i>&nbsp; {{trans('global.mode.list')}}</a>
            <a href='/{{$city}}/map' class='btn btn-default'><i class="fa fa-globe"></i>&nbsp; {{trans('global.mode.map')}}</a>
        </div>
    </div>


    <div class='city-box' style='margin-bottom: 0; padding-top: 15px; padding-bottom: 15px;'>
        <?php $city = Layout::getCity(); ?>
        <!--
        <div class='navigation'>
            <a href='/{{$city}}' class='btn btn-default'><i class="fa fa-list"></i>&nbsp; {{trans('global.mode.list')}}</a>
            <a href='/map/{{$city}}' class='btn btn-default'><i class="fa fa-globe"></i>&nbsp; {{trans('global.mode.map')}}</a>
        </div>
        -->
        <div class='info_'>
                <span class='green'>{{ Modules\NomadiCore\City::numOfCafes($city) }}</span> {{Config::get('nomadic.category-homepage.unit-amount')}},
                <span class='blue'>{{ Modules\NomadiCore\City::numOfReviews($city) }}</span> 則評分,
                <span class='orange'>{{ Modules\NomadiCore\City::numOfComments($city) }}</span> 筆留言,
                <span class='yellow'>{{ Modules\NomadiCore\City::numOfVisits($city) }}</span> {{Config::get('nomadic.category-homepage.checkin-amount')}}
        </div>
    </div>


    <div style='text-align: center; margin-bottom: 30px; background-color: #F5F5F5; padding-bottom: 15px; padding-left: 15px; padding-right: 15px;'>
        @foreach(Modules\NomadiCore\City::getFeaturedTags(Layout::getCity())->take(Layout::isMobile() ? 9 : 25) as $set)
            <a class='cafe-tag' href='/{{Layout::getCity()}}/tag/{{$set['id']}}'>
                {{$set['name']}}

                <spn style='color: #A5D6A7; font-size: 12px;'>{{$set['count']}}</span>
            </a>
        @endforeach

        @foreach(Modules\NomadiCore\City::getFeaturedTags(Layout::getCity())->slice(Layout::isMobile() ? 9 : 25) as $set)
            <a class='cafe-tag -hide' href='/{{Layout::getCity()}}/tag/{{$set['id']}}'>
                {{$set['name']}}

                <spn style='color: #A5D6A7; font-size: 12px;'>{{$set['count']}}</span>
            </a>
        @endforeach

        @if(Modules\NomadiCore\City::getFeaturedTags(Layout::getCity())->count() > (Layout::isMobile() ? 9 : 25))
        <div class='more'>顯示全部標籤&#9660;</div>
        @endif

        @if(Modules\NomadiCore\City::getFeaturedTags(Layout::getCity())->count() === 0)
            <i>這個地區還沒有蒐集夠多的標籤。</i>
        @endif
    </div>

    @include('nomadicore::city-homepage/_comment-section')

    <br>
    <br>

    @include('nomadicore::city-homepage/_review-section')

    <br>
    <br>

    @include('nomadicore::partial/_footer')

    <script>
        function parseTimestamp()
        {
            $('.timestamp').map(function(e){
                if ($.isNumeric($(this).text())) {
                    $(this).text(moment.unix($(this).text()).fromNow());
                }
            });
        }

        $(document).ready(function(){

            moment.locale('zh-tw');

            parseTimestamp();

            var page = 1;

        });


        $(document).ready(function(){
            $('.more').click(function(){
                $(this).hide();
                $('.-hide').slideDown();
            });
        });

    </script>

    @include('nomadicore::_open-modal')

@endsection
