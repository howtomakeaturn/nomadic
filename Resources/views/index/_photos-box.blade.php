<div class='reviews-block'>
    <header>近期 Nomad 相片</header>
    @foreach($photos as $photo)
    <div class="comment-box">
        <img src='{{$photo->user->profile->avatar}}'>
        <div class='body'>
            <header>
                <i class="fa fa-camera"></i>
                <div class='cafename'>
                    <a href='/shop/{{$photo->cafe->id}}'>[{{$photo->cafe->presentCity()}}] {{$photo->cafe->name}}</a>
                </div>
            </header>
            <section>
                <img src='/upload_photos/width-600/{{$photo->name}}' style='max-width: 100%; margin-top: 5px;'>
            </section>
        </div>
    </div>
    @endforeach
    <!--
    <a href='#' style='padding: 15px 20px; display: block;'>顯示更多</a>
    -->
</div>
