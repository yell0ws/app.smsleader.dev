<?php

namespace App\Providers;

use Setting;
use URL;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(Setting::get('ssl_enabled')) URL::forceSchema('https');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {   
        Carbon::setLocale(config('app.locale'));
    }
}
