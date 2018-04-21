@include('nomadicore::partial/_custom-filter-modal')

<script>
    $(document).ready(function(){
        $('#start-filter').click(function(){

            $('#custom-filter-modal').modal('hide');

            setAllLabelsWhite();
            $('.show-custom').addClass('-active');

            var filter = getFilter();

            store.set('filter', filter);

            var counter = 0;

            cafes.map(function(cafe, i){

                if (validateCafe(cafe, filter)) {
                    $('#' + cafe.id).show();
                    counter += 1;
                } else {
                    $('#' + cafe.id).hide();
                }

            });

            console.log('共有 ' + counter + ' 間符合條件');

            @if(App::environment()==='production')
            ga('send', 'event', 'Filter Button - List', 'Click', 'Custom');
            @endif

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            $.post('/track/custom-filter', {'custom-filter': JSON.stringify(filter)});

        });
    });
</script>
