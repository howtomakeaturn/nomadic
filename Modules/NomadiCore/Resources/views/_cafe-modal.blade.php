<div class="modal cafe-modal" id="modal-{{$entity->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-uuid="{{ $entity->id }}" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel" style='margin-bottom: 10px;'>
            <span class='cafe-name'>{{$entity->name}}@if($entity->status == Modules\NomadiCore\Entity::CLOSED_STATUS)（已歇業）@endif</span>
        </h4>
        @include('nomadicore::cafe-modal/_like-box')
      </div>
      <div class="modal-body">

          <div class="row">

              <div class='col-md-12'>
                  @if($entity->tags->count() === 0)
                  <small><i>{{trans('util.text.no-tags-yet')}}</i></small>
                  @endif

                  @foreach($entity->uniqueTags()->sortByDesc(function($tag)use($entity){return $tag->countOnCafe($entity);}) as $tag)
                  <a class='cafe-tag' href='/{{$entity->city}}/tag/{{$tag->id}}'>
                    {{$tag->name}}
                  </a>
                  @endforeach
                  <a href='/shop/{{$entity->id}}/tag' class='btn btn-info btn-sm' target="_blank">
                      <i class='fa fa-tags'></i>&nbsp;
                      {{trans('util.action.edit-tags')}}
                  </a>
              </div>
          </div>

          <hr style='margin: 15px;'>

          <div class="row">

            @foreach(Config::get('review-fields') as $field)
            <div class="col-xs-6">
              	<div class='rating-box'>
                    {{$field['label']}}
                    <div class='value {{starClass($entity->getReviewFieldValue($field['key']))}}'>
                      @if($entity->getReviewFieldValue($field['key']))
                      {{number_format($entity->getReviewFieldValue($field['key']), 1)}}  ★
                      @else

                      @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row">
            <div class='col-xs-12'>
                @if($entity->reviews->count() === 0)
                <span class='grey' style='font-size: 12px;'>{{trans('util.text.no-reviews')}}</span>
                @elseif($entity->reviews->count() === 1)
                <span class='grey' style='font-size: 12px;'>{{trans('util.text.1-reviews_')}} <a href='/reviewers/{{$entity->id}}' target='_blank'>{{trans('util.text._1-reviews')}}</a></span>
                @else
                <span class='grey' style='font-size: 12px;'>{{trans('util.text.n-reviews_')}} <a href='/reviewers/{{$entity->id}}' target='_blank'>{{$entity->validReviews()->count()}} {{trans('util.text._n-reviews')}}</a></span>
                @endif

                <a class="btn btn-info btn-sm" target="_blank" href='/review/{{ $entity->id }}'><i class='fa fa-pencil-square-o'></i>&nbsp;{{Config::get('nomadic.info-modal.write-a-review')}}</a>
            </div>
        </div>
        <hr />
        <div class='row'>
          @foreach(Config::get('info-fields') as $field)
          <div class="col-xs-6">
              <div class='rating-box'>
                {{$field['label']}}
                <div class='value'>
                  {{ displayInfoField($field, $entity->getInfoFieldValue($field['key'])) }}
                </div>
              </div>
          </div>
          @endforeach
        </div>
        <hr>
        <div class='row'>
            @if(config('nomadic.business-hours-enabled'))
            <div class='col-md-6 col-xs-6'>
              @if($entity->generateBusinessHoursJson() === '{"monday":{"open":"00:00","close":"00:00"},"tuesday":{"open":"00:00","close":"00:00"},"wednesday":{"open":"00:00","close":"00:00"},"thursday":{"open":"00:00","close":"00:00"},"friday":{"open":"00:00","close":"00:00"},"saturday":{"open":"00:00","close":"00:00"},"sunday":{"open":"00:00","close":"00:00"}}')
                <div class='rating-box'>
                    {{trans('util.fields.open-time')}}：{{$entity->open_time}}
                </div>
              @else
                <div class='rating-box'>
                    {!!$entity->present()->businessHoursBox()!!}
                    @if(trim($entity->open_time))
                    （
                    {{$entity->open_time}}
                    ）
                    @endif
                </div>
              @endif
            </div>
            @endif
            <div class='col-md-6 col-xs-12'>
              <div style="margin-bottom: 10px;">
                地址：{{ $entity->address }}
              </div>
              <a class="btn btn-info btn-sm" target="_blank" href='/editing/{{ $entity->id }}'><i class='fa fa-pencil'></i>&nbsp;{{trans('util.action.update-info')}}</a>
            </div>
        </div>
          <hr>
          <div class='row'>
              <div class='col-xs-12'>
                  @include('nomadicore::cafe-modal/_comment-box')
              </div>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>

var parentTitle = '{{ Layout::openGraphTitle() }}';

@if(Request::get('mode') === 'map')
    var parentPath = '/{{$entity->city}}/map';
@elseif(Request::get('mode') === 'list')
    var parentPath = '/{{$entity->city}}/list';
@elseif(Request::get('mode') === 'flaneur')
    var parentPath = '/{{$entity->city}}/flaneur';
@endif

@if(Request::get('mode') !== 'pure')

$('#modal-{{$entity->id}}').on('hidden.bs.modal', function () {
    document.title = parentTitle;

    window.history.pushState(null, parentTitle, parentPath);
});

$('#modal-{{$entity->id}}').on('shown.bs.modal', function() {
    var title = $(this).find('.cafe-name').text();

    var id = $(this).data('uuid');

    window.history.pushState(null, title, "/{{Config::get('nomadic.global.unit-url')}}/" + id);

    document.title = title;
});

@endif

</script>

<script>

$(document).ready(function(){

    var openPhotoSwipe = function(index) {
        var pswpElement = document.querySelectorAll('.pswp')[0];

        // build items array
        var items = [
        ];

        @foreach($entity->validPhotos() as $index => $photo)
        <?php $image = '/upload_photos/width-900/' . $photo->name; ?>
        items.push({
            src: '{{$image}}',
            w: {{$photo->width}},
            h: {{$photo->height}},
            title: "<img src='{{ $photo->user->profile->avatar }}' style='border-radius: 50%; width: 40px;'>"
        });
        @endforeach




        // define options (if needed)
        var options = {
            // optionName: 'option value'
            // for example:
            shareEl: false,
            index: index // start at first slide
        };

        // Initializes and opens PhotoSwipe
        var gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);
        gallery.init();
    };

    $('#modal-{{$entity->id}} ._thumbnail > img.photo').click(function(){
        var index = $('#modal-{{$entity->id}} ._thumbnail > img.photo').index($(this))
        openPhotoSwipe(index);
    });


    $('.remove-img-btn').click(function(){
        if (confirm('刪除這張照片嗎？')) {
            post('/remove-photo', {
                photo_id: $(this).data('id'),
                _token: '{{csrf_token()}}'
            });
        }
    });

});

</script>

<style>
    .remove-btn {
        display: inline-block;
        margin-left: 5px;
        font-weight: bold;
        vertical-align: middle;
    }
    .remove-btn:hover {
        cursor: pointer;
    }
    .remove-img-btn {
        position: absolute;
        font-weight: bold;
        font-size: 14px;
        bottom: 5px;
        right: 5px;
    }
</style>
