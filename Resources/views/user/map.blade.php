@extends('layout')

@section('head')
<!--
    <script src='/js/masonry.pkgd.min.js'></script>
-->

<style>
    #map {
        height: calc(100vh - 145px);
        width: 100%;
    }
</style>


@endsection

@section('content')

<div class='container'>

    <div class='row'>
        <div class='col-md-6'>
            <div style="display: inline-block;">
                <!--
                {!! $user->presentPointPhoto() !!}
                -->
                <img src='{{ $user->profile->avatar }}' style='border-radius: 50%;'>
            </div>
            <div style="display: inline-block; vertical-align: top; margin-left: 10px;">
                <div> {{ $user->name }} </div>
                <div>Cafe Nomad Experience: {{ $user->getScore() }}</div>
            </div>
        </div>
        <div class='col-md-6'>
            <i class="fa fa-heart"></i>&nbsp;
            想去 {{$user->wishes->count()}} 間店
            <br>
            <i class="fa fa-map-marker"></i>&nbsp;
            造訪過 {{$user->recommendations->count()}} 間店
        </div>
    </div>
</div>
<br>
<div id="map"></div>

<script>
  function initMap() {

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: {{ $center['zoom'] }},
      center: { lat: {{ $center['lat'] }}, lng: {{ $center['lng'] }} },
      gestureHandling: 'greedy'
    })

    var image = '/img/footprint6.png';

    @foreach($user->recommendations as $rec)
        @if($rec->cafe->latitude != 0 && $rec->cafe->longitude != 0)
            var marker1 = new google.maps.Marker({
              position: {lat: {{ $rec->cafe->latitude }}, lng: {{ $rec->cafe->longitude }}},
              map: map,
              //label : {text: {!! json_encode($rec->cafe->name) !!}, color: 'black'},
              icon: image
            });

            google.maps.event.addListener(marker1, 'click', function() {
                openModalByUuid('{{$rec->cafe->id}}', 'pure');
            });

        @endif
    @endforeach

    var image2 = '/img/heart5.png';

    @foreach($user->wishes as $wish)
        @if($wish->cafe->latitude != 0 && $wish->cafe->longitude != 0)
            var marker1 = new google.maps.Marker({
              position: {lat: {{ $wish->cafe->latitude }}, lng: {{ $wish->cafe->longitude }}},
              map: map,
              icon: image2,
              label: {text: '{{$wish->cafe->name}}', color: 'black'}
            });

            google.maps.event.addListener(marker1, 'click', function() {
                openModalByUuid('{{$wish->cafe->id}}', 'pure');
            });

        @endif
    @endforeach

  };

</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDd_FdsWuxc57ZS7UN5UDbCoNixvZ1UFpc&callback=initMap">
</script>

@include('_open-modal')

@endsection
