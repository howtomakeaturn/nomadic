<div class='entry'>
    <!--
    <img src="{{$rec->user->profile->avatar}}" style="border-radius: 50%;">
    <span style='color: darkgreen; '>{{ $rec->user->name }}</span>
    -->
    造訪過
    <a href='/shop/{{$rec->cafe->id}}'><span style='font-weight: bold;'>{{ $rec->cafe->name }}</span></a>

    <span class="timestamp">{{$rec->created_at->format('Y-m-d H:i')}}</span>

</div>
