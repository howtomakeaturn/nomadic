<?php

namespace Modules\NomadiCore\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

use Modules\NomadiCore\Facebook\FanPage;
use View;
use Auth;
use Modules\NomadiCore\City;
use Modules\NomadiCore\Cafe;
use Modules\NomadiCore\Entity;
use Modules\NomadiCore\Comment;
use Modules\NomadiCore\Review;
use Modules\NomadiCore\Photo;
use Layout;
use Modules\NomadiCore\Discussion;
use Illuminate\Http\Request;

class HomepageController extends BaseController
{

    function prepareSideMenu()
    {
        $user = Auth::user();

        View::share('user', $user);

        $reviewCafeIds = [];

        foreach ($user->reviews as $review) {
            $reviewCafeIds[] = $review->cafe_id;
        }

        $checkinCafeIds = [];

        foreach ($user->recommendations->sortByDesc('created_at') as $recommendation) {
            $checkinCafeIds[] = $recommendation->cafe_id;
        }

        $reviewCafeIds = collect($reviewCafeIds);

        $checkinCafeIds = collect($checkinCafeIds);

        $readyToReviewCafeIds = $checkinCafeIds->diff($reviewCafeIds);

        $readyToReviewCafes = collect([]);

        foreach ($readyToReviewCafeIds as $id) {
            $cafe = \Modules\NomadiCore\Cafe::find($id);

            $readyToReviewCafes->push($cafe);
        }

        View::share('readyToReviewCafes', $readyToReviewCafes);

        $this->prepareRightSide();
    }

    function prepareRightSide()
    {
        $cafes = Cafe::whereNotNull('opening_date')->orderBy('opening_date', 'desc')->get();

        View::share('new_cafes', $cafes);

        $cafes = Cafe::where('is_donated', '1')->inRandomOrder()->get();

        View::share('donated_cafes', $cafes);
    }

    function home()
    {
        return redirect('/');

        //if (!Auth::check()) return redirect('/');

        $this->prepareSideMenu();

        $discussions = \CafeNomad::getDiscussions()->take(3);

        $messages = \Modules\NomadiCore\ChatroomMessage::where('cafe_id', '')->orderBy('created_at', 'desc')->limit(3)->get();

        $messages = $messages->reverse();

        return view('index/index-user', ['feeds' => $this->generateFeeds(), 'discussions' => $discussions, 'messages' => $messages]);
    }

    function index(Request $request)
    {
        //if (Auth::check()) return redirect('/home');

        $displayNumber = 4;

        if (Layout::isMobile()) $displayNumber = 3;

        //$pages = FanPage::whereStatus(FanPage::RUNNING_STATUS)->inRandomOrder()->limit($displayNumber)->get();

        $pages = [];

        $boxCafes = collect([]);

        foreach ($pages as $page) {
            $boxCafes->push($page->cafe);
        }

        $mapCafes = Entity::whereStatus(Entity::APPROVED_STATUS)->whereCity('taipei')->inRandomOrder()->limit(50)->get();

        $latArr = [];
        $lngArr = [];

        foreach($mapCafes as $cafe) {
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

        //$fbFeeds = \Modules\NomadiCore\Facebook\Feed::orderBy('published_at', 'desc')->limit($displayNumber)->get();
        $fbFeeds = [];

        if (is_null($request->input('beta')))
        {
            return view('index/new-index', compact('boxCafes', 'mapCafes', 'center', 'fbFeeds'));
        }
        else
        {
            return view('home.index', compact('boxCafes', 'mapCafes', 'center', 'fbFeeds'));
        }
    }

    function generateFeeds()
    {
        $fromDateTime = \Carbon\Carbon::now()->subDays(2)->toDateTimeString();

        $comments = Comment::orderBy('created_at', 'desc')
            ->where('created_at', '>', $fromDateTime)->get();

        $reviews = Review::orderBy('created_at', 'desc')
            ->where('created_at', '>', $fromDateTime)->get();

        $photos = Photo::whereStatus(Photo::CREATED_STATUS)
            ->orderBy('created_at', 'desc')
            ->where('created_at', '>', $fromDateTime)->get();

        $feeds = collect([]);

        $feeds = $feeds->merge($comments);

        $feeds = $feeds->merge($reviews);

        $feeds = $feeds->merge($photos);

        $feeds = $feeds->sortByDesc('created_at');

        return $feeds;
    }

}
