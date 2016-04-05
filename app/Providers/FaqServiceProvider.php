<?php

namespace App\Providers;

use App\Models\Faq;
use App\Repo\Faq\EloquentFaq;
use Illuminate\Support\ServiceProvider;

class FaqServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind('App\Repo\Faq\FaqInterface', function($app){
            $faq = new EloquentFaq( new Faq() );

            return $faq;
        });
    }
}
