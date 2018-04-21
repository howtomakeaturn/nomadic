<div id='shop-info-shadow'>
</div>
<div id='shop-info'>
</div>

<style>
    #shop-info-shadow {
        visibility: hidden;
    }

    #shop-info {
        background-color: white;
        border: 1px solid #E0E0E0;
        padding: 10px 15px;
        position: fixed;
    }

    #shop-info .ajax-box:hover {
        cursor: pointer;
    }

    #shop-info header {
        margin-bottom: 10px;
    }


    #shop-info header img {
        border-radius: 50%;
        width: 40px;
    }

    #shop-info .title {
        display: inline-block;
        width: calc(100% - 50px);
        vertical-align: top;
        padding-left: 10px;
    }

    #shop-info .text {
        color: #9E9E9E;
        font-size: 13px;
    }

</style>

<script>
    $(document).ready(function(){

        $('#shop-info').width($('#shop-info-shadow').width());

        var currentId;

        loadShop();

        $(window).scroll(function(){
            loadShop();
        });

        //var top = $('html').offset().top;

        function getClosestShop()
        {
            var result;
            var boxOffset = $('#shop-info-shadow').offset().top;
            $('.fb-post').each(function(i, e){
                var offsetTop = $(e).offset().top;
                var offsetBottom = $(e).offset().top + $(e).height();
                var scrollTop = $(window).scrollTop();
                if ( (scrollTop + boxOffset >= offsetTop) && (scrollTop + boxOffset < offsetBottom) ) {
                    result = $(e).data('cafe-id');
                    //result = $(e).find('.name').text();
                    return false;
                }
            });
            return result;
        }

        function loadShop()
        {
            var id = getClosestShop();

            if (id && id !== currentId) {
                $.get('/ajax/shop/' + id, function(res){
                    $('#shop-info').empty();
                    $('#shop-info').append(res);
                });

                currentId = id;
            }
        }

    });
</script>
