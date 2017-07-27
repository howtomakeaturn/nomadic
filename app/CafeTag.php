<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CafeTag extends Model
{

    protected $table = 'cafe_tag';

    public $incrementing = false;

    protected $casts = [
        'is_reported' => 'boolean',
    ];

    function tag()
    {
        return $this->belongsTo('App\Tag');
    }

    function user()
    {
        return $this->belongsTo('App\User');
    }

    function cafe()
    {
        return $this->belongsTo('App\Cafe');
    }

}
