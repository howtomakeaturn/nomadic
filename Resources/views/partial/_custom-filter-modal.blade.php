<!-- Modal -->
<div class="modal fade" id="custom-filter-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">{{trans('util.filter.custom-filters')}}</h4>
      </div>
      <div class="modal-body">
          <div class='row'>
              <div class='col-xs-12'>
                  <input type='checkbox' name='is-open-filter' id='is-open-filter'>
                  <label for='is-open-filter'>{{trans('util.filter.must-open-1')}}</label>
                  <select name='is-open-at-day'>
                      <option value='monday'>{{trans('util.filter.monday')}}</option>
                      <option value='tuesday'>{{trans('util.filter.tuesday')}}</option>
                      <option value='wednesday'>{{trans('util.filter.wednesday')}}</option>
                      <option value='thursday'>{{trans('util.filter.thursday')}}</option>
                      <option value='friday'>{{trans('util.filter.friday')}}</option>
                      <option value='saturday'>{{trans('util.filter.saturday')}}</option>
                      <option value='sunday'>{{trans('util.filter.sunday')}}</option>
                  </select>
                  <input type="text" class="timepicker" name='is-open-at-time' value='09:00'>
                  <label for='is-open-filter'>{{trans('util.filter.must-open-2')}}</label>
              </div>
          </div>
          <hr>
          <div class='row'>
              <div class="col-xs-6">
                  {{trans('util.fields.wifi')}}
                  <select name='wifi-filter'>
                      @include('nomadicore::partial/_attr-filter-options')
                  </select>
                  <br>
                  <br>
                  {{trans('util.fields.seat')}}
                  <select name='seat-filter'>
                      @include('nomadicore::partial/_attr-filter-options')
                  </select>
                  <br>
                  <br>
                  {{trans('util.fields.quiet')}}
                  <select name='quiet-filter'>
                      @include('nomadicore::partial/_attr-filter-options')
                  </select>
                  <br>
                  <br>
                  {{trans('util.fields.tasty')}}
                  <select name='tasty-filter'>
                      @include('nomadicore::partial/_attr-filter-options')
                  </select>
              </div>
              <div class="col-xs-6">
                  {{trans('util.fields.food')}}
                  <select name='food-filter'>
                      @include('nomadicore::partial/_attr-filter-options')
                  </select>
                  <br>
                  <br>
                  {{trans('util.fields.cheap')}}
                  <select name="cheap-filter">
                      @include('nomadicore::partial/_attr-filter-options')
                  </select>
                  <br>
                  <br>
                  {{trans('util.fields.music')}}
                  <select name='music-filter'>
                      @include('nomadicore::partial/_attr-filter-options')
                  </select>

              </div>
          </div>
          <hr>
          <div class='row'>
              <div class='col-xs-6'>
                  <label><input type='checkbox' name='single-origin-filter' value="yes"> {{trans('util.filter.must-offer-single-origin')}}</label>
                  <br>
                  <br>

                  <label><input type='checkbox' name='dessert-filter' value="yes"> {{trans('util.filter.must-offer-dessert')}}</label>
                  <br>
                  <br>
                  <label><input type='checkbox' name='meal-filter' value="yes"> {{trans('util.filter.must-offer-meal')}}</label>
                  <br>

              </div>

              <div class='col-xs-6'>
                  {{trans('util.filter.time-limit')}}
                  <select name='limited-time-filter'>
                      <option value='any'>{{trans('util.filter.any')}}</option>
                      <option value='maybe+'>{{trans('util.filter.time-limit-option-1')}}</option>
                      <option value='no'>{{trans('util.filter.time-limit-option-2')}}</option>
                  </select>

                  <br>
                  <br>

                  {{trans('util.filter.power-sockets')}}
                  <select name='socket-filter'>
                      <option value='any'>{{trans('util.filter.any')}}</option>
                      <option value='maybe+'>{{trans('util.filter.power-sockets-option-1')}}</option>
                      <option value='yes'>{{trans('util.filter.power-sockets-option-2')}}</option>
                  </select>

                  <br>
                  <br>

                  <label><input type='checkbox' name='standing-desk-filter' value="yes"> {{trans('util.filter.able-to-stand')}}</label>

                  <br>
              </div>
          </div>

          <hr>
          <div class='row'>
              <div class='col-xs-12'>
                  <label><input type='checkbox' name='business-type-filter' value='local-only'> {{trans('util.filter.only-independent')}}</label>
                  <br>
                  <br>
                  <label><input type='checkbox' name='checkins-filter'> {{trans('util.filter.check-in')}}</label>
              </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id='start-filter'>{{trans('util.filter.filter')}}</button>
      </div>
    </div>
  </div>
