@extends('layout')

@section('head')
<style>
    th, td {
        padding-top: 16px !important;
        padding-bottom: 16px !important;
    }
    td:first-child {
        width: auto;
    }
</style>

@endsection

@section('content')

<div class='container'>
    @include('_mobile-core')
</div>

<br>
<br>

<script>
    $(document).ready(function(){
        @if(isset($targetEntity))
        openModalByUuid('{{ $targetEntity->id }}', 'list');
        @endif
    });
</script>

@include('partial/_footer')

@endsection
