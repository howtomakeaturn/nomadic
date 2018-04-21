<div class='bg'>

<div class='container'>
    <div class='row no-padding'>
        @foreach(Modules\NomadiCore\City::getOnlineCities()->take(Layout::isMobile() ? 3 : 4) as $city)
        <div class='col-md-3' style='padding-left: 5px; padding-right: 5px;'>
            @include('index/_city-box')
        </div>
        @endforeach
    </div>
    <div class='row no-padding'>
        <div class='more'>{{trans('homepage.show-more-cities')}}&#9660;</div>
    </div>

    <div class='row no-padding -hide'>
        @foreach(Modules\NomadiCore\City::getOnlineCities()->slice(Layout::isMobile() ? 3 : 4) as $city)
        <div class='col-md-3' style='padding-left: 5px; padding-right: 5px;'>
            @include('index/_city-box')
        </div>
        @endforeach
    </div>

</div>

</div>

<script>
    $(document).ready(function(){
        $('.more').click(function(){
            $(this).hide();
            $('.row.-hide').slideDown();
        });
    });
</script>

<style>
    .more {
        text-align: center;
    }
    .more:hover {
        cursor: pointer;
        text-decoration: underline;
    }

    .row.-hide {
        display: none;
    }
</style>
