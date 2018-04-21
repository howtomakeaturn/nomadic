<div class='bg'>

<div class='section-title'>
    <div class='name'>
    地圖
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

    @foreach($cafes as $cafe)
        @if($cafe->latitude != 0 && $cafe->longitude != 0)
            var marker = new google.maps.Marker({
              position: {lat: {{ $cafe->latitude }}, lng: {{ $cafe->longitude }}},
              map: map,
              label : {text: {!! json_encode($cafe->name) !!}, color: 'black'},
            });

            google.maps.event.addListener(marker, 'click', function() {
                openModalByUuid('{{$cafe->id}}', 'pure');
            });

        @endif
    @endforeach

  };

</script>

<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDd_FdsWuxc57ZS7UN5UDbCoNixvZ1UFpc&callback=initMap">
</script>

<style>
#map {
    height: 400px;
    width: 100%;
}

.section-title {
    text-align: center;
    padding-top: 0px;
    padding-bottom: 12px;
}
.section-title .name {
    font-size: 18px;
    margin-bottom: 6px;
}
.section-title .description {

}

@media (min-width: 768px) {
    .section-title {
        text-align: center;
        padding-top: 0px;
        padding-bottom: 20px;
    }
    .section-title .name {
        font-size: 24px;
        margin-bottom: 12px;
    }
    .section-title .description {
        font-size: 18px;
    }
}

</style>
