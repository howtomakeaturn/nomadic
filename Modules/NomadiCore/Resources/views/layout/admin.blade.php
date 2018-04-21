<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="/css/bootstrap.min.css">

        <link rel="stylesheet" href="/css/font-awesome.min.css">

        <script src="/js/jquery-1.12.0.min.js"></script>

        <script src='/js/bootstrap.min.js'></script>

        <link rel="stylesheet" href="/modules/nomadicore/css/style.css?v=4">

        @yield('head')

    </head>
    <body>

        <nav class="navbar navbar-default">
          <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>

              <a class="navbar-brand" href="/admin">Cafe Nomad 管理面板</a>

            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <li role="presentation"><a href='/admin/browse'>咖啡廳資訊</a></a></li>
                <li role="presentation"><a href='/admin/editings'>資料編修建議</a></a></li>
                <li role="presentation"><a href='/admin/email'>Email 範本</a></a></li>
                <li role="presentation"><a href='/admin/calendar'>用戶行事曆</a></a></li>
                <li role="presentation"><a href='/admin/donation'>贊助店家</a></a></li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">報表 <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                      <li role="presentation"><a href='/admin/charts'>綜合報表</a></a></li>
                      <li role="presentation"><a href='/admin/charts/active-users?since={{Carbon\Carbon::now()->subMonths(1)->format('Y-m-d')}}'>活躍成員每日追蹤</a></a></li>
                      <li role="presentation"><a href='/admin/charts/active-users-count'>用戶活躍程度</a></a></li>
                      <li role="presentation"><a href='/admin/charts/shop'>店家瀏覽情況</a></a></li>
                      <li role="presentation"><a href='/admin/charts/custom-filter'>自訂篩選</a></a></li>
                      <li role="presentation"><a href='/admin/charts/custom-filter-log'>自訂篩選 Log</a></a></li>
                  </ul>
                </li>

                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">店家資料管理 <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                      <li role="presentation"><a href='/admin/photos'>相片管理</a></a></li>
                      <li role="presentation"><a href='/admin/fan-page/dashboard'>粉專管理</a></a></li>
                      <li role="presentation"><a href='/admin/tag'>標籤管理</a></a></li>
                      <li role="presentation"><a href='/admin/google-place'>Google Place 管理</a></a></li>
                      <li role="presentation"><a href='/admin/business-hours'>營業時間</a></a></li>
                  </ul>
                </li>

                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">其它 <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                      <li role="presentation"><a href='/admin/analysis'>店家數據分析</a></a></li>
                      <li role="presentation"><a href='/admin/fix/duplicate'>店家合併</a></a></li>
                      <!--
                      <li role="presentation"><a href='/admin/fix/columns'>欄位正規化</a></a></li>
                      -->
                      <li role="presentation"><a href='/admin/fix/business-type'>經營方式</a></a></li>
                      <li role="presentation"><a href='/admin/charts/api-stats'>API 圖表</a></a></li>
                      <li role="presentation"><a href='/admin/charts/api'>API Usage Log</a></a></li>
                      <li role="presentation"><a href='/admin/charts/algolia-search'>Algolia 搜尋關鍵字</a></a></li>
                      <li role="presentation"><a href='/admin/charts/search'>List.js 搜尋關鍵字</a></a></li>
                      <li role="presentation"><a href='/admin/reviews'>網友評分</a></a></li>
                      <li role="presentation"><a href='/admin/guide'>Cafe Nomad 指南</a></a></li>
                  </ul>
                </li>




              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>


        @yield('content')

    </body>
</html>
