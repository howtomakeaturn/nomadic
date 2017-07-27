<div class='container'>
    <div class='row no-padding'>
        <div class='filters-box'>
            <div class='category-filter -active show-all' onclick="showAll();">
                {{trans('util.filter.all')}}
            </div>
            <div class='category-filter show-working' onclick="showWorking();">
                {{trans('util.filter.work')}}
            </div>
            <div class='category-filter show-custom' data-toggle="modal" data-target="#custom-filter-modal">
                {{trans('util.filter.custom')}}
            </div>
            <div class='category-filter show-star' onclick="showStar();">
                嚴選
            </div>
        </div>
    </div>
</div>

<script>
    function setAllLabelsWhite()
    {
        $('.show-all').removeClass('-active');
        $('.show-custom').removeClass('-active');
        $('.show-working').removeClass('-active');
        $('.show-star').removeClass('-active');
    }

    function showAll()
    {
        setAllLabelsWhite();
        $('.show-all').addClass('-active');

        $('.list tr').show();

        @if(App::environment()==='production')
        ga('send', 'event', 'Filter Button - List', 'Click', 'All');
        @endif
    }

    function showWorking()
    {
        setAllLabelsWhite();
        $('.show-working').addClass('-active');

        $('.list tr').show();
        $('.not-working-cafe').hide();

        @if(App::environment()==='production')
        ga('send', 'event', 'Filter Button - List', 'Click', 'Work');
        @endif
    }

    function showStar()
    {
        @if(Auth::check() && Auth::user()->profile->is_sponsored)
        setAllLabelsWhite();
        $('.show-star').addClass('-active');

        $('.list tr').hide();
        $('.is-starred-cafe').show();
        @else
        $('#guide-filter-modal').modal('show');
        @endif
    }
</script>

<!-- let's prepare all the data here -->
<script>
    var cafes = [];

    @foreach( $cafes as $cafe)

    cafes.push({
        "id": "{{ $cafe->id }}",
        "attr": {
            wifi: {{$cafe->wifi}},
            seat: {{$cafe->seat}},
            quiet: {{$cafe->quiet}},
            tasty: {{$cafe->tasty}},
            food: {{$cafe->food}},
            cheap: {{$cafe->cheap}},
            music: {{$cafe->music}},
            has_single_origin: @if($cafe->has_single_origin) true, @else false, @endif
            has_dessert: @if($cafe->has_dessert) true, @else false, @endif
            has_meal: @if($cafe->has_meal) true, @else false, @endif
            limited_time: '{{$cafe->limited_time}}',
            socket: '{{$cafe->socket}}',
            standing_desk: '{{$cafe->standing_desk}}',
            business_type: '{{$cafe->business_type}}',
            checkins: @if($cafe->recommendation_count >= 3) true, @else false, @endif
            business_hours: {!! $cafe->getBusinessHoursJson() !!}
        }
    });
    @endforeach
</script>

<style>
    .filters-box {
        margin-top: 10px;
        margin-bottom: 20px;
    }

    .category-filter {
        padding-left: 15px;
        padding-right: 15px;
        line-height: 2.5em;
        border: 2px solid #BDBDBD;
        border-radius: '3px';
        box-shadow: 0 2px 6px rgba(0,0,0,.3);
        display: inline-block;
        margin-right: 5px;
    }

    .category-filter:hover {
        cursor: pointer;
    }

    .category-filter.-active {
        background-color: #FFEB3B;
    }

</style>

@include('partial/_custom-filter-feature-list')

@include('partial/_guide-filter-modal')
