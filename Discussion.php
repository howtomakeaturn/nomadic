<?php

namespace Modules\NomadiCore;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{

    public $timestamps = false;

    function posts()
    {
        return $this->hasMany('App\Post');
    }

    function presentBlock()
    {
        return view('partial/_post-item', ['discussion' => $this]);
    }

    function presentBlockSimple()
    {
        return view('partial/_post-item-simple', ['discussion' => $this]);
    }

}
