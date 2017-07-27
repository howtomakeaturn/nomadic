@extends('layout')
@section('head')

@endsection
@section('content')

<div class='container'>
    <div class="row">
        <div class="col-md-12">
            <a href='/try-i18n'>/try-i18n</a>
        </div>
        <br>
        <br>
        <div class="col-md-12">
            {{ trans('try.greeting') }}
        </div>
    </div>
</div>

@endsection
