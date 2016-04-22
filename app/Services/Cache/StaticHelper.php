<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 02.12.15
 * Time: 13:10
 */

namespace App\Services\Cache;

use Cache;

class StaticHelper
{
    public static function refreshInfopageByCode($code){
        $key = md5(config('marketplace.cachePrefixInfopage').$code);
        Cache::forget($key);
    }

    public static function refreshByStore($store)
    {
        Cache::store($store)->flush();
    }
}