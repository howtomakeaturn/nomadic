<div class='entry'>
    <!--
    <img src="{{$comment->user->profile->avatar}}" style="border-radius: 50%;">
    <span style='color: darkgreen; '>{{ $comment->user->name }}</span>
    -->
    對
    <a href='/shop/{{$comment->cafe->id}}'><span style='font-weight: bold;'>{{ $comment->cafe->name }}</span></a>
    留言：

    <span class="timestamp">{{$comment->created_at->format('Y-m-d H:i')}}</span>

    {{$comment->body}}
</div>
