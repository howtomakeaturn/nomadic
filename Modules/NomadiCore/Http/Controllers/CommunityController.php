<?php

namespace Modules\NomadiCore\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Modules\NomadiCore\Entity;

class CommunityController extends BaseController
{
    public function contribute(Request $request)
    {
        checkInfoFieldsSetting();

        if (!$request->user()) {
            return redirect('login?&path=/contribute');
        }

        return view('nomadicore::community.contribute');
    }

    public function saveContribution(Request $request)
    {
        $entity = new Entity();
        $entity->id = \Ramsey\Uuid\Uuid::uuid4()->toString();
        $entity->name = $request->input('name');
        $entity->city = $request->input('city');
        $entity->status = Entity::APPROVED_STATUS;

        $entity->review_fields =
            collect(config('review-fields'))
            ->pluck('key')
            ->mapWithKeys(function ($key) use ($request) {
                return [$key => $request->input('review_' . $key, "0")];
            })
            ->toJson();
        $entity->info_fields =
            collect(config('info-fields'))
            ->pluck('key')
            ->mapWithKeys(function ($key) use ($request) {
                return [$key => $request->input('info_' . $key, '')];
            })
            ->toJson();

        if (config('nomadic.map-enabled')) {
            $entity->address = $request->input('address');

            setupEntityCoordinate($entity);
        }

        $entity->save();

        if (config('nomadic.business-hours-enabled')) {
            $entity->createBusinessHours($request->input('business-hours'));
        }

        return view('nomadicore::notice', ['title' => '新增成功！', 'message' => '非常謝謝您，已經新增進資料庫！']);
    }
}
