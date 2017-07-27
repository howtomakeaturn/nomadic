@extends('layout')
@section('head')

@endsection
@section('content')

<div class='container'>
    <div class='row'>
        <center>
            <h3>資料庫數據</h3>
        </center>
        <!--
        <div class='col-md-6'>
            <div class='statistics-card'>
                <h4>本週數據統計</h4>
                <div class='entry'>
                    <div class='title'>新增店家</div>
                    <div class='value'>{{$stats['today']['cafes']}} 間</div>
                </div>
                <div class='entry'>
                    <div class='title'>欄位編修</div>
                    <div class='value'>{{$stats['today']['editings']}} 筆</div>
                </div>
                <div class='entry'>
                    <div class='title'>新增評分</div>
                    <div class='value'>{{$stats['today']['reviews']}} 筆</div>
                </div>
                <div class='entry'>
                    <div class='title'>新增留言</div>
                    <div class='value'>{{$stats['today']['comments']}} 筆</div>
                </div>
                <div class='entry'>
                    <div class='title'>新增照片</div>
                    <div class='value'>{{$stats['today']['photos']}} 張</div>
                </div>
                <div class='entry'>
                    <div class='title'>API 呼叫次數</div>
                    <div class='value'>{{$stats['today']['api']}} 次</div>
                </div>
                <div class='entry'>
                    <div class='title'>打卡次數</div>
                    <div class='value'>{{$stats['today']['visits']}} 次</div>
                </div>
                <div class='entry'>
                    <div class='title'>想去次數</div>
                    <div class='value'>{{$stats['today']['wishes']}} 次</div>
                </div>
            </div>
        </div>
        -->
        <div class='col-md-12'>
            <div class='statistics-card'>
                <div class='row'>
                    <div class='col-xs-3'>
                        <div class='entry'>
                            <div class='title'>店家</div>
                            <div class='value'>{{$stats['total']['cafes']}} 間</div>
                        </div>
                        <div class='entry'>
                            <div class='title'>欄位編修</div>
                            <div class='value'>{{$stats['total']['editings']}} 筆</div>
                        </div>
                    </div>
                    <div class='col-xs-3'>
                        <div class='entry'>
                            <div class='title'>想去次數</div>
                            <div class='value'>{{$stats['total']['wishes']}} 次</div>
                        </div>

                        <div class='entry'>
                            <div class='title'>留言</div>
                            <div class='value'>{{$stats['total']['comments']}} 筆</div>
                        </div>

                    </div>
                    <div class='col-xs-3'>
                        <div class='entry'>
                            <div class='title'>打卡次數</div>
                            <div class='value'>{{$stats['total']['visits']}} 次</div>
                        </div>
                        <div class='entry'>
                            <div class='title'>照片</div>
                            <div class='value'>{{$stats['total']['photos']}} 張</div>
                        </div>

                    </div>
                    <div class='col-xs-3'>
                        <div class='entry'>
                            <div class='title'>評分</div>
                            <div class='value'>{{$stats['total']['reviews']}} 筆</div>
                        </div>

                        <div class='entry'>
                            <div class='title'>API 呼叫次數</div>
                            <div class='value'>{{$stats['total']['api']}} 次</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <br>
    <div class='row'>
        <center>
            <h3>Google Analytics</h3>
            <p>（畫面為截圖，捲軸無法捲動）</p>
        </center>
        <div class='col-md-12'>
            <div class='ga-graphs'>
                <h4>近期一個月總覽圖表</h4>
                <img src='/img/statistics/month-summary.png'>
                <h4>近期一個月各網址圖表</h4>
                <img src='/img/statistics/month-opens.png'>
                <h4>開站至今總覽圖表</h4>
                <img src='/img/statistics/alltime-summary.png'>
                <h4>開站至今各網址圖表</h4>
                <img src='/img/statistics/alltime-opens.png'>
            </div>
        </div>
    </div>
</div>

@include('partial/_footer')

<style>
    body {
        background-color: #eeeeee;
    }

    .statistics-card {
        background-color: white;
        border: 1px solid #E0E0E0;
        padding: 20px;
    }

    .statistics-card .entry {
        margin-bottom: 10px;
    }

    .statistics-card .entry .title {
        font-weight: bold;
    }

    .statistics-card .entry .value {
        color: #2196F3;
    }

    .ga-graphs > h4 {
        text-align: center;
    }
    .ga-graphs > img {
        max-width: 100%;
        margin-bottom: 20px;
        border: 5px solid black;
    }

</style>

@endsection
