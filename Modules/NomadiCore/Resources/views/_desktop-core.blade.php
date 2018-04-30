<div class='row'>
    <div id='table-wrapper'>

        <!--
        <input class="search form-control" placeholder="Search" />
        <br />
        -->
        <table class='table table-hover table-condensed table-striped'>
            <thead>
                <tr>
                    <th class="sort -large" data-sort="c0">{{Config::get('nomadic.global.name_of_unit')}}</th>
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
                    <td class="c0 -large">
                        <a href='/{{Config::get('nomadic.global.unit-url')}}/{{$entity->id}}' onclick="return false;" class="seo-link">{{$entity->name}}</a>
                        @if($entity->note!=='')
                            <br />
                            <div class='minor grey note' style='display: none;'>{{$entity->note}} - {{$entity->who}}</div>
                        @endif
                    </td>
                    @foreach(Config::get('review-fields') as $field)
                    <td class="c1 -small {{starClass($entity->getReviewFieldValue($field['key']))}}">
                        @if($entity->getReviewFieldValue($field['key']))
                        {{number_format($entity->getReviewFieldValue($field['key']), 1)}}  ★
                        @else

                        @endif
                    </td>
                    @endforeach

                    @foreach(Config::get('info-fields') as $field)
                    <td class="c1 -small">
                        {{ displayInfoField($field, $entity->getInfoFieldValue($field['key'])) }}
                    </td>
                    @endforeach

                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

@include('nomadicore::_smart-table-head')

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

<style>
    .table {
        table-layout: fixed;
    }
    th.-large {
        width: 150px;
    }
    th.-medium {
        width: 120px;
    }
    th.-small {
        width: 60px;
    }

</style>

@include('nomadicore::_open-modal')
