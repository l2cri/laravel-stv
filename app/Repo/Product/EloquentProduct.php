<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 19.01.16
 * Time: 20:51
 */

namespace App\Repo\Product;


use App\Repo\Criteria\CriteriaTrait;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\Node;

class EloquentProduct implements ProductInterface
{

    use CriteriaTrait;

    protected $model;
    protected $section;
    protected $allSections;
    protected $allProducts; // products query

    public function __construct(Model $product, Node $section) {
        $this->model = $product;
        $this->section = $section;
    }

    public function byId($id) {
        return $this->model->find($id);
    }

    // TODO: будет от формы зависеть как мы изменим массив $data
    public function create(array $data) {
        return $this->model->create($data);
    }

    public function update(array $data, $id, $attribute="id"){
        return $this->model->where($attribute, '=', $id)->update($data);
    }

    public function delete($id){

        // TODO: удалять изображения

        return $this->model->destroy($id);
    }

    public function bySupplier($supplierId){
        return $this->section->where('supplier_id', $supplierId)->get();
    }

    public function bySection($sectionId, $includeSubsections = true){

        $category = $this->section->find($sectionId);

        // айдишники категорий
        $categories = array();
        if ($includeSubsections){
            $categories = $category->descendants()->lists('id');
        }
        $categories[] = $category->getKey();
        $this->allSections = $categories;

        // вытаскиваем все товары
        $productsQuery = $this->bySections($categories);
        $products = $productsQuery->sortable()->paginable();

        $this->allProducts = $productsQuery->get();
        
        return $products;
    }

    public function bySectionWithSupplier($sectionId, $supplierId, $includeSubsections = true){

    }

    public function paginate(){

    }

    public function findBy($field, $value, $columns = array('*')){

    }

    /**
     * return query
     */
    public function bySections($categories){

        $this->applyCriteria();

        $products = $this->model->whereHas('sections', function($q) use ($categories)
        {
            $q->whereIn('id', $categories);
        });//paginate(config('marketplace.perpage'));

        return $products;
    }

    public function allProductsFromLastRequest(){
        return $this->allProducts;
    }
}