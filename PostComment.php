<?php

namespace Modules\NomadiCore;

use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{

    function user()
    {
        return $this->belongsTo('Modules\NomadiCore\User');
    }

    function post()
    {
        return $this->belongsTo('Modules\NomadiCore\Post');
    }

}
