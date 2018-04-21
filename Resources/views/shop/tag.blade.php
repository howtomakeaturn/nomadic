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
    <div class="row no-padding">
        <div class="col-md-2" style='padding-left: 5px; padding-right: 5px;'>
            <h4>標籤編輯：{{$entity->name}}</h4>
        </div>
        <div class='col-md-4' style='padding-left: 5px; padding-right: 5px;'>
            <div class='tag-section'>
                <div>使用者給這間店的熱門標籤：</div>
                <br>
                @if($entity->tags->count() === 0)
                <i>還沒有使用者給這間店標籤。</i>
                @endif

                @foreach($entity->uniqueTags()->sortByDesc(function($tag)use($entity){return $tag->countOnCafe($entity);}) as $tag)
                <div class='tag-entry'>
                    <div class='tag-box'>
                        {{$tag->name}}
                    </div>

                    @if(!$tag->isUsed(Auth::user(), $entity))
                        @include('nomadicore::shop/tag/_report-tag')
                        @include('nomadicore::shop/tag/_apply-tag')
                    @else
                        @if($tag->isApplied(Auth::user(), $entity))
                            <form style='display: inline;' method="post" action=/shop/unapply-tag>
                                {{csrf_field()}}
                                <input type='hidden' name='entity_id' value='{{$entity->id}}'>
                                <input type='hidden' name='tag_id' value='{{$tag->id}}'>
                                <button type="submit" class="btn-success">
                                    (已同意)
                                </button>
                            </form>
                        @elseif($tag->isReported(Auth::user(), $entity))
                            @include('nomadicore::shop/tag/_unreport-tag')
                        @endif
                    @endif

                    <i><small>有{{$tag->countOnCafe($entity)}}人給這標籤</small></i>
                </div>
                @endforeach
            </div>
        </div>

        <div class='col-md-3' style='padding-left: 5px; padding-right: 5px;'>
            <div class='tag-section'>
                <div>您給這間店的標籤：</div>
                <br>
                @if($userTags->count() === 0)
                <i>您還沒有給這間店標籤。</i>
                @endif

                @foreach($userTags as $tag)
                <div class='tag-entry'>
                    <div class='tag-box'>
                        {{$tag->name}}
                    </div>

                    <form style='display: inline;' method="post" action=/shop/unapply-tag>
                        {{csrf_field()}}
                        <input type='hidden' name='entity_id' value='{{$entity->id}}'>
                        <input type='hidden' name='tag_id' value='{{$tag->id}}'>
                        <button type="submit">
                            <i class="fa fa-minus" aria-hidden="true"></i>
                        取消
                        </button>
                    </form>

                </div>
                @endforeach

            </div>
        </div>
        <div class='col-md-3' style='padding-left: 5px; padding-right: 5px;'>
            <div class="tag-section">
                <div>您有三種方式替這間店加上標籤：</div>
                <br>

                <div><b>1. 手動新增標籤：</b></div>
                <br>

                <div>
                請輸入可作為分類依據的名詞。
                </div>
                <div>
                <form method="post" action='/shop/new-tag'>
                    {{csrf_field()}}
                    <input type='hidden' name='entity_id' value='{{$entity->id}}'>
                    <input type='text' name='tag_name' placeholder="輸入標籤" required>
                    <button type='submit'>新增</button>
                </form>
                </div>

                <hr>

                <div><b>2. 使用您之前給過其他店的標籤：</b></div>
                <br>

                @if($userOtherTags->count() === 0)
                <i>您還沒有給過標籤。</i>
                @endif

                @foreach($userOtherTags->sortByDesc(function($tag){return $tag->cafe_tag_count;}) as $tag)

                <div class='tag-entry'>
                    <div class='tag-box'>
                        {{$tag->name}}
                    </div>

                    <form style='display: inline;' method="post" action=/shop/apply-tag>
                        {{csrf_field()}}
                        <input type='hidden' name='entity_id' value='{{$entity->id}}'>
                        <input type='hidden' name='tag_id' value='{{$tag->id}}'>
                        <button type="submit">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        新增
                        </button>
                        <i><small>{{$tag->cafe_tag_count}}間店有這標籤</small></i>
                    </form>
                </div>
                @endforeach

                <hr>
                <div><b>3. 使用其他店的常見標籤：</b></div>
                <br>

                @if($otherTags->count() === 0)
                <i>還沒有標籤。</i>
                @endif

                @foreach($otherTags->sortByDesc(function($tag){return $tag->cafe_tag_count;}) as $tag)

                <div class='tag-entry'>
                    <div class='tag-box'>
                        {{$tag->name}}
                    </div>

                    <form style='display: inline;' method="post" action=/shop/apply-tag>
                        {{csrf_field()}}
                        <input type='hidden' name='entity_id' value='{{$entity->id}}'>
                        <input type='hidden' name='tag_id' value='{{$tag->id}}'>
                        <button type="submit">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        新增
                        </button>
                        <i><small>{{$tag->cafe_tag_count}}間店有這標籤</small></i>

                    </form>

                </div>
                @endforeach

            </div>
        </div>
    </div>
</div>

<style>

    .tag-section {
        background-color: white;
        border: 1px solid #E0E0E0;
        padding: 10px 15px;
        margin-bottom: 20px;
    }

    .tag-entry {
        margin-bottom: 10px;
    }

    .tag-box {
        display: inline-block;
        padding: 5px 10px;
        background-color: #757575;
        color: white;
        margin-bottom: 5px;
    }

</style>

@endsection
