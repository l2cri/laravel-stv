<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 18.02.16
 * Time: 18:43
 */

namespace App\Providers;

use App\Models\Product\Product;
use App\Models\Supplier;
use App\Repo\Search\EloquentSearch;
use Illuminate\Support\ServiceProvider;

class SearchServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repo\Search\SearchInterface', function($app){
            return new EloquentSearch( new Product(), new Supplier(), $app->make('App\Repo\Search\Search') );
        });
    }

}