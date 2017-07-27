<div class='bg'>

<div class='section-title'>
    <div class='name'>
        {{trans('homepage.feature-2-title')}}
    </div>
    <div class='description'>
        {{trans('homepage.feature-2-subtitle')}}
    </div>
</div>

<div id="map"></div>

</div>

<script>
  function initMap() {

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: {{ $center['zoom'] }},
      center: { lat: {{ $center['lat'] }}, lng: {{ $center['lng'] }} },
      gestureHandling: 'greedy'
  });

    @foreach($mapCafes as $cafe)
        @if($cafe->latitude != 0 && $cafe->longitude != 0)
            var marker1 = new google.maps.Marker({
              position: {lat: {{ $cafe->latitude }}, lng: {{ $cafe->longitude }}},
              map: map,
              label : {text: {!! json_encode($cafe->name) !!}, color: 'black'},
            });

            google.maps.event.addListener(marker1, 'click', function() {
                openModalByUuid('{{$cafe->id}}', 'pure');
            });

        @endif
    @endforeach

  };

</script>

<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDd_FdsWuxc57ZS7UN5UDbCoNixvZ1UFpc&callback=initMap&language={{LaravelLocalization::getCurrentLocale()}}">
</script>

<style>
#map {
    height: 300px;
    width: 100%;
}
</style>
