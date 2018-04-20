<?php

namespace Modules\NomadiCore;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{

    const HIDDEN_STATUS = -10;

    const CREATED_STATUS = 0;

    function cafe()
    {
        return $this->belongsTo('Modules\NomadiCore\Cafe');
    }

    function user()
    {
        return $this->belongsTo('Modules\NomadiCore\User');
    }

    function presentWithUser()
    {
        return view( '_photo-with-user', [ 'avatar' => $this->user->profile->avatar, 'image' => '/upload_photos/width-600/' . $this->name ] );
    }

}
