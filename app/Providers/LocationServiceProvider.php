<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 13.04.16
 * Time: 18:19
 */

namespace App\Providers;


use App\Models\Location;
use App\Models\Supplier;
use App\Repo\Location\LocationRepo;
use Illuminate\Support\ServiceProvider;

class LocationServiceProvider extends ServiceProvider
{
    public function register() {

        $this->app->bind('App\Repo\Location\LocationInterface', function($app){
            return new LocationRepo( new Location(), new Supplier(), $app['request']);
        });

    }
}