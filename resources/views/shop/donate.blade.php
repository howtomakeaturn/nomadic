@extends('layout')

@section('content')

<br>

<div class='container'>
    <div class='row'>
        <div class='col-md-12'>
            <div style="font-size: 3em; text-align: center; margin-bottom: 0.25em; line-height: 1;">{{$cafe->name}}</div>

            @include('shop/_nav')

            <!--
            <div style="font-size: 2em; text-align: center; margin-bottom: 1em;">贊助特別曝光次數統計</div>
            -->
        </div>
    </div>
    <div class="row">
        @foreach($cafe->donations->sortBy('start_date') as $donation)
        <div class="col-md-3">
            <div class="donate-report">
                <div class='date-label'>
                    {{$donation->start_date->month}}月{{$donation->start_date->day}}日
                    ~
                    {{$donation->end_date->month}}月{{$donation->end_date->day}}日
                </div>
                <div class="stats">
                    <div class="title">清單模式下有</div>
                    <div class="number">{{number_format($donation->listModeCount())}}</div>
                    <div>次曝光</div>
                </div>
                <div class="stats">
                    <div class="title">地圖模式下有</div>
                    <div class="number">{{number_format($donation->mapModeCount())}}</div>
                    <div>次曝光</div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="note">註1：在清單模式頁面，最上方的相簿輪播顯示一次，計為一次</div>
            <div class="note">註2：在地圖模式頁面，找店小幫手的相簿輪播顯示一次，計為一次</div>
            <div class="note">註3：統計系統在4月11日上線，此前的曝光數據沒有完整記錄進資料庫裡</div>
        </div>
    </div>
</div>

<br>
<br>

<style>

    .donate-report {
        margin: 0 auto;
        text-align: center;
        margin-bottom: 2em;
        border: 1px solid #757575;
        padding-top: 20px;
    }
    .date-label {
        background-color: #2196F3;
        color: white;
        padding: 5px 10px;
        display: inline-block;
        margin-bottom: 1em;
        border-radius: 5px;
    }
    .donate-report .period {
        font-size: 1.5em;
    }
    .donate-report .stats{
        margin-bottom: 1em;
    }
    .donate-report .stats .title {
        font-size: 1.5em;
    }
    .donate-report .stats .number {
        font-size: 4em;
        color: #2196F3;
    }
    .note {
        font-size: 14px;
        text-align: center;
    }
</style>

@include('partial/_footer')

@endsection
