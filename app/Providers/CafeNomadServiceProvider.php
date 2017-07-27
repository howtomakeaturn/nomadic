<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\CafeNomad;

class CafeNomadServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(CafeNomad::class, function ($app) {
            return new CafeNomad();
        });
    }
}
