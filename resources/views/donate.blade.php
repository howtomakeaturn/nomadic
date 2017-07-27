@extends('layout')
@section('head')

<script>
    function showPersonal()
    {
        $('.personal-donate').show();
        $('.shop-donate').hide();

        $('.-personal').addClass('active');
        $('.-shop').removeClass('active');
    }
    function showShop()
    {
        $('.personal-donate').hide();
        $('.shop-donate').show();

        $('.-personal').removeClass('active');
        $('.-shop').addClass('active');
    }

</script>

<style>
    .bg {
        padding-top: 20px;
        padding-bottom: 20px;
        text-align: center;
        line-height: 1.7;
    }

    .bg.-grey {
        background-color: #EEEEEE;
    }

    @media (min-width: 768px) {
        .bg {
            padding-top: 40px;
            padding-bottom: 40px;
            font-size: 18px;
        }
    }
</style>
@endsection
@section('content')

<div class='bg -grey'>
<div class='container'>
    <div class='row'>
        <div class='col-md-12'>
            <h3>店家贊助 & 特別曝光</h3>

            Cafe Nomad 是由網友們一起整理的咖啡廳指南。<br>
            每個月有超過 <b>30,000</b> 人在 Cafe Nomad 上搜尋，尋找適合工作、看書、喝咖啡的咖啡廳。<br>
            這原本只是<a href='https://www.ptt.cc/bbs/Soft_Job/M.1478264877.A.4F8.html'>我跟網友們一起整理</a>的清單，因為滿受歡迎，我便持續將它開發成現在這個網站。<br>
            <br>
            歡迎咖啡廳店家贊助網站的開發，我會幫您的店開啟一個曝光廣告功能作為回報！<br>
            贊助方案的細節在下方，有任何問題或是想法歡迎直接跟我說！<br>
            <br>
            信箱：{!!replace_at_icon('howtomakeaturn@gmail.com')!!}<br>
            Facebook：<img src='https://graph.facebook.com/v2.8/1320392734647045/picture?type=square' style='border-radius: 50%;'> <a href='https://www.facebook.com/chuanhao.you'>尤川豪（阿川）</a><br>
            數據與統計：<a href='/statistics'>網站數據 & 報表</a><br>
        </div>
    </div>
</div>
</div>

<div class='bg'>
<div class='container'>
    <div class='row'>
        <div class='col-md-12'>
            <h3>各地區限量開放店家贊助</h3>
            目前 Cafe Nomad 在各地區的用戶數量都不同。<br>
            為了確保贊助店家每個月都有至少1,000次以上的曝光，各地區目前只開放固定的數量。
        </div>
    </div>
</div>
</div>

<div class='container'>
    <div class='row no-padding'>
        @foreach(App\City::getOnlineCities() as $city)
        <div class='col-md-2 col-xs-4' style='padding-left: 5px; padding-right: 5px;'>
            @if(Config::get("city.$city.sponsorshipQuota") === 0)
            <div class='city-box' style="height: 100px; background-color: white;">
                <div class='name grey' style='margin-bottom: 0.5em;'>{{trans("global.city.$city")}}</div>
                <div class="grey">正在準備中</div>
            </div>
            @else
            <div class='city-box' style="height: 100px;">
                <div class='name' style='margin-bottom: 0.5em;'>{{trans("global.city.$city")}}</div>
                <div>
                    開放 <span class='green'>{{ Config::get("city.$city.sponsorshipQuota") }}</span> 間
                </div>
                <div>
                    現有 <span class='blue'>{{ App\City::numOfDonatedCafes($city) }}</span> 間
                </div>
            </div>
            @endif

        </div>
        @endforeach
    </div>
</div>

<br>

<div class='bg -grey'>
<div class='container'>
    <div class='row'>
        <div class='col-md-12'>
            <h3>現有贊助店家</h3>
            已經有多間咖啡廳成為贊助店家，歡迎您一起來加入贊助店家的行列！
        </div>
    </div>
    <br>
    <div class="row small-padding">
        @foreach(CafeNomad::getDonatedCafes()->take(3) as $index => $cafe)
        <div class="col-md-4">
            @include('partial/_thanks-box')
        </div>
        @endforeach
    </div>
</div>
</div>

<br>

<div class='bg'>
<div class='container'>
    <div class='row'>
        <div class='col-md-12'>
            <h3>贊助曝光效果說明</h3>
            這是<b>300元</b>的贊助方案，曝光廣告效果會持續<b>1整個月</b>。<br>
            也可以選擇一次多個月的方案：<b>3</b>個月<b>800元</b> / <b>6</b>個月<b>1500元</b> / <b>12</b>個月<b>2700元</b>。<br>
        </div>
    </div>
</div>
</div>

<br>

