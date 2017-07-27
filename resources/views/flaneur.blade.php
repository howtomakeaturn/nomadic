@extends('layout')
@section('head')

<style>
    #map {
        height: 200px;
        width: 100%;
    }

    body {
        background-color: #EEEEEE;
    }

    .ad-container {
        direction: rtl;
        margin-bottom: 15px;
    }

</style>

@endsection
@section('content')

    <div class='container'>
        <div class='row'>
            <div class='col-md-3'>

            </div>

            <div class='col-md-6'>
                <div class='shop-posts'>
                    @foreach($feeds->take(25) as $feed)
                        @include('flaneur/_fb-posts')
                    @endforeach
                </div>
                <div id='load-more'>
                    <button class='btn btn-default btn-block'>看更多店家 Facebook 動態</button>
                </div>
            </div>

            <div class='col-md-3'>
                <?php /*
                @include('index/_new-cafe-promotion-side')
                */ ?>
                @if(!Layout::isMobile())
                @include('index/_shop-info')
                @endif
            </div>
        </div>
    </div>

    <br>

    @include('partial/_footer')

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

            var page = 1;

            $('#load-more > button').click(function(){

                page += 1;

                $.get('/ajax/flaneur?page=' + page + '&city={{$city}}', function(res){
                    if ($.trim(res) !== '') {
                        $('.shop-posts').append(res);
                        parseTimestamp();
                    } else {
                        $('#load-more > button').text('沒有其他動態了');
                        $('#load-more > button').addClass('disabled');
                    }
                });

            });


        });
    </script>

    <style>
        .fb-post {
            background-color: white;
            border: 1px solid #E0E0E0;
            padding: 15px;
            margin-bottom: 20px;
            line-height: 1.7em;
            word-wrap:break-word;
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

    @include('_open-modal')

@endsection
