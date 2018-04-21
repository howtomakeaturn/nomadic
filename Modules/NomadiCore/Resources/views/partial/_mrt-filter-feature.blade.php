<div class='container'>

    <div class="row no-padding">
        <div class="col-xs-6 col-md-2">
            <div class='mrt-filter'>
                <input type='checkbox' id='line1' value='line1'>
                <label class='legend -line1 -number' for='line1'>1</label>
                <label class='legend -line1 -text' for='line1'>{{trans('util.mrt.wenhu')}}</label>
            </div>
        </div>
        <div class="col-xs-6 col-md-2">
            <div class='mrt-filter'>
                <input type='checkbox' id='line2' value='line2'>
                <label class='legend -line2 -number' for='line2'>2</label>
                <label class='legend -line2 -text' for='line2'>{{trans('util.mrt.tamsui-xinyi')}}</label>
            </div>
        </div>
        <div class="col-xs-6 col-md-2">
            <div class='mrt-filter'>
                <input type='checkbox' id='line3' value='line3'>
                <label class='legend -line3 -number' for='line3'>3</label>
                <label class='legend -line3 -text' for='line3'>{{trans('util.mrt.songshan-xindian')}}</label>
            </div>
        </div>
        <div class="col-xs-6 col-md-2">
            <div class='mrt-filter'>
                <input type='checkbox' id='line4' value='line4'>
                <label class='legend -line4 -number' for='line4'>4</label>
                <label class='legend -line4 -text' for='line4'>{{trans('util.mrt.zhonghe-xinlu')}}</label>
            </div>
        </div>
        <div class="col-xs-6 col-md-2">
            <div class='mrt-filter'>
                <input type='checkbox' id='line5' value='line5'>
                <label class='legend -line5 -number' for='line5'>5</label>
                <label class='legend -line5 -text' for='line5'>{{trans('util.mrt.bannan')}}</label>
            </div>
        </div>
    </div>

</div>

<script>
    $(document).ready(function(){
        $('.mrt-filter > input[type="checkbox"]').on("change", filtMrt);
    });

    function filtMrt() {
        @if(App::environment()==='production')
        ga('send', 'event', 'MRT Button', 'Click', 'Any');
        @endif

        var displayLines = [];

         $('.mrt-filter > input[type="checkbox"]:checked').map(function(index, item){
            displayLines.push($(item).val());
        });

        $('.list > tr').hide();

        if (in_array(displayLines, 'line1')) {
            $('.list > tr.line1').show();
        }
        if (in_array(displayLines, 'line2')) {
            $('.list > tr.line2').show();
        }
        if (in_array(displayLines, 'line3')) {
            $('.list > tr.line3').show();
        }
        if (in_array(displayLines, 'line4')) {
            $('.list > tr.line4').show();
        }
        if (in_array(displayLines, 'line5')) {
            $('.list > tr.line5').show();
        }

        if (displayLines.length == 0) {
            $('.list > tr').show();
        }
    }

    function in_array(array, value) {
        for(var i=0;i<array.length;i++) {
            if (array[i] === value) {
                return true;
            }
        }
        return false;
    }
</script>

<style>
    .mrt-filter {

    }
    .mrt-filter > input {
        display: inline-block;
        width: 22px;
        height: 22px;
    }
    .mrt-filter > .legend {
        display: inline-block;
        color: white;
        font-weight: normal;
        vertical-align: top;
        padding: 5px 10px;
    }
    .mrt-filter > .legend.-number {
        font-weight: bold;
        margin-right: 0;
        width: 30px;
        text-align: center;
    }
    .mrt-filter > .legend.-text {
        width: calc(100% - 70px)
    }
    .mrt-filter > .legend.-line1 {
        background-color: #B7862F;
    }
    .mrt-filter > .legend.-line2 {
        background-color: #E3002D;
    }
    .mrt-filter > .legend.-line3 {
        background-color: #028559;
    }
    .mrt-filter > .legend.-line4 {
        background-color: #F8B51C;
        color: black;
    }
    .mrt-filter > .legend.-line5 {
        background-color: #0070BC;
    }
</style>
