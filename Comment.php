<?php

namespace Modules\NomadiCore;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    function entity()
    {
        return $this->belongsTo('App\Entity');
    }

}
