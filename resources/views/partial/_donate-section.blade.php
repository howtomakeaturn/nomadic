<div class='donate-bg'>

    @if(Layout::isMobile() === false)
    <div class='container'>
        <div class="row small-padding">
            @if(CafeNomad::getDonatedCafes(Layout::getCity())->count() === 1)
                <div class="col-md-4 col-md-offset-4">
                    @include('partial/_thanks-box', ['cafe' => CafeNomad::getDonatedCafes(Layout::getCity())->first()])
                </div>
            @elseif(CafeNomad::getDonatedCafes(Layout::getCity())->count() === 2)
                @foreach(CafeNomad::getDonatedCafes(Layout::getCity()) as $index => $cafe)
                <div class="col-md-4 @if($index === 0) col-md-offset-2 @endif">
                    @include('partial/_thanks-box')
                </div>
                @endforeach
            @else
                @foreach(CafeNomad::getDonatedCafes(Layout::getCity())->take(3) as $index => $cafe)
                <div class="col-md-4">
                    @include('partial/_thanks-box')
                </div>
                @endforeach
            @endif
        </div>
    </div>
    @else
        @if(CafeNomad::getDonatedCafes(Layout::getCity())->count() === 1)
            @include('partial/_thanks-box', ['cafe' => CafeNomad::getDonatedCafes(Layout::getCity())->first()])
        @else

            <div class='slider-placeholder'>
                <!--
                <img src='/img/loading.gif'>
                -->
                <div style='width: 310px; margin: 0 auto;'>
                <?php $cafes = CafeNomad::getDonatedCafes(Layout::getCity()); ?>
                @include('partial/_thanks-box', ['cafe' => $cafes->first()])
                </div>
            </div>

            <?php /*
            <div class="slider" style='display: none;'>
                @foreach($cafes as $index => $cafe)

                    @include('partial/_thanks-box')

                @endforeach
            </div>

            <style>
                .slider-placeholder {
                    height: 185px;
                }
                .slider-placeholder> img {
                    display: block;
                    width: 70px;
                    margin: 0 auto;
                    padding-top: 40px;
                    float: left;
                    z-index: 10;
                }

            </style>

            <script>
                $(document).ready(function() {
                    $('.slider-placeholder').hide();
                    $('.slider').show();
                  $('.slider').slick({
                    centerMode: true,
                    centerPadding: '30px',
                    dots: true,
                    infinite: true,
                    speed: 300,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                  });
                });
            </script>
            */
            ?>
        @endif

    @endif

    @if(LaravelLocalization::getCurrentLocale() === 'zh-TW')
    <div class='donate-slogan'>
        贊助店家力挺 Cafe Nomad，Cafe Nomad 力挺台灣咖啡廳
        <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
        <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
        <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
        &nbsp;
        <a href='/donate'>成為贊助店家，取得強化曝光</a>
    </div>
    @endif
</div>

<style>

    .donate-bg {
        padding-top: 10px;
        padding-bottom: 10px;
        background-color: #EEEEEE;
        margin-bottom: 10px;
    }

    .thanks-box {
        background-color: white;
        margin: 0 auto;
        padding: 10px;
        max-width: 320px;
    }

    .thanks-box:hover {
        cursor: pointer;
    }

    .thanks-box > .title {
        /*
        font-size: 18px;
        */
        padding-top: 9px;
        padding-bottom: 9px;
    }

    @media (min-width: 768px) {
        .thanks-box {
            max-width: none;
        }

        .thanks-box > .title {
            /*
            font-size: 24px;
            */
            padding-top: 12px;
            padding-bottom: 12px;
        }
    }

    .donate-slogan {
        text-align: center;
        padding-top: 5px;
        padding-left: 15px;
        padding-right: 15px;
    }

</style>
