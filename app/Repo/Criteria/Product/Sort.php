<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 22.07.16
 * Time: 15:31
 */

namespace App\Repo\Criteria\Product;


use App\Repo\Criteria\Criteria;

class Sort extends Criteria
{
    public function apply($model){
        $query = $model->orderBy('sort', 'asc');
        return $query;
    }
}