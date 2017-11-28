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
        // Fixture::observe(new \App\Observers\LogObserver);
        view()->composer('*', 'App\Http\ViewComposers\LogComposer');
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
