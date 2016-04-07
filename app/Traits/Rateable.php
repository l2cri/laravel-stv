<?php
/**
 * Created by PhpStorm.
 * User: l2cri
 * Date: 06.04.16
 * Time: 15:46
 */

namespace App\Traits;


trait Rateable
{
    /**
     * This model has many ratings.
     *
     * @return Rating
     */
    public function ratings()
    {
        return $this->morphMany('App\Models\Rating', 'rateable');
    }
    public function averageRating()
    {
        return $this->ratings()->avg('rating');
    }
    public function sumRating()
    {
        return $this->ratings()->sum('rating');
    }
    public function ratingPercent($max = 5)
    {
        $quantity = $this->ratings()->count();
        $total = $this->sumRating();

        return ($quantity * $max) > 0 ? $total / (($quantity * $max) / 100) : 0;
    }
    public function getAverageRatingAttribute()
    {
        return $this->averageRating();
    }
    public function getSumRatingAttribute()
    {
        return $this->sumRating();
    }

    public function saveRating()
    {
        $this->rating = $this->averageRating();
        $this->save();
    }
}