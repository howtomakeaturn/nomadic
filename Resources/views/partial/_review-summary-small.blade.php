<div>
    <div class="row">
        @foreach(Config::get('review-fields') as $field)
        <div class="col-xs-6">
            <div class='rating-box'>
                {{$field['label']}}
                <div class='value {{starClass($review->getValue($field['key']))}}'>
                  @if($review->getValue($field['key']))
                  {{number_format($review->getValue($field['key']), 1)}}  ★
                  @else

                  @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
