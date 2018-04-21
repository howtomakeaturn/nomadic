@extends('layout')

@section('content')

<div class='container'>

@include('_desktop-core')
</div>

<br>
<br>

@include('partial/_footer')

<style>
    .note {
        display: none;
    }
</style>

<script>
    $(document).ready(function(){
        @if(isset($targetEntity))
        openModalByUuid('{{ $targetEntity->id }}', 'list');
        @endif
    });
</script>
@endsection
