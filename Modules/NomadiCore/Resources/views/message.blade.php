@extends('nomadicore::layout')

@section('content')
<div class='container'>
    <div class='row'>
        <div class='col-md-12'>
            <h2>系統已收到您的評分，謝謝您協助評分！</h2>
            <div class="alert alert-info" role="alert">
                新的評分不會直接蓋過舊的評分。<br>
                系統會定期統計分數，並在網站上顯示中位數。
            </div>
        </div>
    </div>
</div>
@endsection
