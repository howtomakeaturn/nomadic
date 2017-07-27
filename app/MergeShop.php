<?php

namespace App;

use Request;
use Image;

class MergeShop
{

    function handle(Cafe $duplicate, Cafe $target)
    {
        foreach ($duplicate->wishes as $wish) {
            $wish->cafe_id = $target->id;
            $wish->save();
        }
        foreach ($duplicate->recommendations as $rec) {
            $rec->cafe_id = $target->id;
            $rec->save();
        }
        foreach ($duplicate->reviews as $review) {
            $review->cafe_id = $target->id;
            $review->save();
        }
        foreach ($duplicate->comments as $comment) {
            $comment->cafe_id = $target->id;
            $comment->save();
        }
        foreach ($duplicate->photos as $photo) {
            $photo->cafe_id = $target->id;
            $photo->save();
        }

        $duplicate->status = Cafe::DUPLICATE_STATUS;

        $duplicate->save();
    }

}
