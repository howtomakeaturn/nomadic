<?php

namespace App\Tag;

use DB;
use App\Tag;

class Query
{

    function getAllByUserOnCafe($user, $cafe)
    {
        $rows = DB::table('entity_tag')->where('entity_id', $cafe->id)
            ->where('user_id', $user->id)
            ->where('is_reported', '0')
            ->get();

        $ids = [];

        foreach ($rows as $row) {
            $ids[] = $row->tag_id;
        }

        $tags = Tag::findMany($ids);

        return $tags;
    }

    function getAllByUserNotOnCafe($user, $cafe)
    {
        $rows = DB::table('entity_tag')->where('entity_id', '!=', $cafe->id)
            ->where('user_id', $user->id)
            ->get();

        $ids = [];

        foreach ($rows as $row) {
            $ids[] = $row->tag_id;
        }

        $tags = Tag::findMany($ids);

        $alreadyUsedTags = $this->getAllByUserOnCafe($user, $cafe);

        foreach ($tags as $index => $tag) {
            foreach ($alreadyUsedTags as $alreadyUsedTag) {
                if ($alreadyUsedTag->id === $tag->id) {
                    $tags->forget($index);
                }
            }
        }

        return $tags;
    }

    function getAllByNotUserNotOnCafe($user, $cafe)
    {
        $rows = DB::table('entity_tag')->where('entity_id', '!=', $cafe->id)
            ->where('user_id', '!=', $user->id)
            ->get();

        $ids = [];

        foreach ($rows as $row) {
            $ids[] = $row->tag_id;
        }

        $tags = Tag::findMany($ids);

        $alreadyUsedTags = $this->getAllByUserOnCafe($user, $cafe);

        foreach ($tags as $index => $tag) {
            foreach ($alreadyUsedTags as $alreadyUsedTag) {
                if ($alreadyUsedTag->id === $tag->id) {
                    $tags->forget($index);
                }
            }
        }

        return $tags;
    }
}
