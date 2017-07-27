<div class='row'>
    <div id='table-wrapper'>

        <!--
        <input class="search form-control" placeholder="Search" />
        <br />
        -->
        <table class='table table-hover table-condensed table-striped'>
            <thead>
                <tr>
                    <th class="sort -large" data-sort="c0">{{trans('util.fields.name')}}</th>
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
                    <td class="c0 -large">
                        <a href='/shop/{{$cafe->id}}' onclick="return false;" class="seo-link">{{$cafe->name}}</a>
                        @if($cafe->note!=='')
                            <br />
                            <div class='minor grey note' style='display: none;'>{{$cafe->note}} - {{$cafe->who}}</div>
                        @endif
                    </td>
                    @foreach(Config::get('review-fields') as $field)
                    <td class="c1 -small {{starClass($cafe->getReviewFieldValue($field['key']))}}">
                        @if($cafe->getReviewFieldValue($field['key']))
                        {{number_format($cafe->getReviewFieldValue($field['key']), 1)}}  ★
                        @else

                        @endif
                    </td>
                    @endforeach

                    @foreach(Config::get('info-fields') as $field)
                    <td class="c1 -small">
                        @if($cafe->getInfoFieldValue($field['key']))
                        {{$cafe->getInfoFieldValue($field['key'])}}
                        @else

                        @endif
                    </td>
                    @endforeach

                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

@include('_smart-table-head')

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

@include('_open-modal')
