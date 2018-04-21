<div>
    <div class="row">
      <div class="col-xs-6">
          <div class='rating-box'>
              {{trans('util.fields.wifi')}}
              <div class='value {{starClass($review->wifi)}}'>{{$review->presentStar('wifi')}}</div>
          </div>
          <div class='rating-box'>
              {{trans('util.fields.seat')}}
              <div class='value {{starClass($review->seat)}}'>{{$review->presentStar('seat')}}</div>
          </div>
          <div class='rating-box'>
              {{trans('util.fields.quiet')}}
              <div class='value {{starClass($review->quiet)}}'>{{$review->presentStar('quiet')}}</div>
          </div>
          <div class='rating-box'>
              {{trans('util.fields.tasty')}}
              <div class='value {{starClass($review->tasty)}}'>{{$review->presentStar('tasty')}}</div>
          </div>
      </div>
      <div class="col-xs-6">
          <div class='rating-box'>
              {{trans('util.fields.food')}}
              <div class='value {{starClass($review->food)}}'>{{$review->presentStar('food')}}</div>
          </div>
          <div class='rating-box'>
              {{trans('util.fields.cheap')}}
              <div class='value {{starClass($review->cheap)}}'>{{$review->presentStar('cheap')}}</div>
          </div>
          <div class='rating-box'>
              {{trans('util.fields.music')}}
              <div class='value {{starClass($review->music)}}'>{{$review->presentStar('music')}}</div>
          </div>
      </div>
    </div>
</div>
