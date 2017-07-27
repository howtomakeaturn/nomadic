@extends('layout')

@section('head')
<style>
    .greeting-box {
        text-align: center;
        padding-top: 12px;
        line-height: 1.7;
    }
    .greeting-box .title {
        font-size: 24px;
        padding-left: 40px;
        padding-right: 40px;
    }
    .greeting-box .slogan {
        font-size: 16px;
        padding-left: 40px;
        padding-right: 40px;
    }
    @media (min-width: 768px) {
        .greeting-box {
            padding-top: 10px;
        }
        .greeting-box .title {
            font-size: 36px;
        }
        .greeting-box .slogan {
            font-size: 24px;
        }
    }

    .bg {
        padding-top: 20px;
        padding-bottom: 20px;
    }
    .bg.-grey {
        background-color: #EEEEEE;
    }
    @media (min-width: 768px) {
        .bg {
            padding-top: 40px;
            padding-bottom: 40px;
        }
    }

    #shop-info {
        background-color: white;
        border: 1px solid #E0E0E0;
        padding: 10px 15px;
        margin-bottom: 10px;
    }
    #shop-info .title:hover, #shop-info .row:hover, #shop-info header img:hover {
        cursor: pointer;
    }
    #shop-info header {
        margin-bottom: 10px;
    }
    #shop-info header img {
        border-radius: 50%;
        width: 40px;
        padding-right: 10px;
    }
    #shop-info .title {
        display: inline-block;
        width: calc(100% - 50px);
        vertical-align: top;
    }
    #shop-info .title .name {
        overflow: hidden;
        white-space:nowrap;
        text-overflow:ellipsis;
    }
    #shop-info .text {
        color: #9E9E9E;
        font-size: 13px;
    }
</style>
@endsection

@section('content')
<div class="greeting-box">
    <div class="slogan">
        搜尋關鍵字：{{ $keyword }}
    </div>
    <div style="text-align: center; margin-bottom: 20px; margin-top: 10px; color: #9E9E9E;">
        共找到
        @if ($cafes->total() >= 1000)
            1000
        @else
            {{ $cafes->total() }}
        @endif
        間咖啡廳
        -
        powered by
        <a href='https://www.algolia.com/' target="_blank"><img src="/img/algolia_logo.jpg" style="height: 14px;"></a>
    </div>

</div>

<div class="bg -grey">

    <div class="container">
        <div class="row">
            {{ $cafes->links('pagination.limit-total') }}
        </div>
    </div>

    <div class="container">
        <div class="row no-padding">
        @foreach ($cafes as $cafe)
            <div class="col-md-3" style="padding-left: 5px; padding-right: 5px;">
                <div class="cafe-summary">
                    <div id="shop-info">
                        <header>
                        @if ($cafe->fan_page)
                            <img src="{{ $cafe->fan_page->imageUrl() }}" onclick="openModalByUuid('{{$cafe->id}}', 'pure')">
                        @endif
                            <div class="title" onclick="openModalByUuid('{{$cafe->id}}', 'pure')">
                                <div class="name">
                                    {{ $cafe->name }}
                                </div>
                                <div>
                                    <span class="text">
                                    @if ($cafe->recommendations->count() > 0)
                                        有 {{$cafe->recommendations->count()}} 位 nomad 去過。
                                    @else
                                        還沒有 nomad 去過。
                                    @endif
                                    </span>
                                </div>
                            </div>
                            <a href='/shop/{{$cafe->id}}' target="_blank" style="position: absolute; top: 10px; right: 15px;"><i class="fa fa-external-link" aria-hidden="true"></i></a>
                        </header>
                        <div class="row" onclick="openModalByUuid('{{$cafe->id}}', 'pure')">
                            <div class="col-xs-6">
                                <div class="rating-box">
                                    wifi 穩定
                                    <div class="value {{ starClass($cafe->wifi) }}">{{ $cafe->presentStar('wifi') }}</div>
                                </div>
                                <div class="rating-box">
                                    通常有位
                                    <div class="value {{ starClass($cafe->seat) }}">{{ $cafe->presentStar('seat') }}</div>
                                </div>
                                <div class="rating-box">
                                    安靜程度
                                    <div class="value {{ starClass($cafe->quiet) }}">{{ $cafe->presentStar('quiet') }}</div>
                                </div>
                                <div class="rating-box">
                                    咖啡好喝
                                    <div class="value {{ starClass($cafe->tasty) }}">{{ $cafe->presentStar('tasty') }}</div>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="rating-box">
                                    東西好吃
                                    <div class="value {{ starClass($cafe->food) }}">{{ $cafe->presentStar('food') }}</div>
                                </div>
                                <div class="rating-box">
                                    價格便宜
                                    <div class="value {{ starClass($cafe->cheap) }}">{{ $cafe->presentStar('cheap') }}</div>
                                </div>
                                <div class="rating-box">
                                    裝潢音樂
                                    <div class="value {{ starClass($cafe->music) }}">{{ $cafe->presentStar('music') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    </div>

    <div class="container">
        <div class="row">
            {{ $cafes->links('pagination.limit-total') }}
        </div>
    </div>

</div>

@include('partial/_footer')

@include('_open-modal')

@endsection
