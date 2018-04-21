<div class="bg -grey">

    <div class='section-title'>
        <div class='description'>
            近期照片
        </div>
    </div>

    <div class='container'>
        <div class='row no-padding'>
            @foreach($photos->sortByDesc('created_at') as $photo)
            <div class='col-md-3' style='padding-left: 5px; padding-right: 5px;'>
                <div class="feed-box -photo">
                    <header>
                        <img class='userimg' src='{{$photo->user->profile->avatar}}'>
                        <div class='title'>
                            <div class='top'>
                                <!--
                                <a href='#'>{{$photo->user->name}}</a>
                                -->
                                對
                                <a href='/shop/{{$photo->cafe->id}}'>[{{$photo->cafe->presentCity()}}] {{$photo->cafe->name}}</a>
                                拍照
                            </div>
                            <div class='bottom'>
                                <span class='timestamp'>{{$photo->created_at->timestamp}}</span>
                            <div>
                        </div>
                    </header>
                    <section>
                        <img src='/upload_photos/width-600/{{$photo->name}}' style='max-width: 100%; margin-top: 5px;'>
                    </section>
                </div>
            </div>
            @endforeach

            @if($photos->count() === 0)
                <center>
                    <i>這個地區還沒有人上傳照片。</i>
                </center>
            @endif

        </div>
    </div>


</div>
