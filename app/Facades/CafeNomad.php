<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;
use App\CafeNomad as RealCafeNomad;

class CafeNomad extends Facade
{

    protected static function getFacadeAccessor()
    {
        return RealCafeNomad::class;
    }

}
