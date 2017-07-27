<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

use Auth;
use Request;
use DB;
use Layout;
use Config;
use App\Cafe;
use App\City;
use App\CafeTag;
use App\Tag;
use CafeNomad;
use App\SystemEvent;

class ShopController extends BaseController
{
    function search()
    {
        $keyword = trim(Request::get('query'));
        if (empty($keyword)) {
            return redirect('/');
        }

        $event = new SystemEvent();

        $event->category = 'algolia-search';

        $payload = [
            'keyword' => $keyword
        ];

        $event->payload = json_encode($payload);

        $event->save();

        $cafes = Cafe::search($keyword)->paginate(20);
        if ($cafes->currentPage() != 1 && $cafes->currentPage() > $cafes->lastPage()) {
            return redirect("/shop/search?query=$keyword");
        }

        return view('shop.search', compact('keyword', 'cafes'));
    }

    function tag($id)
    {
        if ( !Auth::check() ) {
            return redirect("login?&path=/shop/$id/tag");
        }

        $cafe = Cafe::find($id);

        $query = new \App\Tag\Query();

        $userTags = $query->getAllByUserOnCafe(Auth::user(), $cafe);

        $userOtherTags = $query->getAllByUserNotOnCafe(Auth::user(), $cafe);

        $otherTags = $query->getAllByNotUserNotOnCafe(Auth::user(), $cafe);

        return view('shop/tag', compact('cafe', 'userTags', 'userOtherTags', 'otherTags'));
    }

    function json($id)
    {
        $cafe = Cafe::find($id);

        return response()->json($cafe->toArray());
    }

    function newTag()
    {
        if (trim(Request::get('tag_name')) === '') {
            return 'Please fill in the tag name.';
        }

        $tag = Tag::manualAdd(Request::get('tag_name'));

        $cafeTag = new CafeTag();

        $cafeTag->cafe_id = Request::get('cafe_id');

        $cafeTag->tag_id = $tag->id;

        $cafeTag->user_id = Auth::user()->id;

        $cafeTag->save();

        return redirect()->back();
    }

    function applyTag()
    {
        $cafeTag = new CafeTag();

        $cafeTag->cafe_id = Request::get('cafe_id');

        $cafeTag->tag_id = Request::get('tag_id');

        $cafeTag->user_id = Auth::user()->id;

        $cafeTag->save();

        return redirect()->back();
    }

    function unapplyTag()
    {
        $cafeTag = CafeTag::where('cafe_id', Request::get('cafe_id'))
            ->where('tag_id', Request::get('tag_id'))
            ->where('user_id', Auth::user()->id)
            ->delete();

        return redirect()->back();
    }

    function reportTag()
    {
        $cafeTag = new CafeTag();

        $cafeTag->cafe_id = Request::get('cafe_id');

        $cafeTag->tag_id = Request::get('tag_id');

        $cafeTag->user_id = Auth::user()->id;

        $cafeTag->is_reported = true;

        $cafeTag->save();

        return redirect()->back();
    }

    function unreportTag()
    {
        $cafeTag = CafeTag::where('cafe_id', Request::get('cafe_id'))
            ->where('tag_id', Request::get('tag_id'))
            ->where('user_id', Auth::user()->id)
            ->delete();

        return redirect()->back();
    }

    function report($id)
    {
        $cafe = Cafe::find($id);

        return view('shop/report', compact('cafe'));
    }

    function stats($id)
    {
        $cafe = Cafe::find($id);

        $events = SystemEvent::whereCategory('view-shop')
            ->where('payload', 'LIKE', "%$id%")
            ->get();

        $data = [];

        foreach ($events as $event) {
            if ($event->getPayload()->id !== $id) continue;

            $joinDate = $event->created_at->format('m/d');

            if (array_key_exists($joinDate, $data)) {
                $data[$joinDate] += 1;
            } else {
                $data[$joinDate] = 1;
            }
        }

        //

        $displayData = [];

        $rows = DB::table('daily_event_counters')
            ->where('category', 'display-shop-list')
            ->where('cafe_id', $cafe->id)
            ->orderBy('event_date')
            ->get();

        foreach ($rows as $row) {
            $date = \Carbon\Carbon::parse($row->event_date)->format('m/d');

            $displayData[$date] = $row->value;
        }

        if ($rows->count() > 0) {
            $startDate = \Carbon\Carbon::parse($rows->first()->event_date);

            $endDate = \Carbon\Carbon::parse($rows->last()->event_date);

            $cursor = \Carbon\Carbon::parse($rows->first()->event_date);

            while ($cursor != $endDate) {
                if (!array_key_exists($cursor->format('m/d'), $displayData)) {
                    $displayData[$cursor->format('m/d')] = 0;
                }

                $cursor->addDay();
            }

            ksort($displayData);
        }

        //

        $displayData2 = [];

        $rows = DB::table('daily_event_counters')
            ->where('category', 'display-shop-map')
            ->where('cafe_id', $cafe->id)
            ->orderBy('event_date')
            ->get();

        foreach ($rows as $row) {
            $date = \Carbon\Carbon::parse($row->event_date)->format('m/d');

            $displayData2[$date] = $row->value;
        }

        if ($rows->count() > 0) {
            $startDate = \Carbon\Carbon::parse($rows->first()->event_date);

            $endDate = \Carbon\Carbon::parse($rows->last()->event_date);

            $cursor = \Carbon\Carbon::parse($rows->first()->event_date);

            while ($cursor != $endDate) {
                if (!array_key_exists($cursor->format('m/d'), $displayData2)) {
                    $displayData2[$cursor->format('m/d')] = 0;
                }

                $cursor->addDay();
            }

            ksort($displayData2);
        }

        return view('shop/stats', compact('cafe', 'data', 'displayData', 'displayData2'));
    }

    function donate($id)
    {
        $cafe = Cafe::find($id);

        return view('shop/donate', compact('cafe'));
    }

}
