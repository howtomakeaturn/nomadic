@extends('layout')

@section('content')
<div class='container'>
    <div class='row'>
        <div class='col-md-12'>
            <h3><a href='/shop/{{$cafe->id}}'>{{$cafe->name}}</a>的全部評價</h3>
        </div>
    </div>
    <div class='row'>
        @foreach($cafe->validReviews() as $review)
        <div class='col-md-6'>
            <div class='reviewer-box'>
                @if($review->user)
                    <img src='{{$review->user->profile->avatar}}' style='border-radius: 50%;'>
                @else
                    <img src='/img/anonymous-photo-50x50.jpg' style='border-radius: 50%;'>
                @endif
                <div class='body'>
                    @if($review->user)
                        <div class='name'>{{$review->user->name}}</div>
                    @else
                        <div class='name'>未紀錄到名稱的使用者（系統早期未強制要求登入評分）</div>
                    @endif
                    <div class='summary'>{{$review->presentSummary()}}</div>
                    <div class='timestamp'><i class='fa fa-clock-o'></i>&nbsp;{{$review->created_at->format('m-d H:i')}}</div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
    .reviewer-box {
        padding: 10px 5px;
        border-bottom: 1px solid #bdbdbd;
    }
    .reviewer-box > img {
        display: inline-block;
    }
    .reviewer-box > .body {
        display: inline-block;
        width: calc(100% - 70px);
        vertical-align: top;
        padding-left: 10px;
    }
    .reviewer-box > .body > .name {
        margin-bottom: 5px;
    }
    .reviewer-box > .body > .timestamp {
        margin-top: 5px;
        color: #9E9E9E;
    }
</style>
@endsection
