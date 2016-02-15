<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 15.02.16
 * Time: 17:32
 */

namespace App\Providers;


use App\Models\Profile;
use App\Repo\Profile\EloquentProfile;
use Illuminate\Support\ServiceProvider;

class ProfileServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('App\Repo\Profile\ProfileInterface', function($app){
            return new EloquentProfile( new Profile() );
        });
    }
}