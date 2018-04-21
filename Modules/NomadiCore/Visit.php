<?php

namespace Modules\NomadiCore;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{

    const PRIVATE_STATUS = 0;

    const PUBLIC_STATUS = 10;

    protected $casts = [
        'visit_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo('Modules\NomadiCore\User');
    }

    function cafe()
    {
        return $this->belongsTo('Modules\NomadiCore\Cafe');
    }

}
