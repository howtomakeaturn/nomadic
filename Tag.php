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
        return EntityTag::where('tag_id', $this->id)
            ->where('entity_id', $cafe->id)
            ->where('is_reported', '0')
            ->count();
    }

    function isUsed($user, $cafe)
    {
        return EntityTag::where('tag_id', $this->id)
            ->where('user_id', $user->id)
            ->where('entity_id', $cafe->id)
            ->count() > 0 ? true : false;
    }

    function isApplied($user, $cafe)
    {
        return EntityTag::where('tag_id', $this->id)
            ->where('user_id', $user->id)
            ->where('entity_id', $cafe->id)
            ->where('is_reported', '0')
            ->count() > 0 ? true : false;
    }

    function isReported($user, $cafe)
    {
        return EntityTag::where('tag_id', $this->id)
            ->where('user_id', $user->id)
            ->where('entity_id', $cafe->id)
            ->where('is_reported', '1')
            ->count() > 0 ? true : false;
    }

    function entityTags()
    {
        return $this->hasMany('App\EntityTag');
    }

}
