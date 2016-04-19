<?php

namespace App\Providers;

use App\Models\Banner;
use App\Repo\Banners\EloquentBanner;
use Illuminate\Support\ServiceProvider;

class BannerServiceProvider extends ServiceProvider
{

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind('App\Repo\Banners\BannerInterface', function($app){
            $faq = new EloquentBanner( new Banner() );

            return $faq;
        });
    }
}