<div class="container">
    <div class='row'>
        <div class='col-md-6'>
            <!--
            <div class='personal-donate'>
                <h4><b>個人贊助</b></h4>
                <p>歡迎您贊助 Cafe Nomad 100元，讓 Cafe Nomad 變為更成熟好用的網站。</p>
                <p><a href='https://core.spgateway.com/EPG/cafenomadtw/xaVMaW' target="_blank">100元個人贊助連結（透過第三方支付金流平台智付通）</a></p>
                <br>
                <br>
                <br>
            </div>
            -->
            <div class='shop-donate'>
                <!--
                <h4><b>咖啡廳贊助特別曝光</b></h4>
                -->
                <br>
                <p>1. 在地圖模式下，找店小幫手開始時會隨機顯示一間贊助店家資訊</p>
                <p>2. 在清單模式下，會隨機出現在網頁最上方的相簿輪播</p>
                <p>3. 在地圖模式下，圖示會變成與眾不同的天藍色</p>
                <p>4. 在找店小幫手裡面，店名前面會加上天藍色的「贊」字標記</p>
                <p>5. 在清單模式下，店名前面會加上天藍色的「贊」字標記</p>
                <p>6. 在清單模式下，頁面打開時位置會在最上方，全部贊助店家之間則以隨機排序</p>
                <br>
                <h4><b>咖啡廳贊助參加方法</b></h4>
                <!--
                <p>在 Cafe Nomad 上面尋找咖啡廳的使用者，大部份是工作（用筆電）與閱讀族群。</p>
                <p>希望是環境適合、同時也歡迎這些族群的店家，來參加此方案。</p>
                -->
                <p>有興趣參加的店家，請前往下列連結填寫表單：</p>
                <p><a href='https://goo.gl/forms/cux4FQXCcWQj5Jyg1' target="_blank">https://goo.gl/forms/cux4FQXCcWQj5Jyg1</a></p>
                <p>我在後台看到之後，就會立刻幫您開啟贊助曝光功能，然後把贊助付款連結（智付通頁面）寄到您的電子信箱。</p>
                <p>有哪裡不清楚的話，歡迎直接透過粉絲團問我，或是直接寫Email問我也可以！</p>
                <p>我的信箱：{!!replace_at_icon('howtomakeaturn@gmail.com')!!}</p>
                <br>
                <br>
            </div>
        </div>
        <div class='col-md-6 shop-donate'>
            <h4><b>咖啡廳贊助曝光效果詳細說明</b></h4>
            <br>
            <div>
                <h4>1. 在地圖模式下，找店小幫手開始時會隨機顯示一間贊助店家資訊</h4>
                <img class='screenshot' src='/img/marketing/donate/map-banner.png'>
                <p class='grey'></p>
                <br>
                <br>
            </div>
            <div>
                <h4>2. 在清單模式下，會隨機出現在網頁最上方的相簿輪播</h4>
                <img class='screenshot' src='/img/marketing/donate/top-banner.png'>
                <p class='grey'></p>
                <br>
                <br>
            </div>
            <div>
                <h4>3. 在地圖模式下，圖示會變成與眾不同的天藍色</h4>
                <img class='screenshot' src='/img/marketing/donate/1.png'>
                <p class='grey'>（上圖為示意圖，並沒有正確標示哪些店是贊助店家）</p>
                <br>
                <br>
            </div>
            <div>
                <h4>4. 在找店小幫手裡面，店名前面會加上天藍色的「贊」字標記</h4>
                <img class='screenshot' src='/img/marketing/donate/2.png'>
                <p class='grey'>（上圖為示意圖，並沒有正確標示哪些店是贊助店家）</p>
                <br>
                <br>
            </div>
            <div>
                <h4>5. 在清單模式下，店名前面會加上天藍色的「贊」字標記</h4>
                <img class='screenshot' src='/img/marketing/donate/3.png'>
                <p class="grey">（上圖為示意圖，並沒有正確標示哪些店是贊助店家）</p>
                <br>
                <br>
            </div>
            <div>
                <h4>6. 在清單模式下，頁面打開時位置會在最上方，全部贊助店家之間則以隨機排序</h4>
                <img class='screenshot' src='/img/marketing/donate/4.png?v=1'>
                <!--
                <p class="grey">（上圖為示意圖，並沒有正確標示哪些店是贊助店家）</p>
                -->
                <br>
                <br>
            </div>
        </div>
    </div>
</div>

<br>

@include('partial/_footer')

<style>
    .screenshot {
        max-width: 100%;
        border: 5px solid black;
    }
    .personal-donate {
        display: none;
    }

    .thanks-box {
        background-color: white;
        margin: 0 auto;
        padding: 10px;
        max-width: 320px;
        text-align: left;
        font-size: 15px;
        margin-bottom: 5px;
    }

    .thanks-box > .title {
        /*
        font-size: 18px;
        */
        padding-top: 9px;
        padding-bottom: 9px;
    }

    @media (min-width: 768px) {
        .thanks-box {
            max-width: none;
        }

        .thanks-box > .title {
            /*
            font-size: 24px;
            */
            padding-top: 12px;
            padding-bottom: 12px;
        }
    }

</style>

@endsection
