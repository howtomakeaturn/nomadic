<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;
use App\Layout as RealLayout;

class Layout extends Facade
{

    protected static function getFacadeAccessor()
    {
        return RealLayout::class;
    }

}
