<div class='thanks-box' onclick="moveMap({lat: {{$cafe->latitude}},lng: {{$cafe->longitude}}}, '{{$cafe->id}}')">
    <p>
        @if($cafe->summaryScore() > 0)
        <span class="blue">{{number_format( (float) $cafe->summaryScore(), 1, '.', '' )}} ★ </span>
        @endif
        <span class="name">{{$cafe->name}}</span>
    </p>
    <div class='album'>
        @if($cafe->photos->count() > 0)
          @foreach($cafe->validPhotos()->shuffle()->take(Layout::isMobile() ? 2 : 3) as $index => $photo)
              <?php $image = '/upload_photos/width-300/' . $photo->name; ?>
              <div class='_thumbnail -small'>
                  <img class='photo @if($photo->height > $photo->width) portrait @endif' src='{{$image}}'>
              </div>
          @endforeach
        @endif
    </div>
</div>

<style>
    .thanks-box:hover {
        cursor: pointer;
    }
    .thanks-box .name:hover {
        text-decoration: underline;
    }
</style>

<?php
    Modules\NomadiCore\DailyEventCounter::track('display-shop-map', $cafe->id, date('Y-m-d'));
 ?>
