<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    function user()
    {
        return $this->belongsTo('App\User');
    }

    function discussion()
    {
        return $this->belongsTo('App\Discussion');
    }

    function comments()
    {
        return $this->hasMany('App\PostComment');
    }

}
