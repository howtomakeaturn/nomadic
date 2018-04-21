@extends('layout')
@section('head')


@endsection
@section('content')


<div class='container'>
    <div class='row'>
        <div class='col-md-12'>

            <center>
                <h3>目前贊助店家列表</h3>
                <br>
            </center>
            <table class="table table-hover table-striped">
                <tr>
                    <th class="col-md-1">地區</th>
                    <th class="col-md-4">店名</th>
                    <th>贊助曝光時間</th>
                </tr>
                @foreach($cafes as $cafe)
                <tr>
                    <td>{{Config::get("city." . $cafe->city . '.zh')}}</td>
                    <td><a href='/shop/{{$cafe->id}}'>{{$cafe->name}}</a></td>
                    <td>
                        @foreach($cafe->donations as $donation)
                        <div class='date-label'>
                            {{$donation->start_date->month}}月{{$donation->start_date->day}}日
                            ~
                            {{$donation->end_date->month}}月{{$donation->end_date->day}}日
                        </div>
                        @endforeach
                    </td>
                </tr>
                @endforeach
            </table>
            <center>
                <br>
                <h3>之前贊助過的店家列表</h3>
                <br>
            </center>
            <table class="table table-hover table-striped">
                <tr>
                    <th class="col-md-1">地區</th>
                    <th class="col-md-4">店名</th>
                    <th>贊助曝光時間</th>
                </tr>
                @foreach($historyCafes as $cafe)
                <tr>
                    <td>{{Config::get("city." . $cafe->city . '.zh')}}</td>
                    <td><a href='/shop/{{$cafe->id}}'>{{$cafe->name}}</a></td>
                    <td>
                        @foreach($cafe->donations as $donation)
                        <div class='date-label'>
                            {{$donation->start_date->month}}月{{$donation->start_date->day}}日
                            ~
                            {{$donation->end_date->month}}月{{$donation->end_date->day}}日
                        </div>
                        @endforeach
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>

<br>

<style>
    .date-label {
        background-color: #2196F3;
        color: white;
        padding: 5px 10px;
        display: inline-block;
        margin-right: 5px;
        margin-bottom: 5px;
        border-radius: 5px;
    }
</style>

@include('nomadicore::partial/_footer')

@endsection
