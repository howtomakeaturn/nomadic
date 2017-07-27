
<style>
    .stats {
        background-color: #EEEEEE;
        border: 1px solid #E0E0E0;
        margin-bottom: 15px;
    }

    .city-entry {
        padding-bottom: 10px;
        /*border-bottom: 1px solid #ccc; */
        padding-top: 10px;
    }

    .green {
        color: #4CAF50;
        font-weight: bold;
    }

    .city-entry .blue {
        color: #42A5F5;
        font-weight: bold;
    }

    .city-entry .orange {
        color: #FF9800;
        font-weight: bold;
    }

    .city-entry .yellow {
        font-weight: bold;
    }
</style>

<div class='stats'>
    <div style='border-bottom: solid 1px #E0E0E0; padding: 10px;'>
        <div style='font-size: 28px; margin-bottom: 10px; margin-top: 10px; font-weight: bold;'>正在蒐集資料的地區</div>
        <!--
        <div style='font-size: 16px; margin-bottom: 5px; line-height: 1.7em;'>
            cafe nomad 社群正在持續蒐集資料中，滿5筆就會上線。<br>
            歡迎利用<a href='/contribute'>推薦新增店家</a>表單，協助我們蒐集。
        </div>
        -->
    </div>
    <div style='padding: 10px;'>
        @foreach(App\City::getOfflineCities() as $city)
        <div class='city-entry'>
            <a class='btn btn-success' href='#' disabled>
                <i class="fa fa-list"></i>&nbsp;
                {{ Config::get("city.$city.zh") }}清單
            </a>
            <a class='btn btn-success' href='#' disabled>
                <i class="fa fa-globe"></i>&nbsp;
                {{ Config::get("city.$city.zh") }}地圖
            </a>
            目前蒐集到
            <span class='green'>{{ App\City::numOfCafes($city) }}</span> 間店
        </div>
        @endforeach
    </div>
</div>
