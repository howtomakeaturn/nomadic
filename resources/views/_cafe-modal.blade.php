<div class="modal fade" id="modal-{{$cafe->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-uuid="{{ $cafe->id }}" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel" style='margin-bottom: 10px;'>
            <span class='cafe-name'>{{$cafe->name}}@if($cafe->status == App\Cafe::CLOSED_STATUS)（已歇業）@endif</span>
        </h4>
        @include('cafe-modal/_like-box')
      </div>
      <div class="modal-body">

          <div class="row">

              <div class='col-md-12'>
                  @if($cafe->tags->count() === 0)
                  <small><i>{{trans('util.text.no-tags-yet')}}</i></small>
                  @endif

                  @foreach($cafe->uniqueTags()->sortByDesc(function($tag)use($cafe){return $tag->countOnCafe($cafe);}) as $tag)
                  <a class='cafe-tag' href='/{{$cafe->city}}/tag/{{$tag->id}}'>
                    {{$tag->name}}

                  <span style='font-size: 12px; vertical-align: super;'>{{$tag->countOnCafe($cafe)}}</span>
                  </a>
                  @endforeach
                  <a href='/shop/{{$cafe->id}}/tag' class='btn btn-info btn-sm' target="_blank">
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
                    <div class='value {{starClass($cafe->getReviewFieldValue($field['key']))}}'>
                      @if($cafe->getReviewFieldValue($field['key']))
                      {{number_format($cafe->getReviewFieldValue($field['key']), 1)}}  ★
                      @else

                      @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row">
            <div class='col-xs-12'>
                @if($cafe->reviews->count() === 0)
                <span class='grey' style='font-size: 12px;'>{{trans('util.text.no-reviews')}}</span>
                @elseif($cafe->reviews->count() === 1)
                <span class='grey' style='font-size: 12px;'>{{trans('util.text.1-reviews_')}} <a href='/reviewers/{{$cafe->id}}' target='_blank'>{{trans('util.text._1-reviews')}}</a></span>
                @else
                <span class='grey' style='font-size: 12px;'>{{trans('util.text.n-reviews_')}} <a href='/reviewers/{{$cafe->id}}' target='_blank'>{{$cafe->validReviews()->count()}} {{trans('util.text._n-reviews')}}</a></span>
                @endif

                <a class="btn btn-info btn-sm" target="_blank" href='/review/{{ $cafe->id }}'><i class='fa fa-star'></i>&nbsp;{{Config::get('nomadic.info-modal.write-a-review')}}</a>
            </div>
        </div>
        <hr />
        <div class='row'>
          @foreach(Config::get('info-fields') as $field)
          <div class="col-xs-6">
              <div class='rating-box'>
                {{$field['label']}}
                <div class='value'>
                  {{$cafe->getInfoFieldValue($field['key'])}}
                </div>
              </div>
          </div>
          @endforeach
        </div>
          <div class='row'>
              <div class='col-xs-12'>
                  <a class="btn btn-info btn-sm" target="_blank" href='/editing/{{ $cafe->id }}'><i class='fa fa-pencil-square-o'></i>&nbsp;{{trans('util.action.update-info')}}</a>
              </div>
          </div>

          <hr>
          <div class='row'>
              <div class='col-xs-12'>
                  @include('cafe-modal/_comment-box')
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
    var parentPath = '/{{$cafe->city}}/map';
@elseif(Request::get('mode') === 'list')
    var parentPath = '/{{$cafe->city}}/list';
@elseif(Request::get('mode') === 'flaneur')
    var parentPath = '/{{$cafe->city}}/flaneur';
@endif

@if(Request::get('mode') !== 'pure')

$('#modal-{{$cafe->id}}').on('hidden.bs.modal', function () {
    document.title = parentTitle;

    window.history.pushState(null, parentTitle, parentPath);
});

$('#modal-{{$cafe->id}}').on('shown.bs.modal', function() {
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

        @foreach($cafe->validPhotos() as $index => $photo)
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

    $('#modal-{{$cafe->id}} ._thumbnail > img.photo').click(function(){
        var index = $('#modal-{{$cafe->id}} ._thumbnail > img.photo').index($(this))
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
