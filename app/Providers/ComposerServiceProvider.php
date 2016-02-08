<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 18.01.16
 * Time: 15:46
 */

namespace App\Providers;


use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        // Using class based composers...
        view()->composer(
            'common.menusections', 'App\Http\ViewComposers\MenuSectionsComposer'
        );

        view()->composer(
            'catalog.filter', 'App\Http\ViewComposers\FilterComposer'
        );

        view()->composer(
            ['cart.updateForm', 'cart.dropdown'], 'App\Http\ViewComposers\CartUpdateFormComposer'
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