<span style='' id='wish-box-{{$cafe->id}}'>
</span>

<script>
    (function() {
        var $e = $('#wish-box-{{$cafe->id}}');

        var store = {
            added: false,
            userLogined: false,
            cafeId: '{{$cafe->id}}',
            token: '{{csrf_token()}}'
        };

        @if(Auth::check())
            store.userLogined = true;
        @endif

        @if(Auth::check() && Auth::user()->hasWish($cafe))
            store.added = true;
        @endif

        function render() {
            $e.empty();

            if (store.userLogined) {
                if (store.added) {
                    $button = new $("<button class='btn btn-default btn-sm'>(已在您的想去清單)</button>");
                    $button.click(function(){
                        store.added = false;
                        render();
                        $.post('/ajax/cancel-wish', {cafe_id: store.cafeId, _token: store.token});
                    });
                    $e.append($button);
                } else {
                    $button = new $("<button class='btn btn-sm btn-info'><i class='fa fa-heart'></i>&nbsp;{{trans('util.action.add-to-my-wish-list')}}</button>");
                    $button.click(function(){
                        store.added = true;
                        render();
                        $.post('/ajax/wish', {cafe_id: store.cafeId, _token: store.token});
                    });
                    $e.append($button);
                }
            } else {
                $link = new $("<a href='/login?cafe_id={{$cafe->id}}&path=/shop/{{$cafe->id}}' class='btn btn-info btn-sm'><i class='fa fa-heart'></i>&nbsp;{{trans('util.action.add-to-my-wish-list')}}</a>");
                $e.append($link);
            }
        }

        $(document).ready(function(){
            render();
        });
    })();
</script>
