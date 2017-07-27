@extends('layout')

@section('content')
<div class='container'>
    <div class='row'>
        <div class='col-md-12'>
            <h4>您認為「{{$cafe->name}}」是不適合收錄的店家嗎？</h4>

            <p>Cafe Nomad 目前主要會過濾掉餐廳類型的店家，說明如下：</p>

            <div class="alert alert-info" role="alert">
                <strong>★不收錄餐廳類型的店家★</strong>
                <br>
                <p>
                Cafe Nomad 不收錄客人幾乎全都在用餐、吃東西的餐廳與咖啡館。<br>
                因為這類店家並不適合去用電腦或看書。<br>
                </p>
            </div>

            <p>如果您認為這間店是餐廳類型的店家，或是出於其它原因，您認為不適合收錄，請複製以下資訊：</p>

            <div class="alert alert-warning" role="alert">
                店名：<b>{{$cafe->name}}</b><br>
                店家ID：<b>{{$cafe->id}}</b>
            </div>

            <p>接著到粉絲專頁直接傳訊給我，謝謝。</p>
            <p><a href='https://www.facebook.com/cafenomad.tw/'>Cafe Nomad 粉絲專頁</a></p>
            <hr>
            <p>我會視情況將這間店移進下面其中一個頁面：</p>
            <p><a href="/restaurant-type">{{trans('layout.footer.category-restaurant')}}</a></p>
            <p><a href="/other-type">其它未收錄的店家</a></p>
        </div>
    </div>
    <div class='row'>

    </div>
</div>

<style>

</style>
@endsection
