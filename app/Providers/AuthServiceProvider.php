<?php

namespace App\Providers;

use App\AuthUser;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
//    protected $policies = [
//        'App\Model' => 'App\Policies\ModelPolicy',
//    ];

    public function register()
    {
        $this->app->singleton('auth.user', function($app){
            return new AuthUser();
        });
    }

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        $actions = allActions();

        foreach ($actions as $action){
            $gate->define($action, function ($user) use ($action) {
                return $this->app['auth.user']->can($action);
            });
        }
    }
}
