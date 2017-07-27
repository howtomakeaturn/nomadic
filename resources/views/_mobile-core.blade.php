<div class='row'>
    <div id='table-wrapper'>

        <!--
        <input class="search form-control" placeholder="Search" />
        <br />
        -->
        <div class="table-responsive">
            <table class='table table-hover table-condensed'>
                <thead>
                    <tr>
                        <th class="sort" data-sort="c0">{!! trans('util.m-fields.name') !!}</th>
                        @foreach(Config::get('review-fields') as $field)
                        <th>{{$field['label']}}</th>
                        @endforeach
                        @foreach(Config::get('info-fields') as $field)
                        <th>{{$field['label']}}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="list">
                    @foreach($cafes as $cafe)
                    <tr id='{{$cafe->id}}' class='@if(in_array('mrt', $fields)) {{mrtClass($cafe->mrt)}} @endif @if(!$cafe->isGoodForWorking()) not-working-cafe @endif @if($cafe->is_starred) is-starred-cafe @endif' onclick="openModalByUuid('{{$cafe->id}}', 'list')">
                        <td class="c0">
                            <div style='text-overflow: ellipsis; width: 110px; overflow: hidden;'>
                                <a href='/shop/{{$cafe->id}}' onclick="return false;" class="seo-link">{{$cafe->name}}</a>
                            </div>
                        </td>

                        @foreach(Config::get('review-fields') as $field)
                        <td class="c1 {{starClass($cafe->getReviewFieldValue($field['key']))}}">
                            @if($cafe->getReviewFieldValue($field['key']))
                            {{number_format($cafe->getReviewFieldValue($field['key']), 1)}}  ★
                            @else

                            @endif
                        </td>
                        @endforeach

                        @foreach(Config::get('info-fields') as $field)
                        <td class="c1">
                            <div style='text-overflow: ellipsis; max-width: 90px; overflow: hidden;'>
                                @if($cafe->getInfoFieldValue($field['key']))
                                {{$cafe->getInfoFieldValue($field['key'])}}
                                @else

                                @endif
                            </div>
                        </td>
                        @endforeach

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('_mobile-smart-table-head')

<script type="text/javascript">
    var options = {
        valueNames: [ 'c0', 'c1', 'c2', 'c3', 'c4', 'c5', 'c6', 'c7', 'c8', 'c9', 'c10', 'c11', 'c12', 'c13', 'c14', 'c15', 'c16', 'c17' ]
    };
    var cafeList = new List('table-wrapper', options);
</script>

<script>
    $(document).ready(function(){
        $('.search').change(function(e){
            $.get('/track/search?keyword=' + e.target.value);
        });
    })
</script>

@include('_open-modal')
