<div class='entry'>
    對
    <a href='/shop/{{$review->cafe->id}}'><span style='font-weight: bold;'>{{ $review->cafe->name }}</span></a>
    評分：
    {{ $review->presentSummary() }}
    <span class='timestamp'>{{$review->created_at->format('Y-m-d H:i')}}</span>
</div>
