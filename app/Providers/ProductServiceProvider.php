<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 20.01.16
 * Time: 18:50
 */

namespace App\Providers;


use App\Models\Product\Product;
use App\Models\Section;
use App\Repo\Product\EloquentProduct;
use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('App\Repo\Product\ProductInterface', function($app){
            $product = new EloquentProduct(new Product(), new Section());
            return $product;
        });
    }
}