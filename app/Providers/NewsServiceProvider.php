<?php

namespace App\Providers;

use App\Models\News;
use App\Repo\News\CacheDecorator;
use App\Repo\News\EloquentNews;
use Illuminate\Support\ServiceProvider;
use App\Services\Cache\LaravelCache;

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
            $news = new EloquentNews( new News());
            return new CacheDecorator($news, new LaravelCache($app['cache']));
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
