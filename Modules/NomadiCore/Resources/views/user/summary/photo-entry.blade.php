<div class='entry'>
    對
    <a href='/shop/{{$photo->cafe->id}}'><span style='font-weight: bold;'>{{ $photo->cafe->name }}</span></a>
    拍照：

    <span class="timestamp">{{$photo->created_at->format('Y-m-d H:i')}}</span>

    <img src="/upload_photos/width-300/{{ $photo->name }}" style='max-width: 100%;'>
</div>
