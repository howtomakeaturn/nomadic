<?php

namespace App;
use DB;

class CafeNomad
{

    private $mode = null;

    function setMode($mode)
    {
        $this->mode = $mode;
    }

    function getMode()
    {
        return $this->mode;
    }

    function getDonatedCafes($city = null)
    {
        if ($city === null) {
            $cafes = Cafe::where('is_donated', '1')
            ->inRandomOrder()
            ->get();
        } else {
            $cafes = Cafe::where('is_donated', '1')
            ->whereCity($city)
            ->inRandomOrder()
            ->get();
        }

        return $cafes;
    }

    function getDonatedBeforeCafes()
    {
        $rows = DB::table('cafes')->leftJoin('donations', 'cafes.id', 'donations.cafe_id')
            ->whereNotNull('donations.cafe_id')
            ->where('cafes.is_donated', '0')
            ->select('cafes.id')
            ->get();

        $ids = [];

        foreach ($rows as $row) {
            $ids[] = $row->id;
        }

        $cafes = Cafe::findMany($ids);

        return $cafes;
    }

    function getDiscussions()
    {
        $discussions = Discussion::orderBy('id', 'desc')->get();

        $discussions = $discussions->sortByDesc(function($discussion){
            return $discussion->posts->last()->created_at;
        });

        return $discussions;
    }

    function getStarCafes()
    {
        $cafes = Cafe::where('status', Cafe::APPROVED_STATUS)->get();

        $cafes = $cafes->filter(function($cafe){
            return $cafe->isStarred();
        });

        return $cafes;
    }

    function countStarCafes($city = null)
    {
        if ($city === null) {
            return Cafe::where('status', Cafe::APPROVED_STATUS)->where('is_starred', true)->count();
        } else {
            return Cafe::where('status', Cafe::APPROVED_STATUS)->where('city', $city)->where('is_starred', true)->count();
        }
    }

}
