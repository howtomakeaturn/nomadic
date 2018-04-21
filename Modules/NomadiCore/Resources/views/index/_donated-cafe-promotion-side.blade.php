<div class='new-promotion-box'>
    <div class='title'>
        贊助 Cafe Nomad 的咖啡廳
    </div>

    @foreach($donated_cafes as $cafe)
        <div class='entry'>
            <div class='head'>
                <span class="donatedlabel">贊</span>
                <a href='/shop/{{$cafe->id}}' class='name'>[{{$cafe->presentCity()}}] {{$cafe->name}}</a>
            </div>
        </div>
    @endforeach
    <div class='footer'>
        贊助 Cafe Nomad 的咖啡廳可以得到特別曝光效果。<br><br>
        請參考<a href='/donate'>這個頁面</a>了解細節。
    </div>

</div>

<style>
    .new-promotion-box {
        background-color: white;
        border: 1px solid #E0E0E0;
    }

    .new-promotion-box .title{
        font-size: 18px;
        font-weight: bold;
        padding: 10px 15px;
        padding-top: 20px;
    }
    .new-promotion-box .entry {
        border-bottom: 1px solid #E0E0E0;
        padding: 10px 15px;
    }

    .new-promotion-box .entry .head {
        margin-bottom: 5px;
    }

    .new-promotion-box .entry .name {
        display: inline-block;
        width: calc(100% - 40px);
        vertical-align: top;
    }

    .new-promotion-box .entry .timestamp {
        color: #9E9E9E;
    }

    .new-promotion-box .footer {
        color: #9E9E9E;
        padding: 10px 15px;
    }

</style>
