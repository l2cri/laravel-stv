<?php

namespace App\Models;

use App\Services\Cache\StaticHelper;
use App\Traits\PathImageTrait;
use App\Traits\SortableTrait;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use SortableTrait;
    use PathImageTrait;
    //
    protected $table = 'news';

    protected $fillable = [
        'name','text','image'
    ];

    public static function boot(){
        parent::boot();
        static::updated( function($post){
            StaticHelper::refreshInfopageByCode('all-news-1');
            StaticHelper::refreshInfopageByCode('news-'.$post->id);
        });
        static::creating( function($news){
            StaticHelper::refreshInfopageByCode('all-news-1');
        });
        static::deleted( function($post){
            StaticHelper::refreshInfopageByCode('all-news-1');
            StaticHelper::refreshInfopageByCode('news-'.$post->id);
        });
    }

}
