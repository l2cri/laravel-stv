<?php
/**
 * Created by PhpStorm.
 * User: l2cri
 * Date: 05.04.16
 * Time: 16:16
 */

namespace App\Repo\Faq;

use App\Repo\RepoTrait;
use Illuminate\Database\Eloquent\Model;

class EloquentFaq implements FaqInterface
{
    use RepoTrait;

    protected $model;

    public function __construct(Model $model){
        $this->model = $model;
    }

    public function paginateByProductId($product_id){

        return $this->model->where('moderated',1)->byProductItems($product_id,null,['updated_at','desc']);
    }

    public function create(array $data)
    {

        /**
         * @todo get this parameter from supplier settings
         */
        $data['moderated'] = 1;

        return $this->model->create($data);
    }

    public function deleteSupplier($id){
        $faq = $this->byId($id);

        if($faq->product->supplier->id ==  supplierId())
            $this->delete($id);
    }

    public function bySupplier(){

        $supplierId = supplierId();

        $faq = $this->model->whereIn('product_id',function($q)use ($supplierId){
            $q->select('id')
                ->from('products')
                ->where('supplier_id', $supplierId);
        })->orderBy('created_at', 'desc')->paginable();

        return $faq;

    }

    public function getForEdit($id){
        $faq = $this->byId($id);

        if($faq->product->supplier->id ==  supplierId())
            return $faq;
    }

}