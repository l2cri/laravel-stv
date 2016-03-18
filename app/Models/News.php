<?php

namespace App\Models;

use App\Services\Cache\StaticHelper;
use App\Traits\SortableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class News extends Model
{
    use SortableTrait;
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

    public function setImageAttribute($image)
    {
        $newPath = 'images/news/';
        $issetOldImage = array_key_exists('image',$this->attributes);

        if(!$image) {
            $this->attributes['image'] = "";
        }
        else{

            if($issetOldImage && $this->attributes['image'] == $image)
                    return;

            $fileName = basename($image);

            Storage::move($image,$newPath.$fileName);

            $this->attributes['image'] = $newPath.$fileName;
        }
    }

}
