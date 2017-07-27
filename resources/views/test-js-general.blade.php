@extends('layout')
@section('head')
<title>QUnit Example</title>
<link rel="stylesheet" href="https://code.jquery.com/qunit/qunit-2.3.0.css">
@endsection
@section('content')
<div id="qunit"></div>
<div id="qunit-fixture"></div>
<script src="https://code.jquery.com/qunit/qunit-2.3.0.js"></script>
<script>

    QUnit.test( "validateBusinessHours test: filter not activated", function( assert ) {
        var cafe = {
            attr: {
                business_hours: {
                    "monday":{"open":"09:00","close":"22:00"},
                    "tuesday":{"open":null,"close":null},
                    "wednesday":{"open":"09:00","close":"22:00"},
                    "thursday":{"open":"09:00","close":"22:00"},
                    "friday":{"open":"09:00","close":"22:00"},
                    "saturday":{"open":"09:00","close":"22:00"},
                    "sunday":{"open":"09:00","close":"22:00"}
                }
            }
        };

        var filter = {
            is_open: false,
            is_open_at_day: 'monday',
            is_open_at_time: '07:00',
        };

        assert.ok( validateBusinessHours(cafe, filter) == true, "Passed!" );
    });

    QUnit.test( "validateBusinessHours test: in an opening hour", function( assert ) {
        var cafe = {
            attr: {
                business_hours: {
                    "monday":{"open":"09:00","close":"22:00"},
                    "tuesday":{"open":null,"close":null},
                    "wednesday":{"open":"09:00","close":"22:00"},
                    "thursday":{"open":"09:00","close":"22:00"},
                    "friday":{"open":"09:00","close":"22:00"},
                    "saturday":{"open":"09:00","close":"22:00"},
                    "sunday":{"open":"09:00","close":"22:00"}
                }
            }
        };

        var filter = {
            is_open: true,
            is_open_at_day: 'monday',
            is_open_at_time: '10:00',
        };

        assert.ok( validateBusinessHours(cafe, filter) == true, "Passed!" );
    });

    QUnit.test( "validateBusinessHours test: in an off hour", function( assert ) {
        var cafe = {
            attr: {
                business_hours: {
                    "monday":{"open":"09:00","close":"22:00"},
                    "tuesday":{"open":null,"close":null},
                    "wednesday":{"open":"09:00","close":"22:00"},
                    "thursday":{"open":"09:00","close":"22:00"},
                    "friday":{"open":"09:00","close":"22:00"},
                    "saturday":{"open":"09:00","close":"22:00"},
                    "sunday":{"open":"09:00","close":"22:00"}
                }
            }
        };

        var filter = {
            is_open: true,
            is_open_at_day: 'tuesday',
            is_open_at_time: '23:00',
        };

        assert.ok( validateBusinessHours(cafe, filter) == false, "Passed!" );
    });

    QUnit.test( "validateBusinessHours test: in an off day", function( assert ) {
        var cafe = {
            attr: {
                business_hours: {
                    "monday":{"open":"09:00","close":"22:00"},
                    "tuesday":{"open":null,"close":null},
                    "wednesday":{"open":"09:00","close":"22:00"},
                    "thursday":{"open":"09:00","close":"22:00"},
                    "friday":{"open":"09:00","close":"22:00"},
                    "saturday":{"open":"09:00","close":"22:00"},
                    "sunday":{"open":"09:00","close":"22:00"}
                }
            }
        };

        var filter = {
            is_open: true,
            is_open_at_day: 'monday',
            is_open_at_time: '23:00',
        };

        assert.ok( validateBusinessHours(cafe, filter) == false, "Passed!" );
    });

    QUnit.test( "validateBusinessHours test: just on the open time", function( assert ) {
        var cafe = {
            attr: {
                business_hours: {
                    "monday":{"open":"09:00","close":"22:00"},
                    "tuesday":{"open":null,"close":null},
                    "wednesday":{"open":"09:00","close":"22:00"},
                    "thursday":{"open":"09:00","close":"22:00"},
                    "friday":{"open":"09:00","close":"22:00"},
                    "saturday":{"open":"09:00","close":"22:00"},
                    "sunday":{"open":"09:00","close":"22:00"}
                }
            }
        };

        var filter = {
            is_open: true,
            is_open_at_day: 'monday',
            is_open_at_time: '09:00',
        };

        assert.ok( validateBusinessHours(cafe, filter) == true, "Passed!" );
    });

    QUnit.test( "validateBusinessHours test: just on the close time", function( assert ) {
        var cafe = {
            attr: {
                business_hours: {
                    "monday":{"open":"09:00","close":"22:00"},
                    "tuesday":{"open":null,"close":null},
                    "wednesday":{"open":"09:00","close":"22:00"},
                    "thursday":{"open":"09:00","close":"22:00"},
                    "friday":{"open":"09:00","close":"22:00"},
                    "saturday":{"open":"09:00","close":"22:00"},
                    "sunday":{"open":"09:00","close":"22:00"}
                }
            }
        };

        var filter = {
            is_open: true,
            is_open_at_day: 'monday',
            is_open_at_time: '22:00',
        };

        assert.ok( validateBusinessHours(cafe, filter) == false, "Passed!" );
    });

    QUnit.test( "validateBusinessHours test: too early", function( assert ) {
        var cafe = {
            attr: {
                business_hours: {
                    "monday":{"open":"09:00","close":"22:00"},
                    "tuesday":{"open":null,"close":null},
                    "wednesday":{"open":"09:00","close":"22:00"},
                    "thursday":{"open":"09:00","close":"22:00"},
                    "friday":{"open":"09:00","close":"22:00"},
                    "saturday":{"open":"09:00","close":"22:00"},
                    "sunday":{"open":"09:00","close":"22:00"}
                }
            }
        };

        var filter = {
            is_open: true,
            is_open_at_day: 'monday',
            is_open_at_time: '08:00',
        };

        assert.ok( validateBusinessHours(cafe, filter) == false, "Passed!" );
    });

    QUnit.test( "validateBusinessHours test: too late", function( assert ) {
        var cafe = {
            attr: {
                business_hours: {
                    "monday":{"open":"09:00","close":"22:00"},
                    "tuesday":{"open":null,"close":null},
                    "wednesday":{"open":"09:00","close":"22:00"},
                    "thursday":{"open":"09:00","close":"22:00"},
                    "friday":{"open":"09:00","close":"22:00"},
                    "saturday":{"open":"09:00","close":"22:00"},
                    "sunday":{"open":"09:00","close":"22:00"}
                }
            }
        };

        var filter = {
            is_open: true,
            is_open_at_day: 'monday',
            is_open_at_time: '23:00',
        };

        assert.ok( validateBusinessHours(cafe, filter) == false, "Passed!" );
    });

    QUnit.test( "validateBusinessHours test: early morning for late night cafe", function( assert ) {
        var cafe = {
            attr: {
                business_hours: {
                    "monday":{"open":"14:00","close":"04:00"},
                    "tuesday":{"open":"14:00","close":"04:00"},
                    "wednesday":{"open":"14:00","close":"04:00"},
                    "thursday":{"open":"14:00","close":"04:00"},
                    "friday":{"open":"14:00","close":"04:00"},
                    "saturday":{"open":"14:00","close":"04:00"},
                    "sunday":{"open":"14:00","close":"04:00"}
                }
            }
        };

        var filter = {
            is_open: true,
            is_open_at_day: 'monday',
            is_open_at_time: '01:00',
        };

        assert.ok( validateBusinessHours(cafe, filter) == true, "Passed!" );
    });

    QUnit.test( "validateBusinessHours test: morning for late night cafe", function( assert ) {
        var cafe = {
            attr: {
                business_hours: {
                    "monday":{"open":"14:00","close":"04:00"},
                    "tuesday":{"open":"14:00","close":"04:00"},
                    "wednesday":{"open":"14:00","close":"04:00"},
                    "thursday":{"open":"14:00","close":"04:00"},
                    "friday":{"open":"14:00","close":"04:00"},
                    "saturday":{"open":"14:00","close":"04:00"},
                    "sunday":{"open":"14:00","close":"04:00"}
                }
            }
        };

        var filter = {
            is_open: true,
            is_open_at_day: 'monday',
            is_open_at_time: '07:00',
        };

        assert.ok( validateBusinessHours(cafe, filter) == false, "Passed!" );
    });

    QUnit.test( "validateBusinessHours test: late night cafe edge case 1", function( assert ) {
        var cafe = {
            attr: {
                business_hours: {
                    "monday":{"open":"14:00","close":"04:00"},
                    "tuesday":{"open":null,"close":null},
                    "wednesday":{"open":"14:00","close":"04:00"},
                    "thursday":{"open":"14:00","close":"04:00"},
                    "friday":{"open":"14:00","close":"04:00"},
                    "saturday":{"open":"14:00","close":"04:00"},
                    "sunday":{"open":"14:00","close":"04:00"}
                }
            }
        };

        var filter = {
            is_open: true,
            is_open_at_day: 'monday',
            is_open_at_time: '02:00',
        };

        assert.ok( validateBusinessHours(cafe, filter) == true, "Passed!" );
    });

    QUnit.test( "validateBusinessHours test: late night cafe edge case 2", function( assert ) {
        var cafe = {
            attr: {
                business_hours: {
                    "monday":{"open":"14:00","close":"04:00"},
                    "tuesday":{"open":null,"close":null},
                    "wednesday":{"open":"14:00","close":"04:00"},
                    "thursday":{"open":"14:00","close":"04:00"},
                    "friday":{"open":"14:00","close":"04:00"},
                    "saturday":{"open":"14:00","close":"04:00"},
                    "sunday":{"open":"14:00","close":"04:00"}
                }
            }
        };

        var filter = {
            is_open: true,
            is_open_at_day: 'tuesday',
            is_open_at_time: '02:00',
        };

        assert.ok( validateBusinessHours(cafe, filter) == true, "Passed!" );
    });

    QUnit.test( "validateBusinessHours test: late night cafe edge case 3", function( assert ) {
        var cafe = {
            attr: {
                business_hours: {
                    "monday":{"open":"14:00","close":"04:00"},
                    "tuesday":{"open":null,"close":null},
                    "wednesday":{"open":"14:00","close":"04:00"},
                    "thursday":{"open":"14:00","close":"04:00"},
                    "friday":{"open":"14:00","close":"04:00"},
                    "saturday":{"open":"14:00","close":"04:00"},
                    "sunday":{"open":"14:00","close":"04:00"}
                }
            }
        };

        var filter = {
            is_open: true,
            is_open_at_day: 'wednesday',
            is_open_at_time: '02:00',
        };

        assert.ok( validateBusinessHours(cafe, filter) == false, "Passed!" );
    });

</script>
@endsection
