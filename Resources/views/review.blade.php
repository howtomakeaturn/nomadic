@extends('nomadicore::layout')

@section('head')
<link rel="stylesheet" href="/css/star-rating.css">
@endsection

@section('content')
<div class='container'>
    <div class='row'>
        <div class='col-md-12'>
            <h3>您正在對「<a href='/shop/{{$entity->id}}'><span class='text-primary'>{{ $entity->name }}</span></a>」評分。</h3>
            <p style='margin-top: 15px; margin-bottom: 10px;'>
                如果之後對「{{$entity->name}}」有新評價，您隨時可以回來修改評分。
            </p>
        </div>
    </div>
    <div class='row'>

        <div class='col-md-6'>
            <form method='post' action='/submit-review'>

                @include('nomadicore::_star-rating-form-content')

                <input type="hidden" name="entity_id" value="{{ $entity->id }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" onclick="return wannaSubmitForm();" class="btn btn-primary btn-lg">送出評分</button>

            </form>
            <br>
            <div class="alert alert-info" role="alert">
                新的評分不會直接蓋過舊的評分。<br>
                系統會定期統計分數，並在網站上顯示中位數。
            </div>

        </div>
        <div class='col-md-6'>
        </div>
    </div>
</div>

@endsection
