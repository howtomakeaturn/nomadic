<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
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
