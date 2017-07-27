@extends('layout')
@section('head')
    @include('partial/business-hours-form-head', ['inputName' => 'business-hours'])
@endsection
@section('content')
<div class='container'>
    <div class='row'>
        <div class='col-md-12'>
            <h3>推薦新增店家</h3>
        </div>
    </div>

    <div class='row'>
        <div class='col-md-6'>

            <form method='post' action='/add-cafe' style='padding-left: 0px;'>
                所在縣市
                <select name='city'>
                    <option value=''>請選擇</option>
                    @foreach(Config::get('city') as $key => $value)
                    <option value='{{ $key }}'>{{ $value['zh'] }}</option>
                    @endforeach
                </select>
                <br>
                <br>

                店名
                <input name='name' type='text' required>（若有分店，請註明分店名）
                <br>
                <br>
                <button class='btn btn-default' onclick="$('.details-info').slideToggle(); return false;">我要提供更完整的評分與資訊</button>
                <br>
                <br>
                <div class='details-info'>
                    @foreach(Config::get('review-fields') as $field)
                    {{$field['label']}}（選填）
                    <input name='{{$field['key']}}' type='number' step='1'  max='5' value="0"> / 5.0 ★
                    <br>
                    <br>
                    @endforeach

                    @foreach(Config::get('info-fields') as $field)
                    {{$field['label']}}（選填）
                    <input name='{{$field['key']}}' type='text'>
                    <br>
                    <br>
                    @endforeach
                </div>

                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-primary btn-lg btn-block">送出店家資料</button>
                <br>
            </form>
        </div>
        <div class='col-md-6'>

        </div>

    </div>
</div>

<style>
    .details-info {
        display: none;
    }
</style>
@endsection
