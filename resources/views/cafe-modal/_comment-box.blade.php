<div id='comment-box-{{$entity->id}}'>
</div>

<script>
    (function (){
        var store = {
            comments: [],
            text: '',
            userAvatar: '',
            userLogined: false,
            cafeId: '{{$entity->id}}',
            token: '{{csrf_token()}}'
        };

        @foreach(get_comments($entity->id) as $comment)
            var obj = {!! $comment->toJson() !!};

            store.comments.push({
                body: obj.body,
                avatar: '{{$comment->user->profile->avatar}}',
                timestamp: '{{$comment->created_at->timestamp}}',
                user_id: {{$comment->user_id}},
                id: {{$comment->id}}
            });
        @endforeach

        @if(Auth::check())
            store.userLogined = true;
            store.userAvatar = '{{Auth::user()->profile->avatar}}';
        @endif

        var $e = $('#comment-box-{{$entity->id}}');

        function render() {
            $e.empty();
            store.comments.map(function(v){
                $div = new $("<div class='n'>" +
                    escapeHtml(v.body) + '&nbsp;' +
                    "<img src='" + v.avatar + "' style='border-radius: 50%; width: 40px;'>" +
                    "<span style='font-size: 12px;'>&nbsp;" + moment.unix(v.timestamp).fromNow() + "</span>" +
                "</div>");

                @if(Auth::check())
                    if({{Auth::user()->id}} == v.user_id) {
                        $removeBtn = new $("<span class='remove-btn'>×</span>");

                        $removeBtn.click(function(){
                            if (confirm('刪除這則留言嗎？')) {
                                post('/remove-comment', {
                                    comment_id: v.id,
                                    _token: '{{csrf_token()}}'
                                });
                            }
                        });

                        $div.append($removeBtn);
                    }
                @endif

                $e.append($div);
            });

            if (store.userLogined) {
                $textarea = new $("<textarea name='comment' style='width: calc(100% - 75px); margin-right: 5px; height: 70px; vertical-align: bottom; margin-top: 5px; border: 1px solid #9E9E9E;'></textarea>");
                $button = new $("<button class='btn btn-info btn-sm'><i class='fa fa-commenting-o'></i>&nbsp;{{trans('util.action.comment')}}</button>");

                $textarea.on('change keyup paste', function() {
                    store.text = $(this).val();
                });

                $button.click(function(){

                    if (store.text.trim() != '') {
                        /*
                        store.comments.push({
                            body: store.text,
                            avatar: store.userAvatar,
                            timestamp: moment().unix()
                        });

                        render();

                        $.post('/ajax/comment', {cafe_id: store.cafeId, _token: store.token, body: store.text});
                        */

                        $button.html('處理中...');

                        $button.addClass('disabled');

                        post('/add-comment', {
                            cafe_id: store.cafeId,
                            body: store.text,
                            _token: '{{csrf_token()}}'
                        });

                    }

                });

                $e.append($textarea);
                $e.append($button);
            } else {
                $link = new $("<a href='/login?cafe_id={{$entity->id}}&path=/shop/{{$entity->id}}' class='btn btn-info btn-sm'><i class='fa fa-commenting-o'></i>&nbsp;{{trans('util.action.comment')}}</a>");
                $e.append($link);
            }
        }

        $(document).ready(function(){
            moment.locale('zh-tw');

            render();
        });
    })();
</script>
