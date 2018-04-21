
<style>

.openinghours-box {
    padding: 10px;
    max-width: 190px;
    border: 1px solid grey;
}

.openinghours-form {
    max-width: 420px;
}

.dateTime {
  margin: 0 auto;
}

.openinghours-form .dateTime {
    clear: both;
}

.day {
  display: inline-block;
  float: left;
}

.time {
  display: inline-block;
  position: relative;
  float: right
}

.today {
  color: rgb(200, 85, 39);
  font-weight: bold;
}

.timepicker {
    width: 70px !important;
}

</style>

<script>

    var data = {
        "monday": {
            "open": "00:00",
            "close": "00:00"
        },
        "tuesday": {
            "open": "00:00",
            "close": "00:00"
        },
        "wednesday": {
            "open": "00:00",
            "close": "00:00"
        },
        "thursday": {
            "open": "00:00",
            "close": "00:00"
        },
        "friday": {
            "open": "00:00",
            "close": "00:00"
        },
        "saturday": {
            "open": "00:00",
            "close": "00:00"
        },
        "sunday": {
            "open": "00:00",
            "close": "00:00"
        },
    };

    var days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

    $(document).ready(function(){
        days.map(function(day){
            $('#' + day + ' .timepicker.-open').pickatime({
                interval: 15,
                format: 'HH:i',
                onSet: function(context) {
                    generateDataModel();

                    insertJsonTo();
                }
            });

            $('#' + day + ' .timepicker.-close').pickatime({
                interval: 15,
                format: 'HH:i',
                onSet: function(context) {

                    generateDataModel();

                    insertJsonTo();
                }
            });

            $('#' + day + ' .dayoff').change(function(){
                if ($(this).prop('checked')) {
                    $('#' + day + ' .timepicker.-open').prop('disabled', true);
                    $('#' + day + ' .timepicker.-close').prop('disabled', true);
                    $('#' + day + ' button').prop('disabled', true);

                    generateDataModel();

                    insertJsonTo();
                } else {
                    $('#' + day + ' .timepicker.-open').prop('disabled', false);
                    $('#' + day + ' .timepicker.-close').prop('disabled', false);
                    $('#' + day + ' button').prop('disabled', false);

                    generateDataModel();

                    insertJsonTo();
                }
            })

        });

        generateDataModel();

        insertJsonTo();
    });

    function generateDataModel()
    {
        days.map(function(day){
            if ($('#' + day + ' .dayoff').prop('checked')) {
                data[day]['open'] = null;
                data[day]['close'] = null;
            } else {
                data[day]['open'] = $('#' + day + ' .timepicker.-open').val();
                data[day]['close'] = $('#' + day + ' .timepicker.-close').val();
            }
        });
    }

    function insertJsonTo()
    {
        $('input[name="{{$inputName}}"]').val(JSON.stringify(data));
    }

    function applyFrom(day)
    {
        var openTime = $('#' + day + ' .timepicker.-open').val();
        var closeTime = $('#' + day + ' .timepicker.-close').val();

        var days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

        days.map(function(d){
            if ($('#' + d + ' .dayoff').prop('checked')) return;

            $('#' + d + ' .timepicker.-open').val(openTime);
            $('#' + d + ' .timepicker.-close').val(closeTime);
        });

        generateDataModel();

        insertJsonTo();
    }

</script>
