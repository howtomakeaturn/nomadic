<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Cafe;

class CommunityController extends BaseController
{
    public function contribute(Request $request)
    {
        if (!$request->user()) {
            return redirect('login?&path=/contribute');
        }

        return view('community.contribute');
    }

    public function saveContribution(Request $request)
    {
        $cafe = new Cafe();
        $cafe->id = \Ramsey\Uuid\Uuid::uuid4()->toString();
        $cafe->name = $request->input('name');
        $cafe->city = $request->input('city');
        $cafe->status = Cafe::APPROVED_STATUS;

        $cafe->review_fields =
            collect(config('review-fields'))
            ->pluck('key')
            ->mapWithKeys(function ($key) use ($request) {
                return [$key => $request->input('review_' . $key, "0")];
            })
            ->toJson();
        $cafe->info_fields =
            collect(config('info-fields'))
            ->pluck('key')
            ->mapWithKeys(function ($key) use ($request) {
                return [$key => $request->input('info_' . $key, '')];
            })
            ->toJson();
        $cafe->save();

        return view('notice', ['title' => '新增成功！', 'message' => '非常謝謝您，已經新增進資料庫！']);
    }
}
