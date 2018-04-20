<?php

namespace Modules\NomadiCore;

use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
{

    public function user()
    {
        return $this->belongsTo('Modules\NomadiCore\User');
    }

    function cafe()
    {
        return $this->belongsTo('Modules\NomadiCore\Cafe');
    }

}
