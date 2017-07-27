<form style='display: inline;' method="post" action=/shop/unreport-tag>
    {{csrf_field()}}
    <input type='hidden' name='cafe_id' value='{{$cafe->id}}'>
    <input type='hidden' name='tag_id' value='{{$tag->id}}'>
    <button type="submit" class="btn-danger">
    (已建議移除)
    </button>
</form>
