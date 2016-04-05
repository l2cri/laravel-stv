<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 25.03.16
 * Time: 17:42
 */

namespace App\Providers;

use App\Models\Action;
use App\Models\Product\Product;
use App\Repo\Action\EloquentAction;
use Illuminate\Support\ServiceProvider;

class ActionServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('App\Repo\Action\ActionInterface', function($app){
            return new EloquentAction( new Action(), new Product());
        });
    }
}