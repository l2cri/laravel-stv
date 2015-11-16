<?php

namespace App\Providers;

use App\Models\Infopage;
use App\Repo\Infopage\EloquentInfopage;
use Illuminate\Support\ServiceProvider;

class InfopageServiceProvider extends ServiceProvider
{

    /**
     * Отложенный провайдер
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repo\Infopage\InfopageInterface', function($app){
            return new EloquentInfopage(new Infopage());
        });
    }

    /**
     * Сервисы, которые он предоставляет, в данном случае один
     *
     * @return array
     */
    public function provides()
    {
        return ['App\Repo\Infopage\InfopageInterface'];
    }
}
