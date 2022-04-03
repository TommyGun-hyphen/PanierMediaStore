<?php

namespace App\Providers;
use App;
use Illuminate\Support\ServiceProvider;

class SlugProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        App::bind('slug',function() {
            return new \App\MyFacades\Slug;
         });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
