@extends('layout')

@section('head')

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['line']});
      google.charts.setOnLoadCallback(drawChart);

      var arr1 = [['日期', '次數']];
      @foreach($data as $key => $value)
          arr1.push(['{{$key}}', {{$value}}]);
      @endforeach

      var arr2 = [['日期', '次數']];
      @foreach($displayData as $key => $value)
          arr2.push(['{{$key}}', {{$value}}]);
      @endforeach

      var arr3 = [['日期', '次數']];
      @foreach($displayData2 as $key => $value)
          arr3.push(['{{$key}}', {{$value}}]);
      @endforeach

      function drawChart() {

        var data1 = google.visualization.arrayToDataTable(arr1);

        var options = {
          chart: {
            title: '每日瀏覽次數統計',
            subtitle: '店家詳細資料的視窗打開一次，計為一次',
          },
          bars: 'vertical' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Line(document.getElementById('linechart_material'));

        chart.draw(data1, options);

      }
    </script>
@endsection



@section('content')

<br>

<div class='container'>

    <div class='row'>
        <div class='col-md-12'>
            <div style="font-size: 3em; text-align: center; margin-bottom: 0.25em; line-height: 1;">{{$cafe->name}}</div>

            @include('shop/_nav')
            <!--
            <div style="font-size: 2em; text-align: center; margin-bottom: 1em;">店家每日瀏覽次數</div>
            -->
            <div id='linechart_material' style="height: 400px;"></div>

            <br>
            <br>
        </div>
    </div>

</div>

<br>

<style>

</style>

@include('partial/_footer')

@endsection
