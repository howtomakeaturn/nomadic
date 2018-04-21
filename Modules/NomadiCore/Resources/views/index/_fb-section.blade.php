
<div class='bg -grey'>

    <div class='section-title'>
        <div class='name'>
            {{trans('homepage.feature-3-title')}}
        </div>
        <div class='description'>
            {{trans('homepage.feature-3-subtitle')}}
        </div>
    </div>

    <div class='container'>
        <div class='row no-padding'>
            @foreach($fbFeeds as $feed)
                <div class='col-md-3' style='padding-left: 5px; padding-right: 5px;'>
                    <div class='fb-post' data-cafe-id='{{$feed->fan_page->cafe->id}}'>
                        <header>
                            <img src='{{$feed->fan_page->imageUrl()}}' onclick="openModalByUuid('{{$feed->fan_page->cafe->id}}', 'pure')">
                            <div class='title'>
                                <div class='name' onclick="openModalByUuid('{{$feed->fan_page->cafe->id}}', 'pure')">
                                {{$feed->fan_page->cafe->name}}
                                </div>
                                <div>
                                    <span class="timestamp">
                                        <?php Carbon\Carbon::setLocale('zh-TW'); ?>
                                        {{$feed->published_at->diffForHumans()}}
                                    </span>
                                    <span class='dot'> · </span>
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
                </div>
            @endforeach
        </div>
    </div>
</div>

<style>
.fb-post {
    background-color: white;
    border: 1px solid #E0E0E0;
    padding: 15px;
    margin-bottom: 20px;
    line-height: 1.7em;
    word-wrap:break-word;
    overflow: auto;
}

@media (min-width: 768px) {
    .fb-post {
        height: 350px;
    }
}

.fb-post header {
    margin-bottom: 10px;
}
.fb-post header img {
    border-radius: 50%;
    width: 50px;
}

.fb-post header img:hover {
    cursor: pointer;
}

.fb-post header .title {
    display: inline-block;
    width: calc(100% - 60px);
    vertical-align: top;
    padding-left: 10px;
}

.fb-post .name:hover {
    cursor: pointer;
    text-decoration: underline;
}

.fb-post .timestamp {
    color: #9E9E9E;
    font-size: 13px;
}

.fb-post .dot {
    color: #9E9E9E;
    font-size: 13px;
}

.fb-post .address {
    color: #9E9E9E;
    font-size: 13px;
}

</style>
