<?php

namespace App\Providers;

use App\Models\News;
use App\Repo\News\EloquentNews;
use Illuminate\Support\ServiceProvider;

class NewsServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind('App\Repo\News\NewsInterface',function($app){
            return new EloquentNews( new News() );
        });

    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['App\Repo\News\NewsInterface'];
    }
}
