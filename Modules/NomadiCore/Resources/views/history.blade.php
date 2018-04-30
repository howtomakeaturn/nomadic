@extends('nomadicore::layout')

@section('head')
<!--
    <script src='/js/masonry.pkgd.min.js'></script>
-->

<style>
    #map {
        height: calc(100vh - 365px);
        width: 100%;
    }
    .summary-block .title, .single-block .title {
        display: block;
        padding-top: 10px;
        padding-bottom: 10px;
        border-bottom: 1px solid #BDBDBD;
        font-weight: bold;
        font-size: 1.2em;
    }
    .summary-block .grid {
        margin-bottom: 40px;
    }

    .summary-block .entry {
        padding-top: 5px;
        padding-bottom: 5px;
    }

    .summary-block .entry .timestamp{
        display: none;
    }

    .single-block {
        margin-bottom: 40px;
    }

    .single-block .entry {
        padding-top: 5px;
        padding-bottom: 5px;
        border-bottom: 1px solid #e0e0e0;
    }

    .single-block .entry .timestamp{
        float: right;
    }

</style>


@endsection

@section('content')

<div class='container'>

    <div class='row'>
        <div class='col-md-12'>
            <div style="display: inline-block;">
                <!--
                {!! $user->presentPointPhoto() !!}
                -->
                <img src='{{ $user->profile->avatar }}' style='border-radius: 50%;'>
            </div>
            <div style="display: inline-block; vertical-align: top; margin-left: 10px;">
                <div style='font-size: 18px;'> {{ $user->name }} </div>
                <div>Experience: {{ $user->getScore() }}</div>
            </div>
        </div>
    </div>
</div>
<br>

<div class='container'>
    <div class='row'>
        <div class='col-md-12'>
            <ul class="nav nav-tabs">
              <li role="presentation" @if($mode === 'summary') class="active" @endif><a href="/user/{{$user->id}}">總覽</a></li>
              <li role="presentation" @if($mode === 'cafes') class="active" @endif><a href="/user/{{$user->id}}?tab=cafes">新增 ({{$user->cafes->count()}})</a></li>
              <li role="presentation" @if($mode === 'reviews') class="active" @endif><a href="/user/{{$user->id}}?tab=reviews">評分 ({{$user->reviews->count()}})</a></li>
              <li role="presentation" @if($mode === 'editings') class="active" @endif><a href="/user/{{$user->id}}?tab=editings">編修 ({{$user->editings->count()}})</a></li>
              <li role="presentation" @if($mode === 'comments') class="active" @endif><a href="/user/{{$user->id}}?tab=comments">留言 ({{$user->comments->count()}})</a></li>
              <!--
              <li role="presentation" @if($mode === 'photos') class="active" @endif><a href="/user/{{$user->id}}?tab=photos">拍照 ({{$user->validPhotos()->count()}})</a></li>
              -->
              <li role="presentation" @if($mode === 'visits') class="active" @endif><a href="/user/{{$user->id}}?tab=visits">打卡 ({{$user->recommendations->count()}})</a></li>
              <li role="presentation" @if($mode === 'tags') class="active" @endif><a href="/user/{{$user->id}}?tab=tags">標籤 ({{$user->cafeTags->count()}})</a></li>
            </ul>
        </div>
    </div>
    <br>
    <br>
</div>
@if ($mode !== 'summary')
<div class='container single-block'>
    <div class='row'>
        <div class='col-md-12 grid'>
            @if ($mode === 'cafes')
                <a class='title' href='/user/{{$user->id}}?tab=cafes'>推薦新增 {{ $user->cafes->count() }} 間店家</a>
                <br>
                @foreach($user->cafes->sortByDesc('created_at') as $cafe)
                    @include('nomadicore::user/summary/cafe-entry')
                @endforeach
            @elseif ($mode === 'reviews')
                <a class='title' href='/user/{{$user->id}}?tab=reviews'>對 {{ $user->reviews->count() }} 間咖啡廳評分</a>
                <br>
                @foreach($user->reviews->sortByDesc('created_at') as $review)
                    @include('nomadicore::user/summary/review-entry')
                @endforeach
            @elseif ($mode === 'editings')
                <a class='title' href='/user/{{$user->id}}?tab=editings'>編修 {{ $user->editings->count() }} 間店家資料</a>
                <br>
                @foreach($user->editings->sortByDesc('created_at') as $editing)
                    @include('nomadicore::user/summary/editing-entry')
                @endforeach
            @elseif ($mode === 'comments')
                <a class='title' href='/user/{{$user->id}}?tab=comments'>有 {{ $user->comments->count() }} 則留言</a>
                <br>
                @foreach($user->comments->sortByDesc('created_at') as $comment)
                    @include('nomadicore::user/summary/comment-entry')
                @endforeach
            @elseif ($mode === 'photos')
                <a class='title' href='/user/{{$user->id}}?tab=photos'>上傳 {{ $user->validPhotos()->count() }} 張相片</a>
                <br>
                @foreach($user->validPhotos()->sortByDesc('created_at') as $photo)
                    @include('nomadicore::user/summary/photo-entry')
                @endforeach
            @elseif ($mode === 'visits')
                <a class='title' href='/user/{{$user->id}}?tab=visits'>造訪過 {{ $user->recommendations->count() }} 間咖啡廳</a>
                <br>
                @foreach($user->recommendations->sortByDesc('created_at') as $rec)
                    @include('nomadicore::user/summary/visit-entry')
                @endforeach
            @elseif ($mode === 'tags')
                <a class='title' href='/user/{{$user->id}}?tab=tags'>加上 {{ $user->cafeTags->count() }} 個標籤</a>
                <br>
                @foreach($user->cafeTags->sortByDesc('created_at') as $cafeTag)
                    @include('nomadicore::user/summary/tag-entry')
                @endforeach
            @endif
        </div>
    </div>
