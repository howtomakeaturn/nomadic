<div class='thanks-box' onclick="openModalByUuid('{{$cafe->id}}', 'list')">
    <p>
        @if($cafe->summaryScore() > 0)
        <span class="blue">{{number_format( (float) $cafe->summaryScore(), 1, '.', '' )}} ★ </span>
        @endif
        {{$cafe->name}}
    </p>
    <div class='album'>
        @if($cafe->photos->count() > 0)
          @foreach($cafe->validPhotos()->shuffle()->take(3) as $index => $photo)
              <?php $image = '/upload_photos/width-300/' . $photo->name; ?>
              <div class='_thumbnail -small'>
                  <img class='photo @if($photo->height > $photo->width) portrait @endif' src='{{$image}}'>
              </div>
          @endforeach
        @else
        <div class='_thumbnail -small'>
            <img class='photo' src='/android-chrome-192x192.png'>
        </div>
        <div class='_thumbnail -small'>
            <img class='photo' src='/android-chrome-192x192.png'>
        </div>
        <div class='_thumbnail -small'>
            <img class='photo' src='/android-chrome-192x192.png'>
        </div>
        @endif
    </div>

    <?php
        App\DailyEventCounter::track('display-shop-list', $cafe->id, date('Y-m-d'));
     ?>

</div>
