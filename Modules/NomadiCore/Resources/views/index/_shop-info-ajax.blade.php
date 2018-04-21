<div class='ajax-box' onclick="openModalByUuid('{{$cafe->id}}', 'flaneur')">

    <header>
        <img src='{{$cafe->fan_page->imageUrl()}}'>
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

    <!--
    <p>{{$cafe->name}}</p>
    <p style='color: #9E9E9E; font-size: 13px;'>
        @if($cafe->recommendations->count() > 0)
            有 {{$cafe->recommendations->count()}} 位 nomad 去過。
        @else
            還沒有 nomad 去過。
        @endif
    </p>
    -->

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
