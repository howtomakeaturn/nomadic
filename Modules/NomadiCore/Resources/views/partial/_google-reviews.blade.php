@if(isset($result['result']['reviews']))

@foreach($result['result']['reviews'] as $index => $review)
<div class='n'>
    {{$review['text']}}
    &nbsp;
    @if(isset($review['author_url']))
    <a href="{{$review['author_url']}}" target="_blank"><img src='{{$review['profile_photo_url']}}' style='border-radius: 50%; width: 40px;'></a>
    @endif
    <span style='font-size: 12px;' class="timestamp">{{$review['time']}}</span>
</div>
@endforeach

<script>
    $(document).ready(function(){

        moment.locale('zh-tw');

        $('.timestamp').map(function(e){
            if ($.isNumeric($(this).text())) {
                $(this).text(moment.unix($(this).text()).fromNow());
            }
        });
    });
</script>

<style>

</style>

@endif
