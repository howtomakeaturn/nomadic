<div class='table-header-hint'>
</div>

<style>
    .table-header-hint {
        position: fixed;
        top: 0px;
        left: 50%;
        transform: translateX(-50%);
        -webkit-transform: translateX(-50%);
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

<script>
    function addItem($e)
    {
        $div = new $('<div class="item"></div>');

        $div.text($e.text());

        $div.width($e.innerWidth());

        //$div.css('padding', $e.css('padding'));

        // this is technical debt.
        $div.css('padding', '5px');

        //console.log('set padding: ' + $e.css('padding'));

        $('.table-header-hint').append($div);
    }

    function detectAndExecute()
    {
        var scroll = $(window).scrollTop();

        var top = $('thead').offset().top;

        if (scroll >= top) {
            $('.table-header-hint').show();
        } else {
            $('.table-header-hint').hide();
        }
    }

    $(document).ready(function(){

        $('.table-header-hint').width($('thead').innerWidth());

        $('.table-header-hint').height($('thead').height());

        $('thead > tr > th').each(function(i, e){
            addItem($(e));
        });

        $(window).scroll(function() {
            detectAndExecute();
        });

        detectAndExecute();
    });
</script>
