@extends('nomadicore::layout')

@section('content')

<div class='container'>

    <div class='row'>

        <div class='col-md-6'>
            <h3>造訪動態</h3>
            <br>
            @foreach($recs as $rec)
                <div style='border-bottom: 1px solid #e9e9e9; padding: 5px;'>
                    <img src="{{$rec->user->profile->avatar}}" style="border-radius: 50%;">
                    <span style='color: darkgreen; '>{{ $rec->user->name }}</span>
                    造訪過
                    <span style='font-weight: bold;'>{{ $rec->cafe->name }}</span>
                    <span style='color: #aaa;'>{{'@'.$rec->created_at->format('m-d H:i')}}</span>
                </div>
            @endforeach
        </div>

        <div class='col-md-6'>
            <h3>想去動態</h3>
            <br>
            @foreach($wishes as $wish)
                <div style='border-bottom: 1px solid #e9e9e9; padding: 5px;'>
                    <img src="{{$wish->user->profile->avatar}}" style="border-radius: 50%;">
                    <span style='color: darkgreen; '>{{ $wish->user->name }}</span>
                    想去
                    <span style='font-weight: bold;'>{{ $wish->cafe->name }}</span>
                    <span style='color: #aaa;'>{{'@'.$wish->created_at->format('m-d H:i')}}</span>
                </div>
            @endforeach
        </div>

    </div>

</div>
@endsection
