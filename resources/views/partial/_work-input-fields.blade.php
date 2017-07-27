有無限時（選填）
<label><input type='radio' name='limited_time' value='no' @if(isset($cafe)&&$cafe->limited_time === 'no') checked @endif> {{Config::get('ui-text.limited_time.no')}} </label>&nbsp;&nbsp;
<label><input type='radio' name='limited_time' value='maybe' @if(isset($cafe)&&$cafe->limited_time === 'maybe') checked @endif> {{Config::get('ui-text.limited_time.maybe')}} </label>&nbsp;&nbsp;
<label><input type='radio' name='limited_time' value='yes' @if(isset($cafe)&&$cafe->limited_time === 'yes') checked @endif> {{Config::get('ui-text.limited_time.yes')}} </label>

<br>
<br>
插座多（選填）
<label><input type='radio' name='socket' value='no' @if(isset($cafe)&&$cafe->socket === 'no') checked @endif> {{Config::get('ui-text.socket.no')}} </label>&nbsp;&nbsp;
<label><input type='radio' name='socket' value='maybe' @if(isset($cafe)&&$cafe->socket === 'maybe') checked @endif> {{Config::get('ui-text.socket.maybe')}} </label>&nbsp;&nbsp;
<label><input type='radio' name='socket' value='yes' @if(isset($cafe)&&$cafe->socket === 'yes') checked @endif> {{Config::get('ui-text.socket.yes')}} </label>

<br>
<br>
可站立工作（選填）
<label><input type='radio' name='standing_desk' value='no' @if(isset($cafe)&&$cafe->standing_desk === 'no') checked @endif> {{Config::get('ui-text.standing_desk.no')}} </label>&nbsp;&nbsp;
<label><input type='radio' name='standing_desk' value='yes' @if(isset($cafe)&&$cafe->standing_desk === 'yes') checked @endif> {{Config::get('ui-text.standing_desk.yes')}} </label>

<br>
<br>
