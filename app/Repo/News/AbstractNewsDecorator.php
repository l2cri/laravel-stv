<?php
/**
 * Created by PhpStorm.
 * User: Unizoo5
 * Date: 17.03.2016
 * Time: 17:41
 */

namespace App\Repo\News;


class AbstractNewsDecorator implements NewsInterface
{
    protected $nextNews;

    public function __construct(NewsInterface $news){
        $this->nextNews = $news;
    }

    public function getList(){
        return $this->nextNews->getList();
    }

    public function byId($id){
        return $this->nextNews->byId($id);
    }
}