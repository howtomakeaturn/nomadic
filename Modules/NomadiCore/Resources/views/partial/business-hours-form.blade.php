<input type='hidden' name='{{$inputName}}' style='width: 100%;'>

<?php
    $days = [
        'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'
    ];
    $names = [
        '週一', '週二', '週三', '週四', '週五', '週六', '週日'
    ];
?>

<div class="openinghours-form">
    @foreach($days as $index => $day)
    <div id="{{$day}}" class="dateTime">
      <div class="day">{{$names[$index]}}</div>
      <div class="time">
          <input type="text" class="timepicker -open" value='{{ isset($cafe) ? $cafe->present()->openTime($day) : "00:00" }}' @if(isset($cafe) && $cafe->present()->openTime($day)===null) disabled  @endif>
          -
          <input type="text" class="timepicker -close" value='{{ isset($cafe) ? $cafe->present()->closeTime($day) : "00:00" }}' @if(isset($cafe) && $cafe->present()->openTime($day)===null) disabled  @endif>
          <label>
              <input type="checkbox" class='dayoff' @if(isset($cafe) && $cafe->present()->openTime($day)===null) checked @endif>
              未營業
          </label>
          <button class='btn btn-sm btn-default' onclick="applyFrom('{{$day}}'); return false;">套用到全部</button>
      </div>
    </div>
    @endforeach
</div>
