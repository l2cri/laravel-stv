<?php
/**
 * Created by PhpStorm.
 * User: l2cri
 * Date: 25.04.16
 * Time: 13:19
 */
namespace App\Repo\Search;

use Illuminate\Database\Eloquent\Model;

class EloquentSearch implements SearchInterface {

    protected $productModel;
    protected $supplierModel;
    protected $search;

    public function __call($function, $args){
        return $this->search->$function($args[0]);
    }


    public function __construct(Model $product,Model $supplier, Search $search){
        $this->productModel = $product;
        $this->supplierModel = $supplier;
        $this->search = $search;
    }

    public function products($keyword)
    {
        $searchable = $this->search->searchInModel($this->productModel, $keyword);

        return $searchable;
    }

    public function suppliers($keyword)
    {
        $searchable = $this->search->searchInModel($this->supplierModel, $keyword);

        return $searchable;
    }

    public function all($keywords){
        return $this->search->all($keywords);
    }
}