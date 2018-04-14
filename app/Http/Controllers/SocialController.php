<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

use URL;
use Request;
use Auth;
use Config;
use Layout;
use App\Wish;
use App\Recommendation;
use App\Comment;
use App\Review;
use App\Cafe;
use App\Entity;

class SocialController extends BaseController
{

    function ajaxWish()
    {
        $w = Wish::where('cafe_id', Request::get('cafe_id'))
            ->where('user_id', Auth::user()->id)
            ->first();

        if (!$w) {
            $w = new Wish();
            $w->cafe_id = Request::get('cafe_id');
            $w->user_id = Auth::user()->id;
            $w->save();
        }

        return response()->json([
            'status' => 1
        ]);
    }

    function ajaxCancelWish()
    {
        $w = Wish::where('cafe_id', Request::get('cafe_id'))
            ->where('user_id', Auth::user()->id)
            ->first();

        if ($w) {
            $w->delete();
        }

        return response()->json([
            'status' => 1
        ]);
    }

    function ajaxVisit()
    {
        $rec = Recommendation::where('cafe_id', Request::get('cafe_id'))
            ->where('user_id', Auth::user()->id)
            ->first();

        if (!$rec) {
            $rec = new Recommendation();
            $rec->cafe_id = Request::get('cafe_id');
            $rec->user_id = Auth::user()->id;
            $rec->save();
        }

        return response()->json([
            'status' => 1
        ]);
    }

    function ajaxCancelVisit()
    {
        $rec = Recommendation::where('cafe_id', Request::get('cafe_id'))
            ->where('user_id', Auth::user()->id)
            ->first();

        if ($rec) {
            $rec->delete();
        }

        return response()->json([
            'status' => 1
        ]);
    }

    function ajaxComment()
    {
        $c = new Comment();
        $c->cafe_id = Request::get('cafe_id');
        $c->body = Request::get('body');
        $c->user_id = Auth::user()->id;
        $c->save();

        return response()->json([
            'status' => 1
        ]);
    }

    function review($id){
        if ( !Auth::check() ) {
            return redirect("login?&path=/review/$id&action=review");
        }

        $entity = Entity::find($id);

        $review = Review::where('entity_id', $id)
            ->where('user_id', Auth::user()->id)->first();

        if ($review) {
            return view('edit-review', ['entity' => $entity, 'review' => $review]);
        }

        return view('review', ['entity' => $entity]);
    }

    function submitReview(){
        $cafe = Cafe::find(Request::get('cafe_id'));

        $review = Review::where('cafe_id', $cafe->id)
            ->where('user_id', Auth::user()->id)->first();

        if ($review) {
            return view('notice', ['title' => '您已經替' . $cafe->name . '評分過了。', 'message' => '您只能對一間咖啡廳評分一次。']);
        }

        $r = new Review();

        $error = $this->checkHasError($r);

        if ($error) return view('notice', ['title' => '您有一項評分打了0分。', 'message' => '滿分5分，請輸入1到5。']);

        $r->cafe_id = Request::get('cafe_id');

        $r->user_id = Auth::user()->id;

        $r->save();

        //$r->checkin();

        return view('message');
    }

    function updateReview(){

        $r = Review::where('id', Request::get('review_id'))
            ->where('user_id', Auth::user()->id)
            ->first();

        $error = $this->checkHasError($r);

        if ($error) return view('notice', ['title' => '您有一項評分打了0分。', 'message' => '滿分5分，請輸入1到5。']);

        $r->save();

        return view('message');
    }

    function checkHasError($r)
    {
        $fields = getReviewKeys();

        $error = false;

        $arr = [];

        foreach ($fields as $field) {
            $value = (int) Request::get($field . '-rating');

            if ($value === 0) {
                $error = true;
            }

            $arr[$field] = $value;
        }

        $r->review_fields = json_encode($arr);

        return $error;
    }

    function reviewers($id)
    {
        $cafe = Cafe::find($id);

        return view('reviewers', ['cafe' => $cafe]);
    }

    function deleteReview(){

        $r = Review::where('id', Request::get('review_id'))
            ->where('user_id', Auth::user()->id)
            ->first();

        $r->delete();

        return view('notice', ['title' => '刪除完成。', 'message' => '']);
    }

    function addComment()
    {
        $c = new Comment();
        $c->cafe_id = Request::get('cafe_id');
        $c->body = Request::get('body');
        $c->user_id = Auth::user()->id;
        $c->save();

        return redirect()->back();
    }

    function removeComment()
    {
        $c = Comment::where('id', Request::get('comment_id'))
            ->where('user_id', Auth::user()->id)
            ->first();

        $c->delete();

        return redirect()->back();
    }

}
