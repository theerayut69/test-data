<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Fixture;

class LogServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Fixture::observe(new \App\Observers\LogObserver);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
