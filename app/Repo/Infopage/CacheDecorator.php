<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 17.11.15
 * Time: 15:16
 */

namespace App\Repo\Infopage;

use App\Services\Cache\CacheInterface;
use Cache;

class CacheDecorator extends AbstractInfopageDecorator
{
    protected $cacheTime;
    protected $cache;

    public function __construct(InfopageInterface $nextInfopage, CacheInterface $cache, $minutes = null){
        parent::__construct($nextInfopage);

        $this->cacheTime = $minutes;
        $this->cache = $cache;
    }

    public function byCode($code){

        $key = md5(config('cachePrefixInfopage').$code);

        if( $this->cache->has($key)) {
            var_dump('CACHED!');
            return $this->cache->get($key); }

        $infopage = $this->nextInfopage->byCode($code);
        $infopage->cached_at = time();
        $infopage->save();

        $this->cache->put($key, $infopage, $this->cacheTime);

        var_dump('NEW!');

        return $infopage;
    }
}