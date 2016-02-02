<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 02.02.16
 * Time: 17:21
 */

namespace App\StaticHelpers;

use Illuminate\Database\Eloquent\Collection;

class ProductHelper
{
    public static function maxProductPrice(Collection $products){
        $max = 0;
        foreach ($products as $product) {
            if ($product->price > $max) $max = $product->price;
        }

        return $max;
    }
}