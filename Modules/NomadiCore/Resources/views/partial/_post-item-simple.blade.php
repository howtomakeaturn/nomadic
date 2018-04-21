<div class='post-item'>
    <img src='{{$discussion->posts->last()->user->profile->avatar}}' style="border-radius: 50%; width: 40px;">
    <a href='/post/{{$discussion->id}}'>
        <div class='title'>
            <i class="fa fa-comment-o" aria-hidden="true"></i>
            {{$discussion->title}}
        </div>
    </a>
</div>

<style>
.post-item {
    width: 100%;
}

@media (min-width: 768px) {
    .post-item {
        width: 700px;
    }
}

.post-item:hover {
}

.post-item img {
    display: inline-block;
}

.post-item a {
    display: inline-block;
    vertical-align: top;
    margin-left: 0px;

    width: calc(100% - 60px);
}

@media (min-width: 768px) {
    .post-item a {
        vertical-align: baseline;
    }
}

.post-item a:hover {
    text-decoration: none;
}

.post-item .title {
    margin: 0px;
    /*
    color: #616161;
    */

}

</style>
