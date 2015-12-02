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

        $key = $this->key($code);

        if( $this->cache->has($key)) {
            return $this->cache->get($key);
        }

        $infopage = $this->nextInfopage->byCode($code);

        $this->cache->put($key, $infopage, $this->cacheTime);

        return $infopage;
    }

    private function key($indentifier){
        return md5(config('cachePrefixInfopage').$indentifier);
    }
}