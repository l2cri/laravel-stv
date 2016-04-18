<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 18.01.16
 * Time: 15:46
 */

namespace App\Providers;


use App\User;
use Illuminate\Auth\Guard;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot(Guard $auth)
    {

        view()->composer('*', function($view) use ($auth) {

            $currentUser = $auth->user();
            if (!$currentUser) $currentUser = new User();

            $view->with('user', $currentUser);

            /**
             * geoLocation
             */
            $location = app()->make('App\Repo\Location\LocationInterface');
            $view->with('currentLocation', $location->getByGeoIp());
        });

        // Using class based composers...
        view()->composer(
            'common.menusections', 'App\Http\ViewComposers\MenuSectionsComposer'
        );

        view()->composer(
            'catalog.filter', 'App\Http\ViewComposers\FilterComposer'
        );

        view()->composer(
            ['cart.updateForm', 'cart.dropdown', 'cart.checkout'], 'App\Http\ViewComposers\CartUpdateFormComposer'
        );
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}