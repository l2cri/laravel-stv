<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 05.04.16
 * Time: 23:58
 */

namespace App\Providers;


use App\Models\Message;
use App\Repo\Message\EloquentMessage;
use Illuminate\Support\ServiceProvider;

class MessageServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('App\Repo\Message\MessageInterface', function($app){
            return new EloquentMessage( new Message() );
        });
    }
}