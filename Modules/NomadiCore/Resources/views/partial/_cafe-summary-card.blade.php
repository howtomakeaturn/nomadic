<div class='card-box'>
    <div class='title'>店名</div>
    <div class='value'>{{$cafe->name}}</div>
    <br>
    <div class='title'>ID</div>
    <div class='value'>{{$cafe->id}}</div>
    <br>
    <div class='title'>有 {{$cafe->recommendations->count()}} 人去過</div>
    @foreach($cafe->recommendations as $rec)
    <img src='{{$rec->user->profile->avatar}}'>
    @endforeach
    <br>
    <br>
    <div class="row">
        <div class='col-md-6'>
            <div class='title'>有 {{$cafe->reviews->count()}} 人評分</div>
        </div>
        <div class='col-md-6'>
            <div class='title'>有 {{$cafe->comments->count()}} 則留言</div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class='col-md-6'>
            <div class='title'>有 {{$cafe->wishes->count()}} 人下次想去</div>
        </div>
        <div class='col-md-6'>
            <div class='title'>有 {{$cafe->photos->count()}} 張照片</div>
        </div>
    </div>
</div>

<style>
    .card-box {
        background-color: #f2f2f2;
        box-shadow: 1px 1px 20px #888;
        margin-bottom: 30px;
        padding: 20px;
        height: 400px;
    }

    .card-box .title {
        font-weight: bold;
    }

    .card-box .value {
        color: #616161;
    }
</style>
