<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    static function manualAdd($name)
    {
        $tag = self::whereName($name)->first();

        if ($tag) return $tag;

        $tag = new self();

        $tag->name = $name;

        $tag->save();

        return $tag;
    }

    function countOnCafe($cafe)
    {
        return CafeTag::where('tag_id', $this->id)
            ->where('cafe_id', $cafe->id)
            ->where('is_reported', '0')
            ->count();
    }

    function isUsed($user, $cafe)
    {
        return CafeTag::where('tag_id', $this->id)
            ->where('user_id', $user->id)
            ->where('cafe_id', $cafe->id)
            ->count() > 0 ? true : false;
    }

    function isApplied($user, $cafe)
    {
        return CafeTag::where('tag_id', $this->id)
            ->where('user_id', $user->id)
            ->where('cafe_id', $cafe->id)
            ->where('is_reported', '0')
            ->count() > 0 ? true : false;
    }

    function isReported($user, $cafe)
    {
        return CafeTag::where('tag_id', $this->id)
            ->where('user_id', $user->id)
            ->where('cafe_id', $cafe->id)
            ->where('is_reported', '1')
            ->count() > 0 ? true : false;
    }

    function cafeTags()
    {
        return $this->hasMany('App\CafeTag');
    }

}
