
<style>

.openinghours-box {

}

.dateTime {
  margin: 0 auto;
}

.day {
  display: inline-block;
  float: left;
}

.time {
  display: inline-block;
  position: relative;
  float: right
}

.today {
  color: rgb(200, 85, 39);
  font-weight: bold;
}

</style>

<div class="openinghours-box">
    <div id="Monday" class="dateTime">
      <div class="day">週一</div>
      <div class="time">
          {{$cafe->present()->businessHour('monday')}}
      </div>
    </div>
    <br>
    <div id="Tuesday" class="dateTime">
      <div class="day">週二</div>
      <div class="time">
          {{$cafe->present()->businessHour('tuesday')}}
      </div>
    </div>
  <br>
  <div id="Wednesday" class="dateTime">
    <div class="day">週三</div>
    <div class="time">
        {{$cafe->present()->businessHour('wednesday')}}
    </div>
  </div>
  <br>
  <div id="Thursday" class="dateTime">
    <div class="day">週四</div>
    <div class="time">
        {{$cafe->present()->businessHour('thursday')}}
    </div>
  </div>
  <br>
  <div id="Friday" class="dateTime">
    <div class="day">週五</div>
    <div class="time">
        {{$cafe->present()->businessHour('friday')}}
    </div>
  </div>
  <br>
  <div id="Saturday" class="dateTime">
    <div class="day">週六</div>
    <div class="time">
        {{$cafe->present()->businessHour('saturday')}}
    </div>
  </div>
  <br>
  <div id="Sunday" class="dateTime">
    <div class="day">週日</div>
    <div class="time">
        {{$cafe->present()->businessHour('sunday')}}
    </div>
  </div>
  <br>
</div>
