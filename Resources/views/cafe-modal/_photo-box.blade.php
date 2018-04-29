<div class='row'>
    <div class='col-xs-12'>
        @if($entity->photos->count() > 0)
          <div style='text-align: center;'>
          @foreach($entity->validPhotos() as $index => $photo)
              <?php $image = '/upload_photos/width-600/' . $photo->name; ?>
              <div class='_thumbnail'>
                  <img class='photo @if($photo->height > $photo->width) portrait @endif' src='{{$image}}'>
                  <img src='{{ $photo->user->profile->avatar }}' style='position: absolute; bottom: 3px; left: 5px; border-radius: 50%; width: 40px;'>
                  @if(Auth::check() && Auth::user()->id == $photo->user_id)
                  <span class='btn btn-default btn-sm remove-img-btn' data-id='{{$photo->id}}'>×</span>
                  @endif
              </div>
          @endforeach
          </div>
          <br>
          <br>

        @else
        <p class='n'>目前還沒有人提供這間店的照片。</p>
        @endif


        @if(Auth::check())
        <form action="/upload-photo" method="post" enctype="multipart/form-data">
            <input type="hidden" name='entity_id' value='{{$entity->id}}'>
            <input type="file" name="image" required>
            {{ csrf_field() }}
            <button type="submit" class='btn btn-info btn-sm'
              onclick="if ($(this).parent().find('input[type=\'file\']').val() != '') {this.disabled=true; this.innerHTML='處理中，請稍候...'; this.form.submit();} else {return false;}" style="margin-top: 10px;">
              {{trans('util.action.upload-photo')}}
            </button>
        </form>
        @else
        <a href='/login?cafe_id={{$entity->id}}&path={{Request::path()}}' class='btn btn-info btn-sm'><i class='fa fa-camera'></i>&nbsp;{{trans('util.action.upload-photo')}}</a>
        @endif
    </div>
</div>

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
