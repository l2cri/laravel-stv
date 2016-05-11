<?php
/**
 * Created by PhpStorm.
 * User: l2cri
 * Date: 06.04.16
 * Time: 17:19
 */

namespace App\Repo;

use App\Models\Rating;
use Auth;

trait RatingRepoTrait
{
    public function rate($id,$rating)
    {
        $obj =$this->model->find($id);

        $user_id = (int) Auth::user()->id;



        $modelRating = new Rating();

        $issetUserRating = $modelRating ->where('user_id',$user_id)
            ->where('rateable_id',$id)
            ->first();

        if($issetUserRating){
            $obj->ratings()->update(['rating' => $rating]);
        }
        else{
            $obj->ratings()->create(['rating' => $rating,'user_id'=>$user_id]);
        }

        $obj->saveRating();

        return true;
    }
}