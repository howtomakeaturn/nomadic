@include('nomadicore::partial/_custom-filter-modal')

<script>
    $(document).ready(function(){
        $('#start-filter').click(function(){

            $('#custom-filter-modal').modal('hide');

            setAllControlsBackgroundWhite();
            controls.showCustom.style.backgroundColor = '#FFEB3B';

            var filter = getFilter();

            store.set('filter', filter);

            var counter = 0;

            markerCluster.clearMarkers();

            cafes.map(function(cafe, i){

                if (validateCafe(cafe, filter)) {
                    cafe.qualified = true;
                    markers[i].setMap(map);
                    counter += 1;
                    markerCluster.addMarker(markers[i]);
                } else {
                    cafe.qualified = false;
                    markers[i].setMap(null);
                }

            });

            console.log('共有 ' + counter + ' 間符合條件');

            @if(App::environment()==='production')
            ga('send', 'event', 'Filter Button - Map', 'Click', 'Custom');
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
