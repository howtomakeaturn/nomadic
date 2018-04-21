<?php

namespace Modules\NomadiCore;

use Illuminate\Database\Eloquent\Model;
use DB;

class DailyEventCounter extends Model
{

    public $timestamps = false;

    protected $casts = [
        'event_date' => 'date',
        'value' => 'integer'
    ];

    static function track($category, $cafeId, $date)
    {
        $counter = self::where('category', $category)->where('cafe_id', $cafeId)->where('event_date', $date)->first();
        if ($counter) {
            $counter->value += 1;

            $counter->save();
        } else {
            $counter = new self();

            $counter->category = $category;

            $counter->cafe_id = $cafeId;

            $counter->event_date = $date;

            $counter->value = 1;

            $counter->save();
        }
    }

}
