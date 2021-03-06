<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 19.01.16
 * Time: 20:51
 */

namespace App\Repo\Product;


use App\Repo\Criteria\CriteriaTrait;
use App\Repo\DatatablesTrait;
use App\Repo\RatingRepoTrait;
use App\Repo\RepoTrait;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\Node;

class EloquentProduct implements ProductInterface
{
    use RepoTrait;
    use CriteriaTrait;
    use DatatablesTrait;
    use RatingRepoTrait;

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
        $product = $this->model->find($id);
        foreach ($product->photos as $photo) removefile($photo->file);
        return $this->model->destroy($id);
    }

    public function bySupplier($supplierId){
        $this->applyCriteria();
        return $this->model->where('supplier_id', $supplierId)->get();
    }

    public function otherBySupplier($supplierId,$id){
        return $this->model->where('supplier_id', $supplierId)->where('id','!=',$id);
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
        $this->allProducts = $productsQuery->get();

        $products = $productsQuery->sortable()->paginable();

        return $products;
    }

    public function bySectionIds (array $ids) {
        $productsQuery = $this->bySections($ids);
        $this->allProducts = $productsQuery->get();

        return $productsQuery->sortable()->paginable();
    }

    public function bySupplierPaginate($supplierId){
        $this->applyCriteria();
        $productsQuery = $this->model->where('supplier_id', $supplierId);
        $this->allProducts = $productsQuery->get();

        return $productsQuery->sortable()->paginable();
    }

    public function bySectionWithSupplier($sectionId, $supplierId, $includeSubsections = true){

        // TODO: добавить в отдельную функцию - повтор кода с public function bySection($sectionId, $includeSubsections = true)
        $category = $this->section->find($sectionId);

        // айдишники категорий
        $categories = array();
        if ($includeSubsections){
            $categories = $category->descendants()->lists('id');
        }
        $categories[] = $category->getKey();
        // TODO end

        $products = $this->model->whereHas('sections', function($q) use ($categories)
        {
            $q->whereIn('id', $categories);
        })
        ->where('supplier_id', $supplierId)
        ->get();

        return $products;
    }

    public function paginate(){

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

    public function getUserFavorite()
    {
        $productsQuery = $this->model->whereIn('id',function($q) {
            $q->select('product_id')
                ->from('favorite')
                ->where('user_id', userId());
        });

       return $productsQuery->sortable()->paginable();
    }

    public function orderByRandom(){
        return $this->model->orderByRandom();
    }

}