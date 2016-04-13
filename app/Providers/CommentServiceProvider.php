<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\Product\Product;
use App\Models\Supplier;
use App\Repo\Comment\EloquentComment;
use Illuminate\Support\ServiceProvider;

class CommentServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind('App\Repo\Comment\CommentInterface',function($app){
            $comment = new EloquentComment( new Comment(), new Product(), new Supplier() );

            return $comment;
        });
    }
}
