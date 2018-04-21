<?php

namespace Modules\NomadiCore;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class BusinessHour extends Model
{

    public $timestamps = false;

    public function getOpenTimeAttribute($value) {
        return $value === null ? null : Carbon::parse($value);
    }

    public function getCloseTimeAttribute($value) {
        return $value === null ? null : Carbon::parse($value);
    }

}
