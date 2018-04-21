<br>

<ul class="nav nav-tabs -center" style='text-align: center;'>
  <li role="presentation" @if(Request::getRequestUri() == "/shop/" . $cafe->id . "/stats") class="active" @endif><a href="/shop/{{$cafe->id}}/stats">每日瀏覽次數統計</a></li>
  <li role="presentation" @if(Request::getRequestUri() == "/shop/" . $cafe->id . "/donate") class="active" @endif><a href="/shop/{{$cafe->id}}/donate">贊助特別曝光次數統計</a></li>
</ul>

<br>
<br>

<style>
.nav-tabs.-center li {
  display: inline-block;
  float: none;
  vertical-align: top;
  font-size: 1.5em;
}

.nav-tabs.-center {
  text-align: center;
}
</style>
