<?php

namespace App;

class SetReviewMedian
{

    function handle($cafe)
    {
        if ($cafe->validReviews()->count() > 0) {
            $this->forceHandle($cafe);
        }
    }

    function forceHandle($cafe)
    {
        $fields = getReviewKeys();

        $result = [];

        foreach ($fields as $field) {
            $arr = [];

            foreach ($cafe->validReviews() as $review) {
                if ($review->getValue($field) > 0) {
                    $arr[] = $review->getValue($field);
                }
            }

            if (count($arr) > 0) {
                $result[$field] = calculate_median($arr);
            }
        }

        $cafe->review_fields = json_encode($result);

        $cafe->save();
    }

}
