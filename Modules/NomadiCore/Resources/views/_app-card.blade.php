<div class='app-card'>

    <div style='overflow: hidden; white-space: nowrap; text-overflow: ellipsis;'>{{$app['name']}}</div>

    <div style="padding: 5px 0px; color: #757575;">{{$app['platform']}}</div>

    <a href='#' data-toggle="modal" data-target="#modal-{{$index}}">
        顯示細節
    </a>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-{{$index}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">{{$app['name']}}</h4>
      </div>
      <div class="modal-body">

          <div class='main'>
              <div class='author'>
                  <div class='title'>
                  平台
                  </div>
                  <div class='body'>
                  {{$app['platform']}}
                  </div>
              </div>
              <div class='author'>
                  <div class='title'>
                  作者
                  </div>
                  <div class='body'>
                  {{$app['author']}}
                  </div>
              </div>
              <div class='applink'>
                  <div class='title'>去哪裡下載或是使用這個軟體</div>
                  <div class="body">
                      {!!$app['link']!!}
                  </div>
              </div>
              @if($app['appintro'])
              <div class='appintro'>
                  <div class='title'>
                      使用說明
                  </div>
                  <div class='body'>
                  {{$app['appintro']}}
                  </div>
              </div>
              @endif
          </div>
          <div class='footer'>
              <div class='authorlink'>
                  <div class='title'>
                      作者聯絡方式
                  </div>
                  <div class='body'>
                  {!!$app['authorlink']!!}
                  </div>
              </div>
              @if($app['authorintro'])
              <div class='authorintro'>
                  <div class='title'>
                      作者介紹
                  </div>
                  <div class='body'>
                  {!!$app['authorintro']!!}
                  </div>
              </div>
              @endif
          </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<style>
    .app-card {
        background-color: white;
        border: 1px solid #E0E0E0;
        margin-bottom: 30px;
        padding: 20px;
    }

    .main {
        margin-bottom: 20px;
    }

    .name {

    }

    .name, .author, .applink, .appintro, .authorlink, .authorintro {
        margin-bottom: 15px;
    }

    .app-card .title, .modal .title {
        font-weight: bold;
    }

    .app-card .body {
        color: #616161;
    }
</style>
