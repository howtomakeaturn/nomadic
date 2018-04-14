@extends('layout')

@section('head')
<link rel="stylesheet" href="/css/star-rating.css">
@endsection

@section('content')
<div class='container'>
    <div class='row'>
        <div class='col-md-6'>

            <form method='post' action='/delete-review'>
                <input type="hidden" name="review_id" value="{{ $review->id }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-default btn-sm" onclick="if ( confirm('確定要刪除這則評分嗎？') ) { this.disabled=true; this.value='處理中，請稍候...'; this.form.submit(); }else{return false;};">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                    刪除我的這則評分
                </button>
            </form>

            <h3>您已經對「<span class='text-primary'>{{ $entity->name }}</span>」評分過了。</h3>
            <p style='margin-top: 15px; margin-bottom: 10px;'>
                下面是您對「{{$entity->name}}」的評分，您隨時可以修改。
            </p>
        </div>
    </div>
    <div class='row'>
        <div class='col-md-6'>

            <form method='post' action='/update-review'>

                @include('_star-rating-form-content', ['review' => $review])

                <input type="hidden" name="review_id" value="{{ $review->id }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" onclick="return wannaSubmitForm();" class="btn btn-primary btn-lg">送出我修改過的評分</button>

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
