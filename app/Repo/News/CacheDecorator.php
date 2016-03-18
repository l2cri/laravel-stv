<?php
/**
 * Created by PhpStorm.
 * User: Unizoo5
 * Date: 17.03.2016
 * Time: 17:45
 */

namespace App\Repo\News;


use App\Services\Cache\CacheInterface;
use Cache;

class CacheDecorator extends AbstractNewsDecorator
{
    protected $cacheTime;
    protected $cache;

    public function __construct(NewsInterface $nextNews, CacheInterface $cache,$minutes = null )
    {

        parent::__construct($nextNews);

        $this->cacheTime = $minutes;
        $this->cache = $cache;
    }

    public function getList()
    {
        $page = ( !empty(\Input::get('page')) ) ? \Input::get('page') : 1;

        $key = $this->key('all-news-'.$page);

        if($this->cache->has($key)){
            return $this->cache->get($key);
        }

        $news = $this->nextNews->getList();

        $this->cache->put($key,$news,$this->cacheTime);

        return $news;
    }

    public function byId($id){
        $key = $this->key('news-'.$id);
        if($this->cache->has($key)){
            return $this->cache->get($key);
        }

        $post = $this->nextNews->byId($id);

        $this->cache->put($key,$post,$this->cacheTime);

        return $post;
    }

    private function key($indentifier)
    {
        return md5(config('cachePrefixInfopage').$indentifier);
    }
}