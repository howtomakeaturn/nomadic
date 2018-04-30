<?php

namespace Modules\NomadiCore;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    public function user()
    {
        return $this->belongsTo('Modules\NomadiCore\User');
    }

    function entity()
    {
        return $this->belongsTo('Modules\NomadiCore\Entity');
    }

}
