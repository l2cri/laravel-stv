<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 18.04.16
 * Time: 17:27
 */

namespace App\Repo\Criteria\Supplier;


use App\Repo\Criteria\Criteria;

class LocationOnly extends Criteria
{
    protected $locationIds;

    public function __construct($locationIds) {
        $this->locationIds = $locationIds;
    }

    public function apply($model){

        $ids = $this->locationIds;

        $query = $model->whereHas('locations', function($q) use ($ids){
            $q->whereIn('id', $ids);
        });
        return $query;
    }
}