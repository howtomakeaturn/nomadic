<?php

namespace Modules\NomadiCore;

use Illuminate\Database\Eloquent\Model;

class SystemEvent extends Model
{

    static function track($category, $payload)
    {
        $event = new self();

        $event->category = $category;

        $event->payload = json_encode($payload);

        $event->save();
    }

    function getPayload()
    {
        return json_decode($this->payload);
    }

    function getCafe()
    {
        return Cafe::find($this->getPayload()->id);
    }

}
