<div class='entry'>
    對
    <a href='/shop/{{$cafeTag->cafe->id}}'><span style='font-weight: bold;'>{{ $cafeTag->cafe->name }}</span></a>
    加上標籤：
    {{$cafeTag->tag->name}}

    <span class="timestamp">{{$cafeTag->created_at->format('Y-m-d H:i')}}</span>

</div>
