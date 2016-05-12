<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 12.05.16
 * Time: 15:21
 */

namespace App\Providers;


use App\Repo\User\EloquentUser;
use App\User;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('App\Repo\User\UserInterface', function($app){
            return new EloquentUser( new User() );
        });
    }
}