<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 26.01.16
 * Time: 16:33
 */

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class ProductRepo extends Facade
{
    protected static function getFacadeAccessor() { return 'App\Repo\Product\ProductInterface'; }
}