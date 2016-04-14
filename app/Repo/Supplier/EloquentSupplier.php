<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 02.02.16
 * Time: 19:55
 */

namespace App\Repo\Supplier;

use App\Models\Product\Product;
use App\Repo\RatingRepoTrait;
use App\Repo\RepoTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class EloquentSupplier implements SupplierInterface
{
    use RepoTrait;
    use RatingRepoTrait;
    protected $model;

    public function __construct(Model $model) {
        $this->model = $model;
    }

    public function byCode($code)
    {
        return $this->model->where('code', '=', $code)->first();
    }

    public function bySection($sectionId, $includeSubsections = true)
    {
        // TODO: Implement bySection() method.
    }

    public function byProducts(Collection $products)
    {
        $ids = $products->pluck('supplier_id')->toBase()->unique()->all();
        return $this->model->whereIn('id', $ids)->get();
    }

    public function byProductsPaginate(Collection $products) {
        $ids = $products->pluck('supplier_id')->toBase()->unique()->all();
        return $this->model->whereIn('id', $ids)->sortable()->paginable();
    }

    public function allPaginate() {
        return $this->model->sortable()->paginable();
    }

    public function getRandList($productsModel,$currentProduct,$limit = null){
        if(!$limit) $limit = config('marketplace.recommedates_count');

        $supplier_id = $currentProduct->supplier_id;
        $products_id = $currentProduct->id;

        $products = $productsModel
            ->otherBySupplier($supplier_id,$products_id)
            ->orderByRandom()
            ->take($limit)
            ->get();
        
        return $products;
    }

}