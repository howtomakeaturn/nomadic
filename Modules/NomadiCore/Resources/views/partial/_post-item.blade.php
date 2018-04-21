<div class='post-item'>
    <img src='{{$discussion->posts->last()->user->profile->avatar}}' style="border-radius: 50%; width: 40px;">
    <a href='/post/{{$discussion->id}}'>
        <div class='title'>{{$discussion->title}}</div>
        <footer>
            @if($discussion->posts->count() > 1)
            <i class="fa fa-reply" aria-hidden="true"></i>
            @endif
            {{$discussion->posts->last()->user->name}}
            @if($discussion->posts->count() === 1)
            發佈於
            @else
            回覆於
            @endif
            <span class="timestamp">{{$discussion->posts->last()->created_at->timestamp}}</span>
        </footer>
    </a>
    <aside>
        <i class="fa fa-comment-o" aria-hidden="true"></i>
        {{$discussion->posts->count() - 1}}
    </aside>
</div>
