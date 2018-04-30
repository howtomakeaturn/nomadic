@extends('nomadicore::layout')
@section('head')
    @include('nomadicore::partial/business-hours-form-head', ['inputName' => 'business_hours'])
@endsection
@section('content')
<div class='container'>
    <div class='row'>
        <div class='col-md-12'>
            <h2>您正在對「<span class='text-primary'>{{ $entity->name }}</span>」提出欄位修改建議</h2>
        </div>
    </div>
    <div class='row'>
        <div class='col-md-8'>

            <form method='post' action='/submit-editing' style='padding-left: 20px;'>
                <br>
                名稱
                <input type='text' name='name' value='{{ $entity->name }}' >
                <br>
                <br>

                地址
                <input type='text' name='address' value='{{ $entity->address }}' >
                <br>
                <br>

                @foreach(Config::get('info-fields') as $field)
                    @if($field['type'] === 'input_text')
                        {{$field['label']}}
                        <input name='{{$field['key']}}' type='text' value="{{$entity->getInfoFieldValue($field['key'])}}">
                        <br>
                        <br>
                    @elseif($field['type'] === 'select')
                        {{ $field['label'] }}
                        <select name="info_{{$field['key']}}">
                            <option value="">請選擇</option>
                            @foreach($field['options'] as $option)
                                <option value="{{ $option['key'] }}"
                                    @if($option['key'] === $entity->getInfoFieldValue($field['key'])) selected @endif
                                >
                                    {{ $option['label'] }}
                                </option>
                            @endforeach
                        </select>
                        <br>
                        <br>
                    @elseif($field['type'] === 'input_radio')
                        <div>
                        {{ $field['label'] }}
                        @foreach($field['options'] as $option)
                            <label>
                                &nbsp;
                                <input type="radio" name="{{$field['key']}}" value="{{ $option['key'] }}" @if($option['key'] === $entity->getInfoFieldValue($field['key'])) checked @endif>
                                {{ $option['label'] }}
                            </label>
                        @endforeach
                        </div>
                        <br>
                    @endif
                @endforeach

                @if(config('nomadic.business-hours-enabled'))
                營業時間<br>
                <br>
                @include('nomadicore::partial/business-hours-form', ['inputName' => 'business_hours'])

                <br>
                <br>
                <br>
                @endif

                <input type="hidden" name="entity_id" value="{{ $entity->id }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-primary btn-lg">送出欄位修改建議</button>

            </form>

        </div>
        <div class='col-md-4'>
        </div>
    </div>
</div>

<br>
<br>

@include('nomadicore::partial/_footer')

<style>
    input[type='text'] {
        width: 300px;
    }
</style>

@endsection
