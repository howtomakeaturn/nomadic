<div>
    <div class="row">
      <div class="col-xs-6">
          <div class='rating-box'>
              <div class='name'>{{trans('util.s-fields.wifi')}}</div>
              <div class='value {{starClass($review->wifi)}}'>{{$review->presentStar('wifi')}}</div>
          </div>
          <div class='rating-box'>
              <div class='name'>{{trans('util.s-fields.seat')}}</div>
              <div class='value {{starClass($review->seat)}}'>{{$review->presentStar('seat')}}</div>
          </div>
          <div class='rating-box'>
              <div class='name'>{{trans('util.s-fields.quiet')}}</div>
              <div class='value {{starClass($review->quiet)}}'>{{$review->presentStar('quiet')}}</div>
          </div>
          <div class='rating-box'>
              <div class='name'>{{trans('util.s-fields.tasty')}}</div>
              <div class='value {{starClass($review->tasty)}}'>{{$review->presentStar('tasty')}}</div>
          </div>
      </div>
      <div class="col-xs-6">
          <div class='rating-box'>
              <div class='name'>{{trans('util.s-fields.food')}}</div>
              <div class='value {{starClass($review->food)}}'>{{$review->presentStar('food')}}</div>
          </div>
          <div class='rating-box'>
              <div class='name'>{{trans('util.s-fields.cheap')}}</div>
              <div class='value {{starClass($review->cheap)}}'>{{$review->presentStar('cheap')}}</div>
          </div>
          <div class='rating-box'>
              <div class='name'>{{trans('util.s-fields.music')}}</div>
              <div class='value {{starClass($review->music)}}'>{{$review->presentStar('music')}}</div>
          </div>
      </div>
    </div>
</div>