</div>

<script>
    function getFilter() {
        var filter = {
            wifi: $('select[name="wifi-filter"]').val(),
            seat: $('select[name="seat-filter"]').val(),
            quiet: $('select[name="quiet-filter"]').val(),
            tasty: $('select[name="tasty-filter"]').val(),
            food: $('select[name="food-filter"]').val(),
            cheap: $('select[name="cheap-filter"]').val(),
            music: $('select[name="music-filter"]').val(),
            has_single_origin: $('input[name="single-origin-filter"]').prop('checked'),
            has_dessert: $('input[name="dessert-filter"]').prop('checked'),
            has_meal: $('input[name="meal-filter"]').prop('checked'),
            standing_desk: $('input[name="standing-desk-filter"]').prop('checked'),
            limited_time: $('select[name="limited-time-filter"]').val(),
            socket: $('select[name="socket-filter"]').val(),
            business_type: $('input[name="business-type-filter"]').prop('checked'),
            checkins: $('input[name="checkins-filter"]').prop('checked'),
            is_open: $('input[name="is-open-filter"]').prop('checked'),
            is_open_at_day: $('select[name="is-open-at-day"]').val(),
            is_open_at_time: $('input[name="is-open-at-time"]').val(),
        };

        return filter;
    }

    $(document).ready(function(){
        filter = store.get('filter');

        if (!filter) return;

        selects = ['wifi', 'seat', 'quiet', 'tasty', 'food', 'cheap', 'music'];

        selects.map(function(s){
            if (filter[s]) $('select[name="' + s +'-filter"]').val(filter[s]);
        });

        if (filter.socket) $('select[name="socket-filter"]').val(filter.socket);

        if (filter.limited_time) $('select[name="limited-time-filter"]').val(filter.limited_time);

        if (filter.has_single_origin) $('input[name="single-origin-filter"]').prop('checked', filter.has_single_origin);

        if (filter.has_dessert) $('input[name="dessert-filter"]').prop('checked', filter.has_dessert);

        if (filter.has_meal) $('input[name="meal-filter"]').prop('checked', filter.has_meal);

        if (filter.standing_desk) $('input[name="standing-desk-filter"]').prop('checked', filter.standing_desk);

        if (filter.business_type) $('input[name="business-type-filter"]').prop('checked', filter.business_type);

        if (filter.checkins) $('input[name="checkins-filter"]').prop('checked', filter.checkins);
    });

    $(document).ready(function(){
        $('.timepicker').pickatime({
            interval: 15,
            format: 'HH:i',
        });

        $('select[name="is-open-at-day"]').val('{{strtolower(Carbon\Carbon::now()->format('l'))}}');

        $('input[name="is-open-at-time"]').val('{{Carbon\Carbon::now()->format('H:i')}}');

        $('select[name="is-open-at-day"]').prop('disabled', true);

        $('input[name="is-open-at-time"]').prop('disabled', true);

        $('input[name="is-open-filter"]').change(function(){
            if ($(this).prop('checked')) {
                $('select[name="is-open-at-day"]').prop('disabled', false);

                $('input[name="is-open-at-time"]').prop('disabled', false);
            } else {
                $('select[name="is-open-at-day"]').prop('disabled', true);

                $('input[name="is-open-at-time"]').prop('disabled', true);
            }
        });
    });

</script>

<style>
.timepicker {
    width: 70px !important;
}
</style>
