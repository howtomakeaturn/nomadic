<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{

    function user()
    {
        return $this->belongsTo('App\User');
    }

    function post()
    {
        return $this->belongsTo('App\Post');
    }

}
