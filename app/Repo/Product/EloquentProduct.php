<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 19.01.16
 * Time: 20:51
 */

namespace App\Repo\Product;


use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\Node;

class EloquentProduct implements ProductInterface
{

    protected $product;
    protected $section;

    public function __construct(Model $product, Node $section) {
        $this->product = $product;
        $this->section = $section;
    }

    public function byId($id) {
        return $this->product->find($id);
    }

    // TODO: будет от формы зависеть как мы изменим массив $data
    public function create(array $data) {
        return $this->product->create($data);
    }

    public function update(array $data, $id, $attribute="id"){
        return $this->product->where($attribute, '=', $id)->update($data);
    }

    public function delete($id){

        // TODO: удалять изображения

        return $this->product->destroy($id);
    }

    public function bySupplier($supplierId){
        return $this->section->where('supplier_id', $supplierId)->get();
    }

    public function bySection($sectionId, $includeSubsections = true){

        $category = $this->section->find($sectionId);

        // айдишники категорий
        $categories = array();
        if ($includeSubsections)
            $categories = $category->descendants()->lists('id');
        $categories[] = $category->getKey();

        // достаем товары которые есть в этих категориях, many to many relation
        $products = $this->product->whereHas('sections', function($q) use ($categories)
        {
            $q->whereIn('id', $categories);
        })->paginate(5);

        return $products;
    }

    public function bySectionWithSupplier($sectionId, $supplierId, $includeSubsections = true){

    }

    public function paginate(){

    }

    public function findBy($field, $value, $columns = array('*')){

    }
}