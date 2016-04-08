<?php

namespace App\Providers;

use App\Models\Favorite;
use App\Repo\Favorite\EloquentFavorite;
use Illuminate\Support\ServiceProvider;

class FavoriteServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind('App\Repo\Favorite\FavoriteInterface', function($app){
            $favorite = new EloquentFavorite( new Favorite() );

            return $favorite;
        });
    }
}
