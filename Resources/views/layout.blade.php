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

        <link rel="stylesheet" href="/modules/nomadicore/css/style.css?v=12">

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

        @yield('head')

        <link rel="apple-touch-icon" href="/apple-touch-icon.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" href="/favicon-32x32.png?v=1" sizes="32x32">
        <link rel="icon" type="image/png" href="/favicon-16x16.png?v=1" sizes="16x16">
        <link rel="manifest" href="/manifest.json">
        <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="theme-color" content="#ffffff">

        <style>
            .loader {
                border: 10px solid #f3f3f3; /* Light grey */
                border-top: 10px solid #00BCD4; /* Blue */
                border-radius: 50%;
                width: 70px;
                height: 70px;
                animation: spin 0.5s linear infinite;

                position: fixed;
                z-index: 1100;
                left: 0;
                right: 0;
                margin-left: auto;
                margin-right: auto;
                top: 30%;
                display: none;
            }

            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }
        </style>

    </head>
    <body>

        <div class="loader" id="loading"></div>

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
                <li role="presentation" ><a href="#city-modal" data-toggle="modal" data-target="#city-modal">{{trans('nomadicore::layout.nav.choose-')}}{{Config::get('nomadic.global.category')}}</a></li>
                @if(Config::get('nomadic.forum.enabled'))
                <li role="presentation" ><a href="/forum">{{trans('nomadicore::layout.nav.forum')}}</a></li>
                @endif
                <li role="presentation" @if(Request::path()=='community') class="active" @endif><a href="/community">{{trans('nomadicore::layout.nav.contributors')}}@if(Request::path()=='community') <span class="sr-only">(目前頁面)</span> @endif</a></li>
                <li role="presentation" @if(Request::path()=='contribute') class="active" @endif><a href="/contribute">{{trans('nomadicore::layout.nav.new-')}}{{ config('nomadic.global.subject') }}@if(Request::path() == 'contribute') <span class="sr-only">(目前頁面)</span> @endif</a></li>
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
                                  @if(config('nomadic.map-enabled'))
                                  <a href='/{{$city}}/map' class='btn btn-default'><i class="fa fa-globe"></i>&nbsp; {{trans('global.mode.map')}}</a>
                                  @endif
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
