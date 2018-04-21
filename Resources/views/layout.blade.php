<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>{{Layout::openGraphTitle()}}</title>
        <meta name="description" content="{{Layout::slogan()}}">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name='og:title' content="{{Layout::openGraphTitle()}}">

        <meta name='og:description' content="{{Layout::openGraphDescription()}}">

        <meta name='og:image' content="{{ Layout::openGraphImage() }}">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="/css/bootstrap.min.css">

        <link rel="stylesheet" href="/css/font-awesome.min.css">

        <link rel="stylesheet" href="/css/style.css?v=12">

        <script src="/js/list.min.js"></script>

        <script src="/js/jquery-1.12.0.min.js"></script>

        <script src='/js/bootstrap.min.js'></script>

        <script src='/js/helper.js?v=11'></script>

        <script src='/js/store.min.js'></script>

        <script src='/js/moment-with-locales.min.js'></script>

        <script src='/vendor/pickadate/picker.js'></script>
        <script src='/vendor/pickadate/picker.date.js'></script>
        <script src='/vendor/pickadate/picker.time.js'></script>
        <link rel="stylesheet" href="/vendor/pickadate/classic.css">
        <link rel="stylesheet" href="/vendor/pickadate/classic.date.css">
        <link rel="stylesheet" href="/vendor/pickadate/classic.time.css">

        <link rel="stylesheet" href="/vendor/photo-swipe/photoswipe.css">
        <link rel="stylesheet" href="/vendor/photo-swipe/default-skin/default-skin.css">
        <script src="/vendor/photo-swipe/photoswipe.min.js"></script>
        <script src="/vendor/photo-swipe/photoswipe-ui-default.min.js"></script>

        <link rel="stylesheet" type="text/css" href="/vendor/slick/slick.css"/>
        <!-- Add the slick-theme.css if you want default styling -->
        <link rel="stylesheet" type="text/css" href="/vendor/slick/slick-theme.css"/>

        <script type="text/javascript" src="/vendor/slick/slick.min.js"></script>

        <!--
        <script src="//load.sumome.com/" data-sumo-site-id="7c684f18608f53b96f6d1bb3f4ff9fc0ecb35560cd77fa6315b852c44ca65353" async="async"></script><script src="//load.sumome.com/" data-sumo-site-id="7c684f18608f53b96f6d1bb3f4ff9fc0ecb35560cd77fa6315b852c44ca65353" async="async"></script>
        -->
        <script>
            @if(Session::get('message'))
                alert('{{Session::get('message')}}');
            @endif
        </script>

        @yield('head')

        <link rel="apple-touch-icon" href="/apple-touch-icon.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" href="/favicon-32x32.png?v=1" sizes="32x32">
        <link rel="icon" type="image/png" href="/favicon-16x16.png?v=1" sizes="16x16">
        <link rel="manifest" href="/manifest.json">
        <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="theme-color" content="#ffffff">

        <style>
            .sk-fading-circle {
              margin: 100px auto;
              width: 100px;
              height: 100px;

              position: fixed;
              z-index: 5;
              left: 0;
              right: 0;
              margin-left: auto;
              margin-right: auto;
              top: 15%;
              display: none;
            }

            .sk-fading-circle .sk-circle {
              width: 100%;
              height: 100%;
              position: absolute;
              left: 0;
              top: 0;
            }

            .sk-fading-circle .sk-circle:before {
              content: '';
              display: block;
              margin: 0 auto;
              width: 15%;
              height: 15%;
              background-color: #00BCD4;
              border-radius: 100%;
              -webkit-animation: sk-circleFadeDelay 1.2s infinite ease-in-out both;
                      animation: sk-circleFadeDelay 1.2s infinite ease-in-out both;
            }
            .sk-fading-circle .sk-circle2 {
              -webkit-transform: rotate(30deg);
                  -ms-transform: rotate(30deg);
                      transform: rotate(30deg);
            }
            .sk-fading-circle .sk-circle3 {
              -webkit-transform: rotate(60deg);
                  -ms-transform: rotate(60deg);
                      transform: rotate(60deg);
            }
            .sk-fading-circle .sk-circle4 {
              -webkit-transform: rotate(90deg);
                  -ms-transform: rotate(90deg);
                      transform: rotate(90deg);
            }
            .sk-fading-circle .sk-circle5 {
              -webkit-transform: rotate(120deg);
                  -ms-transform: rotate(120deg);
                      transform: rotate(120deg);
            }
            .sk-fading-circle .sk-circle6 {
              -webkit-transform: rotate(150deg);
                  -ms-transform: rotate(150deg);
                      transform: rotate(150deg);
            }
            .sk-fading-circle .sk-circle7 {
              -webkit-transform: rotate(180deg);
                  -ms-transform: rotate(180deg);
                      transform: rotate(180deg);
            }
            .sk-fading-circle .sk-circle8 {
              -webkit-transform: rotate(210deg);
                  -ms-transform: rotate(210deg);
                      transform: rotate(210deg);
            }
            .sk-fading-circle .sk-circle9 {
              -webkit-transform: rotate(240deg);
                  -ms-transform: rotate(240deg);
                      transform: rotate(240deg);
            }
            .sk-fading-circle .sk-circle10 {
              -webkit-transform: rotate(270deg);
                  -ms-transform: rotate(270deg);
                      transform: rotate(270deg);
            }
            .sk-fading-circle .sk-circle11 {
              -webkit-transform: rotate(300deg);
                  -ms-transform: rotate(300deg);
                      transform: rotate(300deg);
            }
            .sk-fading-circle .sk-circle12 {
              -webkit-transform: rotate(330deg);
                  -ms-transform: rotate(330deg);
                      transform: rotate(330deg);
            }
            .sk-fading-circle .sk-circle2:before {
              -webkit-animation-delay: -1.1s;
                      animation-delay: -1.1s;
            }
            .sk-fading-circle .sk-circle3:before {
              -webkit-animation-delay: -1s;
                      animation-delay: -1s;
            }
            .sk-fading-circle .sk-circle4:before {
              -webkit-animation-delay: -0.9s;
                      animation-delay: -0.9s;
            }
            .sk-fading-circle .sk-circle5:before {
              -webkit-animation-delay: -0.8s;
                      animation-delay: -0.8s;
            }
            .sk-fading-circle .sk-circle6:before {
              -webkit-animation-delay: -0.7s;
                      animation-delay: -0.7s;
            }
            .sk-fading-circle .sk-circle7:before {
              -webkit-animation-delay: -0.6s;
                      animation-delay: -0.6s;
            }
            .sk-fading-circle .sk-circle8:before {
              -webkit-animation-delay: -0.5s;
                      animation-delay: -0.5s;
            }
            .sk-fading-circle .sk-circle9:before {
              -webkit-animation-delay: -0.4s;
                      animation-delay: -0.4s;
            }
            .sk-fading-circle .sk-circle10:before {
              -webkit-animation-delay: -0.3s;
                      animation-delay: -0.3s;
            }
            .sk-fading-circle .sk-circle11:before {
              -webkit-animation-delay: -0.2s;
                      animation-delay: -0.2s;
            }
            .sk-fading-circle .sk-circle12:before {
              -webkit-animation-delay: -0.1s;
                      animation-delay: -0.1s;
            }

            @-webkit-keyframes sk-circleFadeDelay {
              0%, 39%, 100% { opacity: 0; }
              40% { opacity: 1; }
            }

            @keyframes sk-circleFadeDelay {
              0%, 39%, 100% { opacity: 0; }
              40% { opacity: 1; }
            }

            .announcement-bg {
                background-color: #EEEEEE;
                padding-top: 20px;
                padding-bottom: 20px;
                margin-bottom: 10px;
            }

            .announcement {
                padding: 10px 10px;
            }

            .announcement > a {
                color: #333;
            }

        </style>

    </head>
    <body>

        <div class="sk-fading-circle" id='loading'>
          <div class="sk-circle1 sk-circle"></div>
          <div class="sk-circle2 sk-circle"></div>
          <div class="sk-circle3 sk-circle"></div>
          <div class="sk-circle4 sk-circle"></div>
          <div class="sk-circle5 sk-circle"></div>
          <div class="sk-circle6 sk-circle"></div>
          <div class="sk-circle7 sk-circle"></div>
          <div class="sk-circle8 sk-circle"></div>
          <div class="sk-circle9 sk-circle"></div>
          <div class="sk-circle10 sk-circle"></div>
          <div class="sk-circle11 sk-circle"></div>
          <div class="sk-circle12 sk-circle"></div>
        </div>

        @if(Layout::shouldDisplayNavbar())
        <nav class="navbar navbar-inverse" style="z-index: 10;">
          <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>

              <a class="navbar-brand" href="/">{{ config('nomadic.global.app') }}</a>

            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">

                <li role="presentation" ><a href="#city-modal" data-toggle="modal" data-target="#city-modal">選擇{{Config::get('nomadic.global.category')}}</a></li>

                @if(Config::get('nomadic.forum.enabled'))
                <li role="presentation" ><a href="/forum">{{Config::get('nomadic.forum.label')}}</a></li>
                @endif

                @foreach(Config::get('nomadic.links') as $link)
                <li role="presentation" ><a href="{{$link['url']}}" target='_blank'>{{$link['label']}}</a></li>
                @endforeach

                <li role="presentation" @if(Request::path()=='community') class="active" @endif><a href="/community">{{trans('layout.nav.contributors')}}@if(Request::path()=='community') <span class="sr-only">(目前頁面)</span> @endif</a></li>

                @if(LaravelLocalization::getCurrentLocale() === 'zh-TW')
                <li role="presentation" @if(Request::path()=='contribute') class="active" @endif><a href="/contribute">新增{{ config('nomadic.global.subject') }}@if(Request::path() == 'contribute') <span class="sr-only">(目前頁面)</span> @endif</a></li>

                @endif
                <!--
                <li role="presentation"><a href="https://www.facebook.com/groups/561078630763040/" target='_blank'>{{trans('layout.nav.group')}}</a></li>
                <li role="presentation"><a href="https://www.facebook.com/cafenomad.tw/" target='_blank'>{{trans('layout.nav.fan-page')}}</a></li>
                -->
                <!--
                <li role="presentation"><a href="/review" target='_blank'>最佳評鑑</a></li>
                -->
                @if(LaravelLocalization::getCurrentLocale() === 'zh-TW')
                <!--
                <li role="presentation" @if(Request::path()=='events') class="active" @endif><a href="/events">佈告欄@if(Request::path()=='events') <span class="sr-only">(目前頁面)</span> @endif</a></li>
                -->
                @endif

                @if(LaravelLocalization::getCurrentLocale() === 'zh-TW')
                <!--
                <li role="presentation" @if(Request::path()=='apps') class="active" @endif><a href="/apps">Apps</a></li>
                -->
                @endif

                @if(LaravelLocalization::getCurrentLocale() === 'zh-TW')
                <!--
                <li role="presentation" @if(Request::path()=='donate') class="active" @endif><a href="/donate">{{trans('layout.nav.donate')}} @if(Request::path()=='donate') <span class="sr-only">(目前頁面)</span> @endif</a></li>
                -->
                @endif
                <!--
                <li role="presentation"><a href="https://www.facebook.com/%E5%92%96%E5%95%A1%E5%BB%B3%E5%B0%8F%E6%95%85%E4%BA%8B-2118777268348018/" target='_blank'>咖啡廳小故事</a></li>
                -->
              </ul>

              <ul class="nav navbar-nav navbar-right">
                  @if(Auth::check())
                      <li><a href="/user/{{Auth::user()->id}}" style="padding: 0;"><img src='{{ Auth::user()->profile->avatar }}'></a></li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            Exp.{{ Auth::user()->getScore() }}
                         <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href='/user/{{Auth::user()->id}}'>
                                    <i class="fa fa-user-o"></i>
                                    &nbsp;
                                    個人資訊總覽
                                </a>
                            </li>
                            <!--
                            <li>
                                <a href='/calendar/my'>
                                    <i class="fa fa-calendar"></i>
                                    &nbsp;
                                    我的行事曆
                                </a>
                            </li>
                            -->
                            <!--
                            <li>
                                <a href='/user/{{Auth::user()->id}}/map'>
                                    <i class="fa fa-map-o"></i>
                                    &nbsp;
                                    我的地圖
                                </a>
                            </li>
                            -->
                            <li>
                                <a href='/logout'>
                                    <i class="fa fa-power-off"></i>
                                    &nbsp;
                                    登出
                                </a>
                            </li>
                        </ul>
                      </li>
                  @else
                      <li><a href="/login?path={{Request::path()}}&cafe_id=">{{trans('util.login')}}</a></li>
                  @endif

              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
        @endif

        @yield('content')

        <script>
            $(document).ready(function(){
                var cafeId = window.location.hash.substr(1);

                if (!cafeId) return;

                var modalId = $('.modal[data-uuid="' + cafeId + '"]').attr('id');

                $('#' + modalId).modal('show');
            });

        </script>

        <!-- Modal -->
        <div class="modal fade" id="city-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel" style='text-align: center;'>選擇{{Config::get('nomadic.global.category')}}</h4>
              </div>

              <div class="modal-body">

                  <div class='row no-padding'>
                      @foreach(Modules\NomadiCore\City::getOnlineCities() as $city)
                      <div class='col-md-6' style='padding-left: 10px; padding-right: 10px;'>
                          <div class='city-box'>
                              <div class='name'>{{Config::get('city.' . $city . '.zh')}}</div>
                              <div class='navigation'>
                                  <a href='/{{$city}}' class='btn btn-default'><i class="fa fa-home"></i>&nbsp; {{trans('global.mode.homepage')}}</a>
                                  <a href='/{{$city}}/list' class='btn btn-default'><i class="fa fa-list"></i>&nbsp; {{trans('global.mode.list')}}</a>
                                  <a href='/{{$city}}/map' class='btn btn-default'><i class="fa fa-globe"></i>&nbsp; {{trans('global.mode.map')}}</a>
                              </div>
                          </div>
                      </div>
                      @endforeach
                  </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default btn-block" data-dismiss="modal">取消</button>
              </div>
            </div>
          </div>
        </div>

        @include('nomadicore::partial/_photo-swipe')

    </body>
</html>
