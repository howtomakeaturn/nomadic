@extends('nomadicore::layout')
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
        margin-top: 10px;
        padding-left: 40px;
        padding-right: 40px;
    }
    @media (min-width: 768px) {
        .greeting-box {
            padding-top: 30px;
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
</style>
@endsection
@section('content')


<div class='greeting-box'>
    <div class='title'>
        {{Config::get('city')[$city]['zh']}}{{$tag->name}}的{{Config::get('nomadic.global.subject')}}清單：共收錄{{$cafes->count()}}{{Config::get('nomadic.tag-page.unit')}}
    </div>
    <br>
    <br>
</div>

<div class="bg -grey">
    <div class='container'>
        <div class='row no-padding'>
            @foreach($cafes as $cafe)
            <div class='col-md-3' style='padding-left: 5px; padding-right: 5px;'>
                <div class='cafe-summary' onclick="openModalByUuid('{{$cafe->id}}', 'pure')">
                    <div id='shop-info'>

                        <header>
                            <div class='title'>
                                <div class='name'>
                                {{$cafe->name}}
                                </div>
                                <div>
                                    <span class="text">
                                        @if($cafe->recommendations->count() > 0)
                                            有 {{$cafe->recommendations->count()}} 位 nomad 去過。
                                        @else
                                            還沒有 nomad 去過。
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </header>

                        <div class="row small-padding">
                            @foreach(Config::get('review-fields') as $field)
                            <div class="col-xs-6">
                                <div class='rating-box'>
                                    {{$field['label']}}
                                    <div class='value {{starClass($cafe->getReviewFieldValue($field['key']))}}'>
                                      @if($cafe->getReviewFieldValue($field['key']))
                                      {{number_format($cafe->getReviewFieldValue($field['key']), 1)}}  ★
                                      @else

                                      @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                      </div>
                    </div>

                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<br>

<style>

    #shop-info {
        background-color: white;
        border: 1px solid #E0E0E0;
        padding: 10px 15px;
        margin-bottom: 10px;
    }

    #shop-info:hover {
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

@include('nomadicore::_open-modal')

@include('nomadicore::partial/_footer')

@endsection
