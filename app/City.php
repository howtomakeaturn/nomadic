<?php

namespace App;

use Config;
use DB;

class City
{

    static function numOfCafes($city)
    {
        return Cafe::whereCity($city)->whereStatus(Cafe::APPROVED_STATUS)->count();
    }

    static function numOfComments($city)
    {
        $num = DB::table('comments')->join('cafes', 'cafe_id', 'cafes.id')
            ->where('cafes.city', $city)
            ->count();
        return $num;
    }

    static function numOfVisits($city)
    {
        $num = DB::table('recommendations')->join('cafes', 'cafe_id', 'cafes.id')
            ->where('cafes.city', $city)
            ->count();
        return $num;
    }

    static function numOfReviews($city)
    {
        $num = DB::table('reviews')->join('cafes', 'cafe_id', 'cafes.id')
            ->where('cafes.city', $city)
            ->count();
        return $num;
    }

    static function numOfDonatedCafes($city)
    {
        return Cafe::whereCity($city)->where('is_donated', '1')->count();
    }

    static function getOnlineCities()
    {
        $result = [];

        foreach (Config::get('city') as $index => $data) {
            //if ($data['online']) {
                $result[] = $index;
            //}
        }

        return collect($result);
    }

    static function getFeaturedTags($city)
    {
        $tags = Tag::all();

        $result = collect([]);

        foreach ($tags as $tag) {
            $count = DB::table('cafe_tag')->join('cafes', 'cafe_id', 'cafes.id')
                ->join('tags', 'tag_id', 'tags.id')
                ->where('cafes.city', $city)
                ->where('tags.id', $tag->id)
                ->distinct('cafe_tag.cafe_id')
                ->count('cafe_tag.cafe_id');

            if ($count > 1) {
                $result->push([
                    'name' => $tag->name,
                    'count' => $count,
                    'id' => $tag->id
                ]);
            }
        }

        $result = $result->sortByDesc(function($set){ return $set['count']; });

        return $result;
    }

    static function getLatestFbFeeds($city, $num)
    {
        $rows = DB::table('fb_feeds')->join('fb_fan_pages', 'fb_fan_page_id', 'fb_fan_pages.id')
            ->join('cafes', 'fb_fan_pages.cafe_id', 'cafes.id')
            ->where('cafes.city', $city)
            ->orderBy('fb_feeds.published_at', 'desc')
            ->limit($num)
            ->select('fb_feeds.id')
            ->get();

        $ids = [];

        foreach ($rows as $row) {
            $ids[] = $row->id;
        }

        return Facebook\Feed::findMany($ids);
    }

    static function getLatestComments($city, $num)
    {
        $rows = DB::table('comments')->join('cafes', 'comments.cafe_id', 'cafes.id')
            ->where('cafes.city', $city)
            ->orderBy('comments.created_at', 'desc')
            ->limit($num)
            ->select('comments.id')
            ->get();

        $ids = [];

        foreach ($rows as $row) {
            $ids[] = $row->id;
        }

        return Comment::findMany($ids);
    }

    static function getLatestReviews($city, $num)
    {
        $rows = DB::table('reviews')->join('cafes', 'reviews.cafe_id', 'cafes.id')
            ->where('cafes.city', $city)
            ->orderBy('reviews.created_at', 'desc')
            ->limit($num)
            ->select('reviews.id')
            ->get();

        $ids = [];

        foreach ($rows as $row) {
            $ids[] = $row->id;
        }

        return Review::findMany($ids);
    }

    static function getLatestPhotos($city, $num)
    {
        $rows = DB::table('photos')->join('cafes', 'photos.cafe_id', 'cafes.id')
            ->where('cafes.city', $city)
            ->where('photos.status', Photo::CREATED_STATUS)
            ->orderBy('photos.created_at', 'desc')
            ->limit($num)
            ->select('photos.id')
            ->get();

        $ids = [];

        foreach ($rows as $row) {
            $ids[] = $row->id;
        }

        return Photo::findMany($ids);
    }

    static function getOfflineCities()
    {
        $result = [];

        foreach (Config::get('city') as $index => $data) {
            if (!$data['online']) {
                $result[] = $index;
            }
        }

        return $result;
    }

    static function getMapCenter($city)
    {
        // if the location is set, just use it.
        if (array_key_exists('map', Config::get("city.$city"))) {
            return Config::get("city.$city.map");
        }

        // otherwise, let's calculate for it
        $cafes = Cafe::whereStatus(Cafe::APPROVED_STATUS)->whereCity($city)->get();

        $latArr = [];
        $lngArr = [];

        foreach($cafes as $cafe) {
            if ($cafe->latitude != 0) {
                $latArr[] = $cafe->latitude;
                $lngArr[] = $cafe->longitude;
            }
        }

        if (count($latArr) > 0) {
            return ['lat' => calculate_median($latArr), 'lng' => calculate_median($lngArr), 'zoom' => 13];
        }

        // or just use the center or taiwan.
        return ['lat' => 24.042571, 'lng' => 120.9472711, 'zoom' => 8];
    }

    static function getFields($city)
    {
        // if the location is set, just use it.
        if (array_key_exists('fields', Config::get("city.$city"))) {
            return Config::get("city.$city.fields");
        }

        return ['name', 'wifi', 'seat', 'quiet', 'tasty', 'cheap', 'music',
            'open-time', 'address', 'limited-time', 'socket', 'standing-desk', 'parking',
            'who', 'note', 'url'
        ];
    }

}
