<div class="form-group">
    @foreach(config('review-fields') as $field)
    <div class='{{$field['key']}}-rating-box'>
        <div class='rating-label'>
        {{$field['label']}}
        </div>
        @include('nomadicore::_star-rating', ['field' => $field['key']])
    </div>
    @endforeach
</div>

<script>

    $(document).ready(function(){

        @if(isset($review))
            @foreach(config('review-fields') as $field)
                $("input[name={{$field['key']}}-rating][value='{{$review->getValue($field['key'])}}']").prop("checked",true);
            @endforeach
        @endif

    });

    function wannaSubmitForm()
    {
        //var ratings = ['wifi', 'seat', 'quiet', 'tasty', 'food', 'cheap', 'music'];

        var ratings = [
            @foreach(config('review-fields') as $field)
            '{{$field['key']}}',
            @endforeach
        ];
        /*
        var dict = {
            wifi: 'wifi 穩定',
            seat: '通常有位',
            quiet: '安靜程度',
            tasty: '咖啡好喝',
            food: '東西好吃',
            cheap: '價格便宜',
            music: '裝潢音樂'
        };
        */

        var dict = {
            @foreach(config('review-fields') as $field)
            '{{$field['key']}}': '{{$field['label']}}',
            @endforeach
        };

        var pass = true;
        var zeroFields = [];

        ratings.map(function(rating){
            if (optionalRatings.indexOf(rating) > -1 && $('#ignore-' + rating).prop("checked") === true) return;

            $e = $('input[name=' + rating + '-rating]:checked');
            if ($e.length === 0) {
                pass = false;
                zeroFields.push(rating);
            }
        });

        if (pass) {
            return true;
        } else {
            alert('您還沒有對「' + dict[zeroFields[0]] +'」項目評分。');
            return false;
        }
    }

</script>
