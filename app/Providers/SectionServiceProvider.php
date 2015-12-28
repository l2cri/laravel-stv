<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 28.12.15
 * Time: 20:20
 */

namespace  App\Providers;

use App\Models\Section;
use App\Repo\Section\EloquentSection;
use Illuminate\Support\ServiceProvider;

class SectionServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('App\Repo\Section\SectionInterface', function($app){
            $section = new EloquentSection(new Section());
            return $section;
        });
    }
}