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
        其它未收錄的店家
    </div>

    <br>

    <div class='slogan'>
        這類店家並不適合去用電腦或看書。<br>
        餐廳類型以外的其它類型，客人拿電腦或書出來應該有點尷尬的店，會被移到這個專屬頁面。<br>
        如果您發現這個頁面上有店家不應該被歸類在此，請透過社團或是粉專反映，我會儘快把它調整回去，感恩！
    </div>

    <br>

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

<br>

@include('partial/_footer')

@endsection
