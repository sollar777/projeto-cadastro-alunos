<?php

namespace App\Providers;

use App\Services\Utilities;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class UtilitiesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        App::bind('utilities', function(){
            return new Utilities();
        });
    }
}
