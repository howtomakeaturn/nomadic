<?php

namespace Modules\NomadiCore;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{

    public $timestamps = false;

    function posts()
    {
        return $this->hasMany('Modules\NomadiCore\Post');
    }

    function presentBlock()
    {
        return view('nomadicore::partial/_post-item', ['discussion' => $this]);
    }

    function presentBlockSimple()
    {
        return view('nomadicore::partial/_post-item-simple', ['discussion' => $this]);
    }

}
