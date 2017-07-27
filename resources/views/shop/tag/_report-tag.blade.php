<form style='display: inline;' method="post" action=/shop/report-tag>
    {{csrf_field()}}
    <input type='hidden' name='cafe_id' value='{{$cafe->id}}'>
    <input type='hidden' name='tag_id' value='{{$tag->id}}'>
    <button type="submit" onclick="if ( confirm('達到一定回報次數的標籤會從該店家中移除。建議移除這標籤嗎?') ) { this.disabled=true; this.value='處理中，請稍候...'; this.form.submit(); }else{return false;};">
    <i class="fa fa-flag" aria-hidden="true"></i>
    建議移除
    </button>
</form>
