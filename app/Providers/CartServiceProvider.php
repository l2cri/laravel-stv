<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 06.02.16
 * Time: 4:22
 */

namespace App\Providers;


use App\Repo\Cart\CartRepo;
use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repo\Cart\CartInterface', function($app){
            $cart = new CartRepo();
            return $cart;
        });
    }

}