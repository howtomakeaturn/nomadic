<div class="bg -grey">

    <div class='section-title'>
        <div class='name'>
            {{trans('homepage.feature-1-title')}}
        </div>
        <div class='description'>
            {{trans('homepage.feature-1-subtitle')}}
        </div>
    </div>

    <div class='container'>
        <div class='row no-padding'>
            @foreach($boxCafes as $cafe)
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
                                  <div class='name'>{{trans('util.s-fields.wifi')}}</div>
                                  <div class='value {{starClass($cafe->wifi)}}'>{{$cafe->presentStar('wifi')}}</div>
                              </div>
                              <div class='rating-box'>
                                  <div class='name'>{{trans('util.s-fields.seat')}}</div>
                                  <div class='value {{starClass($cafe->seat)}}'>{{$cafe->presentStar('seat')}}</div>
                              </div>
                              <div class='rating-box'>
                                  <div class='name'>{{trans('util.s-fields.quiet')}}</div>
                                  <div class='value {{starClass($cafe->quiet)}}'>{{$cafe->presentStar('quiet')}}</div>
                              </div>
                              <div class='rating-box'>
                                  <div class='name'>{{trans('util.s-fields.tasty')}}</div>
                                  <div class='value {{starClass($cafe->tasty)}}'>{{$cafe->presentStar('tasty')}}</div>
                              </div>
                          </div>
                          <div class="col-xs-6">
                              <div class='rating-box'>
                                  <div class='name'>{{trans('util.s-fields.food')}}</div>
                                  <div class='value {{starClass($cafe->food)}}'>{{$cafe->presentStar('food')}}</div>
                              </div>
                              <div class='rating-box'>
                                  <div class='name'>{{trans('util.s-fields.cheap')}}</div>
                                  <div class='value {{starClass($cafe->cheap)}}'>{{$cafe->presentStar('cheap')}}</div>
                              </div>
                              <div class='rating-box'>
                                  <div class='name'>{{trans('util.s-fields.music')}}</div>
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

<style>
    #shop-info {
        background-color: white;
        border: 1px solid #E0E0E0;
        padding: 10px 15px;
        margin-bottom: 10px;
    }

    #shop-info header {
        margin-bottom: 10px;
    }


    #shop-info header img {
        border-radius: 50%;
        width: 40px;
    }

    #shop-info .title {
        display: inline-block;
        width: calc(100% - 50px);
        vertical-align: top;
        padding-left: 10px;
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
