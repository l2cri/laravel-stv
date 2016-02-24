<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 18.02.16
 * Time: 18:43
 */

namespace App\Providers;


use App\Models\Order;
use App\Repo\Order\EloquentOrder;
use Illuminate\Support\ServiceProvider;

class OrderServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repo\Order\OrderInterface', function($app){
            return new EloquentOrder( new Order() );
        });
    }

}