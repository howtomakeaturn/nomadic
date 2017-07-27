@extends('layout')
@section('head')
<style>
    .greeting-box {
        text-align: center;
        padding-top: 12px;
        line-height: 1.7;
    }
    .greeting-box .title {
        font-size: 24px;
        padding-left: 40px;
        padding-right: 40px;
    }
    .greeting-box .slogan {
        font-size: 16px;
        margin-top: 10px;
        padding-left: 40px;
        padding-right: 40px;
    }
    @media (min-width: 768px) {
        .greeting-box {
            padding-top: 30px;
        }
        .greeting-box .title {
            font-size: 36px;
        }
        .greeting-box .slogan {
            font-size: 24px;
        }
    }
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
</style>
@endsection
@section('content')


<div class='greeting-box'>
    <div class='title'>
        {{Config::get('city')[$city]['zh']}}{{$tag->name}}的咖啡廳清單：共收錄{{$cafes->count()}}間網友推薦的店
    </div>
    <br>
    <br>
    <!--
    <div class='slogan'>

        出沒在不同咖啡廳，找地方工作、看書、開會、聊天的人們。<br>

        下面是由台灣各地的 cafe nomad 社群，一起整理的咖啡廳清單與地圖。<br>

    </div>
    -->
</div>

<div class="bg -grey">
    <div class='container'>
        <div class='row no-padding'>
            @foreach($cafes as $cafe)
            <div class='col-md-3' style='padding-left: 5px; padding-right: 5px;'>
                <div class='cafe-summary' onclick="openModalByUuid('{{$cafe->id}}', 'pure')">
                    <div id='shop-info'>

                        <header>
                            @if($cafe->fan_page)
                            <img src='{{$cafe->fan_page->imageUrl()}}'>
                            @endif
                            <div class='title'>
                                <div class='name'>
                                {{$cafe->name}}
                                </div>
                                <div>
                                    <span class="text">
                                        @if($cafe->recommendations->count() > 0)
                                            有 {{$cafe->recommendations->count()}} 位 nomad 去過。
                                        @else
                                            還沒有 nomad 去過。
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </header>

                        <div class="row">
                          <div class="col-xs-6">
                              <div class='rating-box'>
                                  wifi 穩定
                                  <div class='value {{starClass($cafe->wifi)}}'>{{$cafe->presentStar('wifi')}}</div>
                              </div>
                              <div class='rating-box'>
                                  通常有位
                                  <div class='value {{starClass($cafe->seat)}}'>{{$cafe->presentStar('seat')}}</div>
                              </div>
                              <div class='rating-box'>
                                  安靜程度
                                  <div class='value {{starClass($cafe->quiet)}}'>{{$cafe->presentStar('quiet')}}</div>
                              </div>
                              <div class='rating-box'>
                                  咖啡好喝
                                  <div class='value {{starClass($cafe->tasty)}}'>{{$cafe->presentStar('tasty')}}</div>
                              </div>
                          </div>
                          <div class="col-xs-6">
                              <div class='rating-box'>
                                  東西好吃
                                  <div class='value {{starClass($cafe->food)}}'>{{$cafe->presentStar('food')}}</div>
                              </div>
                              <div class='rating-box'>
                                  價格便宜
                                  <div class='value {{starClass($cafe->cheap)}}'>{{$cafe->presentStar('cheap')}}</div>
                              </div>
                              <div class='rating-box'>
                                  裝潢音樂
                                  <div class='value {{starClass($cafe->music)}}'>{{$cafe->presentStar('music')}}</div>
                              </div>
                          </div>
                      </div>
                    </div>

                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@include('partial/_tag-map-section')

<br>

<style>

    #shop-info {
        background-color: white;
        border: 1px solid #E0E0E0;
        padding: 10px 15px;
        margin-bottom: 10px;
    }

    #shop-info:hover {
        cursor: pointer;
    }

    #shop-info header {
        margin-bottom: 10px;
    }


    #shop-info header img {
        border-radius: 50%;
        width: 40px;
        padding-right: 10px;
    }

    #shop-info .title {
        display: inline-block;
        width: calc(100% - 50px);
        vertical-align: top;
    }

    #shop-info .title .name {
        overflow: hidden;
        white-space:nowrap;
        text-overflow:ellipsis;
    }

    #shop-info .text {
        color: #9E9E9E;
        font-size: 13px;
    }
</style>

@include('_open-modal')

@include('partial/_footer')

@endsection
