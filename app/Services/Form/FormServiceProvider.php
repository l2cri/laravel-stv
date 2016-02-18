<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 24.12.15
 * Time: 19:06
 */

namespace App\Services\Form;


use App\Services\Form\Order\OrderForm;
use App\Services\Form\Order\OrderValidator;
use App\Services\Form\Product\ProductForm;
use App\Services\Form\Cart\CartForm;
use App\Services\Form\Product\ProductValidator;
use App\Services\Form\Section\SectionForm;
use App\Services\Form\Section\SectionValidator;
use Illuminate\Support\ServiceProvider;

class FormServiceProvider extends ServiceProvider
{
    public function register(){

        $app = $this->app;

        /*
         * категории
         */
        $app->bind('App\Services\Form\Section\SectionForm', function($app){
            return new SectionForm( new SectionValidator($app['validator']),
                                    $app->make('App\Repo\Section\SectionInterface')
            );
        });

        /*
         * товар
         */
        $app->bind('App\Services\Form\Product\ProductForm', function($app){
            return new ProductForm( new ProductValidator($app['validator']),
                $app->make('App\Repo\Product\ProductInterface')
            );
        });

        /*
         * корзина
         * TODO: добавить валидатор
         */
        $app->bind('App\Services\Form\Cart\CartForm', function($app){
            return new CartForm(
                $app->make('App\Repo\Product\ProductInterface')
            );
        });

        /*
         * заказ
         */
        $app->bind('App\Services\Form\Order\OrderForm', function($app){
            return new OrderForm( new OrderValidator($app['validator']),
                $app->make('App\Repo\Profile\ProfileInterface'),
                $app->make('App\Repo\Cart\CartInterface')
            );
        });
    }
}