<div class='header-box'>
    <span class='title'><a href='{{Request::url()}}'><strong>{{Modules\NomadiCore\Layout::title()}}</strong></a></span>
    <!--
    <span class='subtitle'>台北咖啡廳遊牧民族</span>
    -->
</div>

<div class='slogan'>
    {{Modules\NomadiCore\Layout::slogan()}}
    <i class="fa fa-coffee" aria-hidden="true"></i>
    <i class="fa fa-times" aria-hidden="true"></i>
    <i class="fa fa-laptop" aria-hidden="true"></i>
</div>

<style>
    .header-box {

    }
    .header-box > i {
        font-size: 26px;
        color: #795548;
    }
    .header-box > .title > a {
        font-size: 26px;
        color: #795548;
        display: inline-block;
    }
    .header-box .subtitle {
        font-size: 16px;
        color: black;
        display: inline-block;
        margin-left: 5px;
    }
    .slogan {
        margin-top: 5px;
        font-size: 16px;
        color: #9E9E9E;
    }
</style>
