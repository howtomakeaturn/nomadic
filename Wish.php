<?php

namespace Modules\NomadiCore;

use Illuminate\Database\Eloquent\Model;

class Wish extends Model
{

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    function cafe()
    {
        return $this->belongsTo('App\Cafe');
    }

}
