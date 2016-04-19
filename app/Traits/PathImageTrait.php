<?php
/**
 * Created by PhpStorm.
 * User: l2cri
 * Date: 19.04.16
 * Time: 14:33
 */

namespace App\Traits;


use Illuminate\Support\Facades\Storage;

trait PathImageTrait
{

    public function setImageAttribute($image)
    {
        $newPath = 'images/'.$this->table.'/';
        $issetOldImage = array_key_exists('image',$this->attributes);

        if(!$image) {
            $this->attributes['image'] = "";
        }
        else{

            if($issetOldImage && $this->attributes['image'] == $image)
                return;

            $fileName = basename($image);

            if(!Storage::exists($newPath.$fileName))
                Storage::move($image,$newPath.$fileName);

            $this->attributes['image'] = $newPath.$fileName;
        }
    }
}