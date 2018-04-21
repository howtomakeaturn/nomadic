<!--
<div class='feed-category-box'>
    <div class='category -active' data-type='all'>全部動態</div>
    <div class='category' data-type='comment'>留言</div>
    <div class='category' data-type='review'>評分</div>
    <div class='category' data-type='photo'>照片</div>
</div>
-->

<div style="color: #616161; margin-bottom: 10px; margin-left: 15px;">社群動態</div>

<div class='feed-block'>
    @include('nomadicore::index/_feeds-content')
</div>

<div id='load-more'>
    <button class='btn btn-default btn-block'>看更多近期社群動態</button>
</div>

<script>

    function filterFeeds()
    {
        type = $('.feed-category-box > .category.-active').data('type');
        if (type === 'all') {
            $('.feed-box').show();
        } else {
            $('.feed-box').hide();
            $('.feed-box' + '.-' + type).show();
        }
    }

    $(document).ready(function(){
        $('.feed-category-box > .category').click(function(){
            $('.feed-category-box > .category').removeClass('-active');
            $(this).addClass('-active');

            type = $('.feed-category-box > .category.-active').data('type');

            @if(App::environment()==='production')
            ga('send', 'event', 'Social Feed', 'Display', type);
            @endif
            console.log('display ' + type);

            filterFeeds();
        });
    });
</script>

<style>

    .feed-category-box {
        background-color: white;
        border: 1px solid #E0E0E0;
        padding: 10px 15px;
        margin-bottom: 10px;
    }

    .feed-category-box > .category {
        display: inline-block;
        padding: 10px 15px;
    }

    .feed-category-box > .category:hover {
        cursor: pointer;
    }

    .feed-category-box > .category.-active {
        font-weight: bold;
        text-decoration: underline;
    }

    /*
    .feed-block {
        background-color: white;
        border: 1px solid #E0E0E0;
    }
    */

    .feed-box {
        background-color: white;
        border: 1px solid #E0E0E0;
        padding: 10px 15px;
        margin-bottom: 10px;
    }

    .feed-box .userimg {
        border-radius: 50%;
        width: 40px;
    }

    .feed-box header {
        color: #9E9E9E;
    }

    .feed-box .userimg {
        display: inline-block;
    }

    .feed-box header .title {
        display: inline-block;
        vertical-align: top;
        margin-left: 5px;
        width: calc(100% - 50px);
    }

    .feed-box header .title .top {
        margin-bottom: 1px;
    }

    .feed-box header .title .bottom {
        font-size: 14px;
    }

    .feed-box section {
        padding-top: 7px;
    }

    .comment-box {
        background-color: white;
        padding: 10px 15px;
        border-bottom: 1px solid #E0E0E0;
    }

    .comment-box > img {
        display: inline-block;
        border-radius: 50%;
    }

    .comment-box > .body {
        display: inline-block;
        vertical-align: top;
        width: calc(100% - 55px);
    }

    .comment-box .body > header > .username {
        display: inline-block;
        color: #757575;
    }

    .comment-box .body > header > .cafename {
        display: inline-block;
    }

    .comment-box .body > header > .timestamp {
        display: inline-block;
        color: #9E9E9E;
    }

    .comment-box .body > section {
        padding-top: 5px;
        padding-bottom: 5px;
        padding-left: 20px;
    }

    .comment-box .body > footer {
        color: #9E9E9E;
        padding-left: 20px;
    }

    .reviews-block {
        margin-top: 10px;
        padding-top: 20px;
        background-color: white;
        border: 1px solid #E0E0E0;
    }
    .reviews-block > header {
        font-weight: bold;
        font-size: 18px;
        padding-left: 20px;
        margin-bottom: 5px;
    }

    #load-more {
        /*
        background-color: white;
        padding: 10px 15px;
        border-bottom: 1px solid #E0E0E0;
        */
        text-align: center;
        margin-bottom: 10px;
    }

</style>

<script>
    function parseTimestamp()
    {
        $('.timestamp').map(function(e){
            if ($.isNumeric($(this).text())) {
                $(this).text(moment.unix($(this).text()).fromNow());
            }
        });
    }

    $(document).ready(function(){

        moment.locale('zh-tw');

        parseTimestamp();

        var index = 1;

        $('#load-more > button').click(function(){

            @if(App::environment()==='production')
            ga('send', 'event', 'Social Feed', 'Load', 'level-' + index);
            @endif
            console.log('load level ' + index);

            $.get('/ajax/feed?index=' + index, function(res){
                $('.feed-block').append(res);
                index += 1;
                parseTimestamp();
                //filterFeeds();
            });
        });
    });
</script>
