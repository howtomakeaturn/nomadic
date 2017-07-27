<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

use Request;
use DB;
use Layout;
use Config;
use App\Cafe;
use App\City;
use CafeNomad;

class CityController extends BaseController
{

    private function getView($city)
    {
        if (Layout::isMobile()) {
            return 'list-mobile';
        } else {
            return 'list-desktop';
        }
    }

    function createListPage($city)
    {
        session(['mode' => 'list']);

        session(['city' => $city]);

        Layout::setCity($city);

        CafeNomad::setMode('list');

        $fields = City::getFields($city);

        $cafes = Cafe::where('city', $city)->where('status', 10)->get();

        $new = collect([]);
        $donated = collect([]);

        foreach ($cafes as $index => $cafe) {
            if ($cafe->is_donated) {
                $donated->push($cafe);
                $cafes->forget($index);
            } else if ($cafe->opening_date !== null) {
                $new->push($cafe);
                $cafes->forget($index);
            }
        }

        $new = $new->sortBy('opening_date');

        $donated = $donated->shuffle();

        foreach ($new as $c) {
            $cafes->prepend($c);
        }

        foreach ($donated as $c) {
            $cafes->prepend($c);
        }

        $agent = new \Jenssegers\Agent\Agent();

        return view($this->getView($city), ['cafes' => $cafes, 'fields' => $fields]);
    }

    function createMapPage($city)
    {
        session(['mode' => 'map']);

        session(['city' => $city]);

        Layout::setCity($city);

        Layout::setIsMap(true);

        CafeNomad::setMode('map');

        $fields = City::getFields($city);

        $cafes = \App\Cafe::where('city', $city)->where('status', 10)
            ->where('latitude', '!=', '0')
            ->where('longitude', '!=', '0')
            ->get();

        return view('map', ['cafes' => $cafes, 'fields' => $fields,
            'center' => City::getMapCenter($city)]);
    }

    function getList($city)
    {
        return $this->createListPage($city);
    }

    function getMap($city)
    {
        return $this->createMapPage($city);
    }

    function getShop($id)
    {
        $targetCafe = \App\Cafe::find($id);

        $city = $targetCafe->city;

        return redirect("/$city/list");

        $center = [
            'lat' => $targetCafe->latitude,
            'lng' => $targetCafe->longitude,
            'zoom' => 15
        ];

        $fields = City::getFields($city);

        Layout::setCafe($targetCafe);

        $cafes = \App\Cafe::where('city', $city)->where('status', 10)->get();

        return view('map', ['targetCafe' => $targetCafe, 'cafes' => $cafes, 'center' => $center, 'fields' => $fields]);
    }

    function getDiscovery($city)
    {
        Layout::setDisplayNavbar(false);

        Layout::setOpenGraphTitle('Cafe Nomad ' . Config::get('city')[$city]['zh'] . ' - 網友們一起寫的咖啡廳食記&評鑑');

        Layout::setOpenGraphImage(url('/img/marketing/mm.png'));

        $cafes = \App\Cafe::where('city', $city)->where('status', 10)
            ->where('latitude', '!=', '0')
            ->where('longitude', '!=', '0')
            ->get();

        $cafes = $cafes->filter(function($cafe){
            if ($cafe->photos->count() === 0) return false;

            return true;
        });

        return view('discovery', compact('cafes'));
    }

    function getHomepage($city)
    {
        Layout::setOpenGraphTitle('Cafe Nomad - ' . Config::get('city')[$city]['zh']);

        Layout::setCity($city);

        $displayNumber = 4;

        if (Layout::isMobile()) $displayNumber = 3;

        $fbFeeds = City::getLatestFbFeeds($city, $displayNumber);

        $comments = City::getLatestComments($city, $displayNumber);

        $reviews = City::getLatestReviews($city, $displayNumber);

        $photos = City::getLatestPhotos($city, $displayNumber);

        return view('city-homepage', compact('city', 'fbFeeds', 'comments', 'reviews', 'photos'));
    }

    function getFlaneur($city)
    {
        Layout::setOpenGraphTitle('Cafe Nomad - ' . Config::get('city')[$city]['zh'] . '咖啡廳 Facebook 最新動態');

        Layout::setOpenGraphImage(url('/android-chrome-384x384.png'));

        Layout::setCity($city);

        CafeNomad::setMode('flaneur');

        $feeds = $this->flaneurPagination($city, 1);

        return view('flaneur', compact('feeds', 'city'));
    }

    function getFlaneurAjax()
    {
        $feeds = $this->flaneurPagination(Request::get('city'), Request::get('page'));

        foreach ($feeds as $feed) {
            echo view('flaneur/_fb-posts', compact('feed'));
        }
    }

    function flaneurPagination($city, $page)
    {
        $rows = DB::table('fb_feeds')
                    ->join('fb_fan_pages', 'fb_feeds.fb_fan_page_id', '=', 'fb_fan_pages.id')
                    ->join('cafes', 'fb_fan_pages.cafe_id', '=', 'cafes.id')
                    ->select('fb_feeds.id')
                    ->where('cafes.city', $city)
                    ->orderby('fb_feeds.published_at', 'desc')
                    ->offset(($page - 1) * 25)
                    ->limit(25)
                    ->get();

        $ids = [];

        foreach ($rows as $row) {
            $ids[] = $row->id;
        }

        $feeds = \App\Facebook\Feed::findMany($ids);

        $feeds = $feeds->sortByDesc('published_at');

        return $feeds;
    }

    function tag($city, $tagStr)
    {
        $tagId = explode('-', $tagStr)[0];

        $tag = \App\Tag::find($tagId);

        $rows = \App\CafeTag::where('tag_id', $tagId)->get();

        $cafeIds = [];

        foreach ($rows as $row) {
            $cafe = Cafe::find($row->cafe_id);

            if ($cafe->city !== $city) continue;

            if (in_array($cafe->id, $cafeIds)) continue;

            $cafeIds[] = $cafe->id;
        }

        $cafes = Cafe::findMany($cafeIds);

        $latArr = [];
        $lngArr = [];

        foreach($cafes as $cafe) {
            if ($cafe->latitude != 0) {
                $latArr[] = $cafe->latitude;
                $lngArr[] = $cafe->longitude;
            }
        }

        if (count($latArr) > 0) {
            $center = ['lat' => calculate_median($latArr), 'lng' => calculate_median($lngArr), 'zoom' => 13];
        } else {
            $center = ['lat' => 24.042571, 'lng' => 120.9472711, 'zoom' => 8];
        }

        Layout::setOpenGraphTitle('Cafe Nomad - ' . Config::get('city')[$city]['zh'] . $tag->name . '的咖啡廳清單：共收錄' . $cafes->count() . '間網友推薦的店');

        return view('tag', compact('cafes', 'city', 'tag', 'center'));
    }

}
