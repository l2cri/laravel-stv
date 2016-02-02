<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 02.02.16
 * Time: 20:51
 */

namespace App\Repo\Criteria\Product;


use App\Repo\Criteria\Criteria;

class SuppliersOnly extends Criteria
{
    protected $suppliersIds;

    public function __construct($suppliersIds) {
        $this->suppliersIds = $suppliersIds;
    }

    public function apply($model){
        $query = $model->whereIn('supplier_id', $this->suppliersIds);
        return $query;
    }
}