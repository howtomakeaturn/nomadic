<div class='fb-post' data-cafe-id='{{$feed->fan_page->cafe->id}}'>
    <header>
        <img src='{{$feed->fan_page->imageUrl()}}' onclick="openModalByUuid('{{$feed->fan_page->cafe->id}}', 'flaneur')">
        <div class='title'>
            <div class='name' onclick="openModalByUuid('{{$feed->fan_page->cafe->id}}', 'flaneur')">
            {{$feed->fan_page->cafe->name}}
            </div>
            <div>
                <span class="timestamp">
                    {{$feed->published_at->timestamp}}
                </span>
                <span class='dot'> · </span>
                <span class='address'>{{$feed->fan_page->cafe->address}}</span>
            </div>
        </div>
    </header>
    <div>
        {!!nl2br($feed->message)!!}
    </div>
    @if($feed->has_picture)
    <img src='{{$feed->generatePictureLink()}}' style='max-width: 100%;'>
    @endif
</div>
