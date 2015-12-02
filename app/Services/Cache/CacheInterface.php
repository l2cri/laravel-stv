<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 17.11.15
 * Time: 13:43
 */

namespace App\Services\Cache;


interface CacheInterface
{
    public function get($key);
    public function put($key, $value, $minutes = null);
    public function has($key);
    public function forget($key);
}