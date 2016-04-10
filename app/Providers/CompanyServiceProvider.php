<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 09.04.16
 * Time: 15:44
 */

namespace App\Providers;


use App\Models\Company;
use App\Models\Profile;
use App\Models\Supplier;
use App\Repo\Company\EloquentCompany;
use Illuminate\Support\ServiceProvider;

class CompanyServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('App\Repo\Company\CompanyInterface', function($app){
            return new EloquentCompany( new Company(), new Profile(), new Supplier());
        });
    }
}