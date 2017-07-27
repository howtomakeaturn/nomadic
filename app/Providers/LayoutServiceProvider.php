<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Layout;

class LayoutServiceProvider extends ServiceProvider
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
        $this->app->singleton(Layout::class, function ($app) {
            return new Layout();
        });
    }
}
