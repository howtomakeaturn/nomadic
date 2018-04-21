<div class='table-header-hint'>
</div>

<style>
    .table-header-hint {
        position: fixed;
        top: 0px;
        left: 1px;
        border-bottom: 2px solid rgb(221, 221, 221);
        background-color: white;
        display: none;
    }

    .table-header-hint > .item {
        display: inline-block;
        font-size: 12px;
        font-weight: bold;
    }
</style>

<?php
$agent = new \Jenssegers\Agent\Agent();

if ($agent->browser() !== 'Safari') {
?>

<script>
    function addItem($e)
    {
        $div = new $('<div class="item"></div>');

        $div.html($e.html());

        $div.width($e.innerWidth());

        //$div.css('padding', $e.css('padding'));

        // this is technical debt.
        $div.css('padding', '16px 5px');

        //console.log('set padding: ' + $e.css('padding'));

        $('.table-header-hint').append($div);
    }

    $(document).ready(function(){

        $header = $('.table-header-hint');

        $table = $('.table-responsive');

        function detectAndExecuteVertical()
        {
            var scroll = $(window).scrollTop();

            var top = $('thead').offset().top;

            if (scroll >= top) {
                $header.show();
            } else {
                $header.hide();
            }
        }

        function detectAndExecuteHorizontal()
        {
            var x = 0 - $table.scrollLeft();

            $header.offset({
                left: x + 1
            });

        }

        $('.table-header-hint').width($('thead').innerWidth());

        console.log('set width: ' + $('thead').innerWidth());

        $('.table-header-hint').height($('thead').height());

        $('thead > tr > th').each(function(i, e){
            addItem($(e));
        });

        $(window).scroll(function() {
            detectAndExecuteVertical();

            detectAndExecuteHorizontal();
        });


        $('.table-responsive').scroll(function() {
            detectAndExecuteHorizontal();
        });

        detectAndExecuteVertical();

        detectAndExecuteHorizontal();
    });
</script>

<?php } ?>
