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
                        <th class="sort" data-sort="c0">{{Config::get('nomadic.global.name_of_unit')}}</th>
                        @foreach(Config::get('review-fields') as $field)
                        <th>{{$field['label']}}</th>
                        @endforeach
                        @foreach(Config::get('info-fields') as $field)
                        <th>{{$field['label']}}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="list">
                    @foreach($entities as $entity)
                    <tr id='{{$entity->id}}' class='@if(in_array('mrt', $fields)) {{mrtClass($entity->mrt)}} @endif @if(!$entity->isGoodForWorking()) not-working-entity @endif @if($entity->is_starred) is-starred-entity @endif' onclick="openModalByUuid('{{$entity->id}}', 'list')">
                        <td class="c0">
                            <div style='text-overflow: ellipsis; width: 110px; overflow: hidden;'>
                                <a href='/{{Config::get('nomadic.global.unit-url')}}/{{$entity->id}}' onclick="return false;" class="seo-link">{{$entity->name}}</a>
                            </div>
                        </td>

                        @foreach(Config::get('review-fields') as $field)
                        <td class="c1 {{starClass($entity->getReviewFieldValue($field['key']))}}">
                            @if($entity->getReviewFieldValue($field['key']))
                            {{number_format($entity->getReviewFieldValue($field['key']), 1)}}  ★
                            @else

                            @endif
                        </td>
                        @endforeach

                        @foreach(Config::get('info-fields') as $field)
                        <td class="c1">
                            <div style='text-overflow: ellipsis; max-width: 90px; overflow: hidden;'>
                                @if($entity->getInfoFieldValue($field['key']))
                                {{$entity->getInfoFieldValue($field['key'])}}
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

@include('nomadicore::_mobile-smart-table-head')

<script type="text/javascript">
    var options = {
        valueNames: [ 'c0', 'c1', 'c2', 'c3', 'c4', 'c5', 'c6', 'c7', 'c8', 'c9', 'c10', 'c11', 'c12', 'c13', 'c14', 'c15', 'c16', 'c17' ]
    };
    new List('table-wrapper', options);
</script>

<script>
    $(document).ready(function(){
        $('.search').change(function(e){
            $.get('/track/search?keyword=' + e.target.value);
        });
    })
</script>

@include('nomadicore::_open-modal')
