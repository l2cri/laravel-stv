<?php
/**
 * Created by PhpStorm.
 * User: l2cri
 * Date: 06.04.16
 * Time: 17:17
 */

namespace App\Repo;


interface RatingIterface
{
    public function rate($modelId,$rating);
}