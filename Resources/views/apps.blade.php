@extends('layout')
@section('head')
<style>
    body {
        background-color: #EEEEEE;
    }
</style>
@endsection
@section('content')

<div class='container'>
    <div class='row'>
        <div class='col-md-12'>
            <h3>Cafe Nomad Apps</h3>
            <br>
            <div style='line-height: 1.7em;'>
            許多軟體工程師利用 Cafe Nomad 的資料API，做出了各種應用程式。<br>
            您如果也開發了應用程式，可以填寫下列表單，我會手動把它加進此頁。<br>
            <a href='https://goo.gl/forms/wwUBfE4jgDPhY8272'>https://goo.gl/forms/wwUBfE4jgDPhY8272</a><br>
            註：這些應用程式會以隨機的順序呈現在此頁
            </div>
        </div>
    </div>
    <br>
    <br>
    <div class='row'>
        @foreach($apps as $index => $app)
        <div class='col-md-3'>
            @include('_app-card')
        </div>
        @endforeach
    </div>
</div>

<br>

@endsection
