<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 02.02.16
 * Time: 19:55
 */

namespace App\Repo\Supplier;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class EloquentSupplier implements SupplierInterface
{
    protected $model;

    public function __construct(Model $model) {
        $this->model = $model;
    }

    public function byId($id)
    {
        // TODO: Implement byId() method.
    }

    public function byCode($code)
    {
        // TODO: Implement byCode() method.
    }

    public function update(array $data, $id, $attribute = "id")
    {
        // TODO: Implement update() method.
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

}