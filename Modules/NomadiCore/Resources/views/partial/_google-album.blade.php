
@foreach($result['result']['photos'] as $index => $photo)
<div class='_thumbnail'>
    <img class='photo @if($photo['height'] > $photo['width']) portrait @endif' src='{{generate_photo_url($photo['photo_reference'], 1000, 300)}}'>
</div>
@endforeach
