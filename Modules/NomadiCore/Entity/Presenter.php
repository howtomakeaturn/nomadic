<?php

namespace Modules\NomadiCore\Entity;

use Config;
use Modules\NomadiCore\Entity;

class Presenter
{

    protected $cafe;

    public function __construct(Entity $cafe)
    {
        $this->cafe = $cafe;
    }

    function hasWifi()
    {
        if ($this->cafe->has_wifi === true) return 'Yes';

        if ($this->cafe->has_wifi === false) return 'No';

        return '';
    }

    function hasSingleOrigin()
    {
        if ($this->cafe->has_single_origin === true) return 'Yes';

        if ($this->cafe->has_single_origin === false) return 'No';

        return '';
    }

    function hasDessert()
    {
        if ($this->cafe->has_dessert === true) return 'Yes';

        if ($this->cafe->has_dessert === false) return 'No';

        return '';
    }

    function hasMeal()
    {
        if ($this->cafe->has_meal === true) return 'Yes';

        if ($this->cafe->has_meal === false) return 'No';

        return '';
    }

    function limitedTimeClass()
    {
        $str = $this->cafe->limited_time;

        if ($str === 'no') return 'blue';

        if ($str === 'maybe') return 'blue';

        if ($str === 'yes') return 'yellow';

        return '';
    }

    function socketClass()
    {
        $str = $this->cafe->socket;

        if ($str === 'yes') return 'blue';

        if ($str === 'maybe') return 'blue';

        if ($str === 'no') return 'yellow';

        return '';
    }

    function standingDeskClass()
    {
        $str = $this->cafe->standing_desk;

        if ($str === 'yes') return 'blue';

        if ($str === 'no') return 'yellow';

        return '';
    }

    function limitedTimeShort()
    {
        if ($this->cafe->limited_time === 'no') return 'No';

        if ($this->cafe->limited_time === 'maybe') return trans('util.misc.depends');

        if ($this->cafe->limited_time === 'yes') return 'Yes';

        return '';
    }

    function limitedTime()
    {
        if ($this->cafe->limited_time === 'no') return 'No';

        if ($this->cafe->limited_time === 'maybe') return trans('util.misc.depends-on-the-time');

        if ($this->cafe->limited_time === 'yes') return 'Yes';

        return '';
    }

    function socketShort()
    {
        if ($this->cafe->socket === 'no') return 'No';

        if ($this->cafe->socket === 'maybe') return trans('util.misc.not-many');

        if ($this->cafe->socket === 'yes') return 'Yes';

        return '';
    }

    function socket()
    {
        if ($this->cafe->socket === 'no') return 'No';

        if ($this->cafe->socket === 'maybe') return trans('util.misc.depends-on-the-seat');

        if ($this->cafe->socket === 'yes') return 'Yes';

        return '';
    }

    function standingDesk()
    {
        if ($this->cafe->standing_desk === 'no') return 'No';

        if ($this->cafe->standing_desk === 'yes') return 'Yes';

        return '';
    }

    static function getTailPart($str)
    {
        return explode('，', $str)[1];
    }

    function limitedTimeValidationClass()
    {
        if ($this->cafe->limited_time === '') return '';

        if ($this->cafe->limited_time === 'no') return '';

        if ($this->cafe->limited_time === 'maybe') return '';

        if ($this->cafe->limited_time === 'yes') return '';

        return 'watchout';
    }

    function socketValidationClass()
    {
        if ($this->cafe->socket === '') return '';

        if ($this->cafe->socket === 'no') return '';

        if ($this->cafe->socket === 'maybe') return '';

        if ($this->cafe->socket === 'yes') return '';

        return 'watchout';
    }

    function standingDeskValidationClass()
    {
        if ($this->cafe->standing_desk === '') return '';

        if ($this->cafe->standing_desk === 'no') return '';

        if ($this->cafe->standing_desk === 'yes') return '';

        return 'watchout';
    }

    function businessHoursBox()
    {
        return view('nomadicore::partial/_business-hours-box', ['cafe' => $this->cafe]);
    }

    function businessHour($day)
    {
        if ($day === 'monday') {
            return $this->_businessHour(1);
        } else if ($day === 'tuesday') {
            return $this->_businessHour(2);
        } else if ($day === 'wednesday') {
            return $this->_businessHour(3);
        } else if ($day === 'thursday') {
            return $this->_businessHour(4);
        } else if ($day === 'friday') {
            return $this->_businessHour(5);
        } else if ($day === 'saturday') {
            return $this->_businessHour(6);
        } else if ($day === 'sunday') {
            return $this->_businessHour(7);
        } else {
            return '-';
        }
    }

    function _businessHour($dayInteger)
    {
        if ($this->cafe->business_hours->filter(function($e)use($dayInteger){return $e->day == $dayInteger;})->first()->open_time == null) {
            //return trans('util.misc.closed');
            return '公休';
        }

        return $this->cafe->business_hours->filter(function($e)use($dayInteger){return $e->day == $dayInteger;})->first()->open_time->format('H:i') .
            ' - ' . $this->cafe->business_hours->filter(function($e)use($dayInteger){return $e->day == $dayInteger;})->first()->close_time->format('H:i');
    }

    function openTime($day)
    {
        $dayToInts = [
            'monday' => 1,
            'tuesday' => 2,
            'wednesday' => 3,
            'thursday' => 4,
            'friday' => 5,
            'saturday' => 6,
            'sunday' => 7
        ];

        $dayInteger = $dayToInts[$day];

        if ($this->cafe->business_hours->filter(function($e)use($dayInteger){return $e->day == $dayInteger;})->first()->open_time == null) {
            return null;
        }

        return $this->cafe->business_hours->filter(function($e)use($dayInteger){return $e->day == $dayInteger;})->first()->open_time->format('H:i');
    }

    function closeTime($day)
    {
        $dayToInts = [
            'monday' => 1,
            'tuesday' => 2,
            'wednesday' => 3,
            'thursday' => 4,
            'friday' => 5,
            'saturday' => 6,
            'sunday' => 7
        ];

        $dayInteger = $dayToInts[$day];

        if ($this->cafe->business_hours->filter(function($e)use($dayInteger){return $e->day == $dayInteger;})->first()->open_time == null) {
            return null;
        }

        return $this->cafe->business_hours->filter(function($e)use($dayInteger){return $e->day == $dayInteger;})->first()->close_time->format('H:i');
    }

    function currentDayBusinessHours()
    {
        $dayInteger = date('N', strtotime(date('l')));

        $businessHour = \App\BusinessHour::where('cafe_id', $this->cafe->id)
            ->where('day', $dayInteger)
            ->first();

        if ($businessHour->open_time == null) {
            return trans('util.misc.closed-today');
        } else if ($businessHour->open_time->format('H:i') === '00:00') {
            return $this->cafe->open_time;
        } else {
            return $businessHour->open_time->format('H:i') . ' - ' . $businessHour->close_time->format('H:i');
        }
    }

    function nameLink()
    {
        return view('nomadicore::partial/_name-link', ['cafe' => $this->cafe]);
    }

    function nameLinkWithoutCity()
    {
        return view('nomadicore::partial/_name-link-without-city', ['cafe' => $this->cafe]);
    }

}
