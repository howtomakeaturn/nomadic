@extends('layout')

@section('content')
<div class='container'>
    <div class='row'>
        <div class='col-md-12'>
            @if( $title )
            <h2>{{ $title }}</h2>
            @endif
            @if( $message )
            <div class="alert alert-info" role="alert">
                {{ $message }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