</div>
@endif

@if ($mode === 'summary')
<div class='container summary-block'>
    <div class='row'>
        <div class='col-md-6 grid'>
            <a class='title' href='/user/{{$user->id}}?tab=cafes'>推薦新增 {{ $user->cafes->count() }} 間店家</a>
            <br>
            @foreach($user->cafes->sortByDesc('created_at')->take(5) as $cafe)
                @include('nomadicore::user/summary/cafe-entry')
            @endforeach
            <a href='/user/{{$user->id}}?tab=cafes'>... 顯示全部</a>
        </div>
        <div class='col-md-6 grid'>
            <a class='title' href='/user/{{$user->id}}?tab=reviews'>對 {{ $user->reviews->count() }} 間咖啡廳評分</a>
            <br>
            @foreach($user->reviews->sortByDesc('created_at')->take(3) as $review)
                @include('nomadicore::user/summary/review-entry')
            @endforeach
            <a href='/user/{{$user->id}}?tab=reviews'>... 顯示全部</a>
        </div>
    </div>
    <div class='row'>
        <div class='col-md-6 grid'>
            <a class='title' href='/user/{{$user->id}}?tab=editings'>編修 {{ $user->editings->count() }} 間店家資料</a>
            <br>
            @foreach($user->editings->sortByDesc('created_at')->take(5) as $editing)
                @include('nomadicore::user/summary/editing-entry')
            @endforeach
            <a href='/user/{{$user->id}}?tab=editings'>... 顯示全部</a>
        </div>
        <div class='col-md-6 grid'>
            <a class='title' href='/user/{{$user->id}}?tab=comments'>有 {{ $user->comments->count() }} 則留言</a>
            <br>
            @foreach($user->comments->sortByDesc('created_at')->take(3) as $comment)
                @include('nomadicore::user/summary/comment-entry')
            @endforeach
            <a href='/user/{{$user->id}}?tab=comments'>... 顯示全部</a>
        </div>
    </div>
    <div class='row'>
        <!--
        <div class='col-md-6 grid'>
            <a class='title' href='/user/{{$user->id}}?tab=photos'>上傳 {{ $user->validPhotos()->count() }} 張相片</a>
            <br>
            @foreach($user->validPhotos()->sortByDesc('created_at')->take(5) as $photo)
                @include('nomadicore::user/summary/photo-entry')
            @endforeach
            <a href='/user/{{$user->id}}?tab=photos'>... 顯示全部</a>
        </div>
        -->
        <div class='col-md-6 grid'>
            <a class='title' href='/user/{{$user->id}}?tab=visits'>造訪過 {{ $user->recommendations->count() }} 間咖啡廳</a>
            <br>
            @foreach($user->recommendations->sortByDesc('created_at')->take(5) as $rec)
                @include('nomadicore::user/summary/visit-entry')
            @endforeach
            <a href='/user/{{$user->id}}?tab=visits'>... 顯示全部</a>
        </div>
        <div class='col-md-6 grid'>
            <a class='title' href='/user/{{$user->id}}?tab=tags'>加上 {{ $user->cafeTags->count() }} 個標籤</a>
            <br>
            @foreach($user->cafeTags->sortByDesc('created_at')->take(5) as $cafeTag)
                @include('nomadicore::user/summary/tag-entry')
            @endforeach
            <a href='/user/{{$user->id}}?tab=tags'>... 顯示全部</a>
        </div>
    </div>

</div>
@endif

@include('nomadicore::partial/_footer')

@endsection
