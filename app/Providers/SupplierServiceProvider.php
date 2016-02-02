<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 02.02.16
 * Time: 20:17
 */

namespace App\Providers;


use App\Models\Supplier;
use App\Repo\Supplier\EloquentSupplier;
use Illuminate\Support\ServiceProvider;

class SupplierServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repo\Supplier\SupplierInterface', function($app){
            $supplier = new EloquentSupplier(new Supplier());
            return $supplier;
        });
    }

}