@extends('layout')
@section('head')
<style>
    #map {
        height: calc(100vh - 52px);
        width: 100%;
    }
    .navbar {
        margin-bottom: 0;
    }
</style>
@endsection
@section('content')

    <!--
    <div style='padding: 0px;'>
        <div class="alert alert-info alert-dismissible" role="alert" style='margin: 10px;'>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <?php
            $discussion = App\Discussion::orderBy('id', 'desc')->first();
          ?>
          @if($discussion)
          {!!$discussion->presentBlockSimple()!!}
          @endif
        </div>

    </div>
    -->


    <!-- let's prepare all the data here -->
    <script>
        var openGuideFeature = false;

        @if(Auth::check() && Auth::user()->profile->is_sponsored)
            openGuideFeature = true;
        @endif

        var cafes = [];
        var map;
        var markers = [];
        var controls = {
        }

        var markerCluster;

        var donatedIcon = '/img/markers/blue.png';

        @foreach( $cafes as $cafe)

        var type = 'normal';

        @if($cafe->opening_date != null)
            var type = 'new';
        @endif

        cafes.push({
            "id": "{{ $cafe->id }}",
            "name": {!! json_encode($cafe->name) !!},
            "score": {{ $cafe->summaryScore() }},
            "latitude": {{ $cafe->latitude }},
            "longitude": {{ $cafe->longitude }},
            "type": type,
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
                is_starred: @if($cafe->is_starred) true, @else false, @endif
                is_donated: @if($cafe->is_donated) true, @else false, @endif
                business_hours: {!! $cafe->getBusinessHoursJson() !!}
            },
            qualified: true,
            "isGoodForWorking": @if($cafe->isGoodForWorking()) true @else false @endif
        });
        @endforeach
    </script>

    <div id="map"></div>

    <script>
        function applyStyleToControlUI(controlUI)
        {
            controlUI.style.cursor = 'pointer';
            controlUI.style.backgroundColor = '#fff';
            controlUI.style.marginLeft = '5px';
            controlUI.style.marginTop = '5px';
            controlUI.style.border = '2px solid #BDBDBD';
            controlUI.style.borderRadius = '3px';
            controlUI.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
        }

        function applyStyleToControlText(controlText)
        {
            controlText.style.fontSize = '16px';
            controlText.style.paddingLeft = '15px';
            controlText.style.paddingRight = '15px';
            controlText.style.lineHeight = '38px';
        }

        function setAllControlsBackgroundWhite()
        {
            controls.showAll.style.backgroundColor = 'white';
            controls.showWorking.style.backgroundColor = 'white';
            controls.showCustom.style.backgroundColor = 'white';
            if (openGuideFeature) controls.showStar.style.backgroundColor = 'white';
        }

        function ShowAllControl(map) {

          var controlUI = document.createElement('div');

          controls.showAll = controlUI;

          controlUI.title = '顯示全部的咖啡廳';

          applyStyleToControlUI(controlUI);

          controlUI.style.backgroundColor = '#FFEB3B';

          var controlText = document.createElement('div');

          controlText.innerHTML = '{{trans('util.filter.all')}}';

          applyStyleToControlText(controlText);

          controlUI.appendChild(controlText);

          controlUI.addEventListener('click', function() {

              setAllControlsBackgroundWhite();
              controls.showAll.style.backgroundColor = '#FFEB3B';

              cafes.map(function(cafe, i){
                  cafe.qualified = true;
                  markers[i].setMap(map);
              });

              markerCluster.clearMarkers();
              markerCluster.addMarkers(markers);

              @if(App::environment()==='production')
              ga('send', 'event', 'Filter Button - Map', 'Click', 'All');
              @endif
          });

          map.controls[google.maps.ControlPosition.TOP_LEFT].push(controlUI);

        }

        function ShowWorkingControl(map) {

          var controlUI = document.createElement('div');

          controls.showWorking = controlUI;

          applyStyleToControlUI(controlUI);

          controlUI.title = '只顯示適合工作的咖啡廳';

          var controlText = document.createElement('div');

          applyStyleToControlText(controlText);

          controlText.innerHTML = '{{trans('util.filter.work')}}';

          controlUI.appendChild(controlText);

          controlUI.addEventListener('click', function() {

              setAllControlsBackgroundWhite();
              controls.showWorking.style.backgroundColor = '#FFEB3B';

              markerCluster.clearMarkers();

              cafes.map(function(cafe, i){
                  if (cafe.isGoodForWorking === false) {
                      cafe.qualified = false;
                      markers[i].setMap(null);
                  } else {
                      cafe.qualified = true;
                      markers[i].setMap(map);
                      markerCluster.addMarker(markers[i]);
                  }
              });

              @if(App::environment()==='production')
              ga('send', 'event', 'Filter Button - Map', 'Click', 'Work');
              @endif
          });

          map.controls[google.maps.ControlPosition.TOP_LEFT].push(controlUI);

        }

        function ShowCustomControl(map) {

          var controlUI = document.createElement('div');

          controls.showCustom = controlUI;

          applyStyleToControlUI(controlUI);

          controlUI.title = '根據自訂條件篩選咖啡廳';

          var controlText = document.createElement('div');

          applyStyleToControlText(controlText);

          controlText.innerHTML = '{{trans('util.filter.custom')}}';

          controlUI.appendChild(controlText);

          controlUI.addEventListener('click', function() {

              $('#custom-filter-modal').modal('show');
          });

          map.controls[google.maps.ControlPosition.TOP_LEFT].push(controlUI);

        }

        function ShowStarControl(map) {

          var controlUI = document.createElement('div');

          controls.showStar = controlUI;

          applyStyleToControlUI(controlUI);

          controlUI.title = '只顯示系統嚴選的咖啡廳';

          var controlText = document.createElement('div');

          applyStyleToControlText(controlText);

          controlText.innerHTML = '嚴選';

          controlUI.appendChild(controlText);

          if (openGuideFeature) {
              controlUI.addEventListener('click', function() {

                  setAllControlsBackgroundWhite();
                  controls.showStar.style.backgroundColor = '#FFEB3B';

                  markerCluster.clearMarkers();

                  cafes.map(function(cafe, i){
                      if (cafe.attr.is_starred === false) {
                          cafe.qualified = false;
                          markers[i].setMap(null);
                      } else {
                          cafe.qualified = true;
                          markers[i].setMap(map);
                          markerCluster.addMarker(markers[i]);
                      }
                  });

              });
          } else {
              controlUI.addEventListener('click', function() {

                  $('#guide-filter-modal').modal('show');

              });

          }


          map.controls[google.maps.ControlPosition.TOP_LEFT].push(controlUI);
        }


      function initMap() {

        map = new google.maps.Map(document.getElementById('map'), {
          zoom: {{ $center['zoom'] }},
          center: { lat: {{ $center['lat'] }}, lng: {{ $center['lng'] }} },
          gestureHandling: 'greedy',
          mapTypeControl: false
        });

        ShowAllControl(map);
        ShowWorkingControl(map);
        ShowCustomControl(map);

        ShowStarControl(map);

        cafes.map(function(cafe){

            var marker = new google.maps.Marker({
              position: {lat: cafe.latitude, lng: cafe.longitude},
              map: map,
              label : {text: cafe.name, color: 'black'},
              icon: cafe.type == 'new' ? '/img/markers/cyan.png' : (cafe.attr.is_donated ? donatedIcon : '')
            });

            google.maps.event.addListener(marker, 'click', function() {
                openModalByUuid(cafe.id, 'map');
            });

            updateBorder({ latitude:  cafe.latitude, longitude: cafe.longitude });

            markers.push(marker);

        });

        markerCluster = new MarkerClusterer(map, markers, {
            imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m',
            maxZoom: {{ $center['zoom'] - 1 }}
        });

        google.maps.event.addListener(map, 'dragend', function() {

            myStore.panel.loading = true;

            myStore.panel.cafes = [];

            renderPanel();

            var lat = this.getCenter().lat();
            var lng = this.getCenter().lng();
            var center = {
                lat: lat,
                lng: lng
            };
            cafes.map(function(cafe){
                if (!cafe.qualified) return;

                if ( distance(cafe, center) < 500 ) {
                    myStore.panel.cafes.push(cafe);
                }
            });

            myStore.panel.cafes.sort(function(a,b) {return (a.score > b.score) ? -1 : ((b.score > a.score) ? 1 : 0);} );

            myStore.panel.loading = false;

            renderPanel();
        });


        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            // console.log(pos);

            @if(!isset($targetCafe))
            if (pos.lng > myStore.border.left && pos.lng < myStore.border.right &&
                pos.lat > myStore.border.bottom && pos.lat < myStore.border.top
            ) {
                var infoWindow = new google.maps.InfoWindow({map: map});
                infoWindow.setPosition(pos);
                infoWindow.setContent('您現在這裡。');
                map.setCenter(pos);
            }
            @endif
          }, function() {
            // no-op
          });
        } else {
          // Browser doesn't support Geolocation
          // no-op
        }

      }

      function moveMap(pos, id)
      {
          map.setCenter(pos);
          openModalByUuid(id, 'map')
      }

      var myStore = {
          cafes: [],
          panel: {
              loading: false,
              cafes: []
          },
          border: null
      };

      function updateBorder(cafe)
      {
          if (myStore.border === null) {
              myStore.border = {
                  left: cafe.longitude,
                  right: cafe.longitude,
                  top: cafe.latitude,
                  bottom: cafe.latitude
              };
          } else {
              if (cafe.longitude > myStore.border.right) myStore.border.right = cafe.longitude;
              if (cafe.longitude < myStore.border.left) myStore.border.left = cafe.longitude;
              if (cafe.latitude > myStore.border.top) myStore.border.top = cafe.latitude;
              if (cafe.latitude < myStore.border.bottom) myStore.border.bottom = cafe.latitude;
          }
      }

      function renderPanel()
      {
          $('.navigation-body').empty();


          $('.navigation-panel .header .text').text('找店小幫手');

          if (myStore.panel.loading) {
              var $loader = new $('<img src="/img/loader.gif">');
              $loader.css('display', 'block');
              $loader.css('width', '100px');
              $loader.css('margin', '0 auto');
              $loader.css('margin-top', '20px');
              $('.navigation-body').append($loader);
          } else {
              if (myStore.panel.cafes.length === 0) {
                  var $entry = new $('<div class="message">');
                  $entry.text('此區域資料還在整理，小幫手暫時無法分析。');
                  $('.navigation-body').append($entry);
              } else {
                  myStore.panel.cafes.map(function(cafe){
                      var $entry = new $('<div class="cafe-entry">');
                      $entry.click(function(){
                          openModalByUuid(cafe.id, 'map');
                      });
                      $entry.append(new $('<span class="blue">' + cafe.score.toFixed(1) + ' ★ </span>'));

                      if (cafe.type === 'new') {
                          $entry.append(new $('<span class="newlabel">新</span>'));
                      }

                      if (cafe.attr.is_donated) {
                          $entry.append(new $('<span class="donatedlabel">贊</span>'));
                      }

                      $entry.append('<span class="name">' + cafe.name + '</span>');
                      $('.navigation-body').append($entry);
                  });
              }
          }
      }

      function distance(cafe, center)
      {
          var d = (cafe.latitude - center.lat)*110.574 * (cafe.latitude - center.lat)*110.574 +
            (cafe.longitude - center.lng)*100.890 * (cafe.longitude - center.lng)*100.890;

          d = Math.sqrt(d);

          return d*1000;
      }

    </script>

    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
    </script>

    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDd_FdsWuxc57ZS7UN5UDbCoNixvZ1UFpc&callback=initMap&language={{LaravelLocalization::getCurrentLocale()}}">
    </script>

    <div style='position: fixed; bottom: 20px; left: 0px;'>
        <div class='navigation-panel @if(Layout::isMobile()) -mobile @endif'>
            <label for='show-entries' id='toggle-label'>
            <div class='header'>
                <i class="fa fa-search"></i>&nbsp;
                @if(CafeNomad::getDonatedCafes(Layout::getCity())->count() !== 0)
                <span class='text'>{{Config::get('city.'.Layout::getCity().'.zh')}}的贊助店家</span>
                @else
                <span class='text'>找店小幫手</span>
                @endif
                <i class="fa fa-minus -toggle -minus"></i>
                <i class="fa fa-plus -toggle -plus"></i>
            </div>
            </label>
            <input type='checkbox' id='show-entries'>
            <div class='navigation-body'>
                @if(CafeNomad::getDonatedCafes(Layout::getCity())->count() !== 0)
                    <div style='padding: 10px;'>
                        @include('partial/_thanks-box-map', ['cafe' => CafeNomad::getDonatedCafes(Layout::getCity())->first()])
                        <a href='/donate' style='color: white; font-size: 12px;'>成為贊助店家，取得特別曝光</a>
                    </div>
                @else
                    <div class='message'>
                        這裡會顯示各項星星分數加總之後，哪些店家的分數最高。
                    </div>
                @endif

            </div>
        </div>
    </div>

    <style>
        .-plus {
            display: none;
        }

        #toggle-label {
            display: block;
            font-weight: normal;
            margin-bottom: 0;
        }

        #toggle-label:hover {
            cursor: pointer;
        }

        #show-entries {
            display: none;
        }

        .navigation-panel {
            background-color: #424242;
            color: white;
            padding: 0px;
            width: 375px;
            height: 250px;
            overflow: auto;
        }

        .navigation-panel.-mobile {
            height: 175px;
            width: 220px;
        }

        .navigation-panel.-hide {
            height: auto;
        }

        .navigation-panel .header {
            background-color: #212121;
            padding: 5px;
        }

        .navigation-panel .header .-toggle {
            float: right;
            padding-right: 5px;
            padding-top: 2px;
            color: #9E9E9E;
        }

        .navigation-panel .header .-toggle:hover {
            cursor: pointer;
            color: white;
        }

        .navigation-panel.-hide .navigation-body {
            display: none;
        }

        .navigation-panel .navigation-body {
            padding-bottom: 10px;
        }

        .navigation-panel .cafe-entry {
            padding-top: 10px;
            padding-left: 10px;
            padding-right: 10px;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        .navigation-panel .cafe-entry .name:hover {
            text-decoration: underline;
            cursor: pointer;
        }

        .navigation-panel.-hide .cafe-entry {
            display: none;
        }

        .navigation-panel .message {
            padding-top: 10px;
            padding-left: 10px;
            padding-right: 10px;
            line-height: 1.7;
        }

    </style>

    <script>
        $(document).ready(function(){
            @if(isset($targetCafe))
            openModalByUuid('{{ $targetCafe->id }}', 'map');
            @endif

            $('#show-entries').change(function(){
                if ($(this).prop('checked')) {
                    $('.-toggle.-minus').hide();
                    $('.-toggle.-plus').show();
                    $('.navigation-panel').addClass('-hide');
                } else {
                    $('.-toggle.-minus').show();
                    $('.-toggle.-plus').hide();
                    $('.navigation-panel').removeClass('-hide');
                }
            });

        });
    </script>

    @include('_open-modal')

    @include('partial/_custom-filter-feature-map')

    @include('partial/_guide-filter-modal')

@endsection
