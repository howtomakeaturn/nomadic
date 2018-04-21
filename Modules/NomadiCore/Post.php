<?php

namespace Modules\NomadiCore;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    function user()
    {
        return $this->belongsTo('Modules\NomadiCore\User');
    }

    function discussion()
    {
        return $this->belongsTo('Modules\NomadiCore\Discussion');
    }

    function comments()
    {
        return $this->hasMany('Modules\NomadiCore\PostComment');
    }

}
