<?php

namespace Modules\NomadiCore;

use Illuminate\Database\Eloquent\Model;

class EntityTag extends Model
{

    protected $table = 'entity_tag';

    public $incrementing = false;

    protected $casts = [
        'is_reported' => 'boolean',
    ];

    function tag()
    {
        return $this->belongsTo('Modules\NomadiCore\Tag');
    }

    function user()
    {
        return $this->belongsTo('Modules\NomadiCore\User');
    }

    function cafe()
    {
        return $this->belongsTo('Modules\NomadiCore\Cafe');
    }

}
