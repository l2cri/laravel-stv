<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 18.11.15
 * Time: 18:08
 */

namespace App\Services\Cache;


use Illuminate\Cache\CacheManager;

class LaravelCache implements CacheInterface
{
    protected $cache;
    protected $minutes;

    public function __construct(CacheManager $cache, $minutes=null) {
        $this->cache = $cache;
        if (!$minutes) $this->minutes = config('marketplace.cacheTime');
    }

    public function get($key) {
        return $this->cache->get($key);
    }

    public function put($key, $value, $minutes=null) {
        if( !$minutes ) {
            $minutes = $this->minutes;
        }
        return $this->cache->put($key, $value, $minutes);
    }

    public function has($key){
        return $this->cache->has($key);
    }

    public function forget($key){
        return $this->cache->forget($key);
    }
}