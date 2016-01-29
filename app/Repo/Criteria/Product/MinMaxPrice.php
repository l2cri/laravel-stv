<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 29.01.16
 * Time: 21:12
 */

namespace App\Repo\Criteria\Product;


use App\Repo\Criteria\Criteria;

class MinMaxPrice extends Criteria
{
    protected $minprice;
    protected $maxprice;

    public function __construct($minprice, $maxprice){
        $this->minprice = floatval($minprice);
        $this->maxprice = floatval($maxprice);
    }

    public function apply($model){
        $query = $model->whereBetween('price', [$this->minprice, $this->maxprice]);
        return $query;
    }
}