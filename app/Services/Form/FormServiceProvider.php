<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 24.12.15
 * Time: 19:06
 */

namespace App\Services\Form;


use App\Services\Form\Action\ActionForm;
use App\Services\Form\Action\ActionValidator;
use App\Services\Form\Comment\CommentForm;
use App\Services\Form\Comment\CommentValidator;
use App\Services\Form\Company\CompanyForm;
use App\Services\Form\Company\CompanyValidator;
use App\Services\Form\Faq\FaqForm;
use App\Services\Form\Faq\FaqValidator;
use App\Services\Form\Favorite\FavoriteForm;
use App\Services\Form\Favorite\FavoriteValidator;
use App\Services\Form\Location\LocationForm;
use App\Services\Form\Location\LocationValidator;
use App\Services\Form\Order\OrderForm;
use App\Services\Form\Order\OrderValidator;
use App\Services\Form\Product\ProductForm;
use App\Services\Form\Cart\CartForm;
use App\Services\Form\Product\ProductValidator;
use App\Services\Form\Profile\ProfileForm;
use App\Services\Form\Profile\ProfileValidator;
use App\Services\Form\Rating\RatingForm;
use App\Services\Form\Rating\RatingValidator;
use App\Services\Form\Section\SectionForm;
use App\Services\Form\Section\SectionValidator;
use App\Services\Form\Supplier\SupplierForm;
use App\Services\Form\Supplier\SupplierValidator;
use App\Services\Form\User\UserForm;
use App\Services\Form\User\UserValidator;
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
                $app->make('App\Repo\Product\ProductInterface'),
                $app->make('App\Repo\Action\ActionInterface')
            );
        });

        /*
         * корзина
         * TODO: добавить валидатор
         */
        $app->bind('App\Services\Form\Cart\CartForm', function($app){
            return new CartForm(
                $app->make('App\Repo\Product\ProductInterface'),
                $app->make('App\Repo\Cart\CartInterface')
            );
        });

        /*
         * заказ
         */
        $app->bind('App\Services\Form\Order\OrderForm', function($app){
            return new OrderForm( new OrderValidator($app['validator']),
                $app->make('App\Repo\Profile\ProfileInterface'),
                $app->make('App\Repo\Cart\CartInterface'),
                $app->make('App\Repo\Order\OrderInterface'),
                $app->make('App\Repo\Product\ProductInterface'),
                $app->make('App\Repo\Message\MessageInterface')
            );
        });

        /*
         * профиль
         */
        $app->bind('App\Services\Form\Profile\ProfileForm', function($app){
            return new ProfileForm( new ProfileValidator($app['validator']),
                $app->make('App\Repo\Profile\ProfileInterface')
            );
        });

        /*
         * comments
         */
        $app->bind('App\Services\Form\Comment\CommentForm', function($app){
            return new CommentForm( new CommentValidator($app['validator']),
                $app->make('App\Repo\Comment\CommentInterface')
            );
        });

        /*
         * actions
         */
        $app->bind('App\Services\Form\Action\ActionForm', function ($app){
           return new ActionForm( new ActionValidator($app['validator']),
               $app->make('App\Repo\Action\ActionInterface'), $app->make('App\Repo\Product\ProductInterface')
           );
        });

        /*
         * FAQ
         */
        $app->bind('App\Services\Form\Faq\FaqForm', function ($app){
            return new FaqForm( new FaqValidator($app['validator']),
                $app->make('App\Repo\Faq\FaqInterface')
            );
        });

        /*
         * Rating
         */
        $app->bind('App\Services\Form\Rating\RatingForm', function ($app){
            return new RatingForm( new RatingValidator($app['validator']),
                $app->make('App\Repo\Product\ProductInterface'),
                $app->make('App\Repo\Supplier\SupplierInterface'));
        });

        /*
         * Supplier
         */
        $app->bind('App\Services\Form\Supplier\SupplierForm', function ($app) {
            return new SupplierForm(new SupplierValidator($app['validator']),
                $app->make('App\Repo\Supplier\SupplierInterface'));
        });


        /*
        * Favorite
         */
        $app->bind('App\Services\Form\Favorite\FavoriteForm', function ($app){
            return new FavoriteForm( new FavoriteValidator($app['validator']),
                $app->make('App\Repo\Favorite\FavoriteInterface')
            );
        });

        /*
       * Company
        */
        $app->bind('App\Services\Form\Company\CompanyForm', function ($app){
            return new CompanyForm( new CompanyValidator( $app['validator'] ),
                $app->make('App\Repo\Company\CompanyInterface'),
                $app->make('App\Repo\Profile\ProfileInterface'),
                $app->make('App\Repo\Supplier\SupplierInterface')
            );
        });

        /*
         * Locations
         */
        $app->bind('App\Services\Form\Location\LocationForm', function ($app){

            return new LocationForm(new LocationValidator($app['validator']),
                $app->make('App\Repo\Location\LocationInterface'));
        });

        /*
         * User accaunt settings
         */
        $app->bind('App\Services\Form\Location\UserForm', function ($app){
           return new UserForm(new UserValidator(),
               $app->make('App\Repo\User\UserInterface')
           );
        });
    }
}