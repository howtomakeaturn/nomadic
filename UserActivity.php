<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserActivity extends Model
{

    public $timestamps = false;

    function user()
    {
        return $this->belongsTo('App\User');
    }

}
