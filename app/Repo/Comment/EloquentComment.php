<?php
/**
 * Created by PhpStorm.
 * User: Unizoo5
 * Date: 24.03.2016
 * Time: 17:36
 */

namespace App\Repo\Comment;


use App\Repo\RepoTrait;
use App\Repo\Supplier\SupplierInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class EloquentComment implements CommentInterface
{
    use RepoTrait;

    protected $model;
    protected $productModel;
    protected $supplierModel;
    protected $page = 1;

    public function __construct(Model $model,Model $productModel, Model $supplierModel){
        $this->model = $model;
        $this->productModel = $productModel;
        $this->supplierModel = $supplierModel;
        $this->page = Input::get('page');
    }

    public function create(array $data)
    {

        $product = $this->productModel->find($data['id']);
        /**
         * @todo get this parameter from supplier settings
         */
        $data['moderated'] = 1;

        return $product->comments()->create($data);
    }

    public function create4Supplier(array $data)
    {

        $product = $this->supplierModel->find($data['id']);
        /**
         * @todo get this parameter from supplier settings
         */
        $data['moderated'] = 1;

        return $product->comments()->create($data);
    }

    public function getByObject($item, $perPage = null)
    {
        if(!$perPage) $perPage = config('marketplace.commentsPerPage');

        return $item->comments()->where('moderated',1)->orderBy('created_at', 'desc')->paginable(null, $perPage);
    }

    public function byProductId($id){
        $product = $this->productModel->find($id);

        return $this->getByObject($product);
    }
    public function bySupplierId($id){
        $supplier = $this->supplierModel->find($id);

        return $this->getByObject($supplier,config('marketplace.perpage'));
    }
    public function bySupplier(){

        $supplierId = supplierId();

        $comments = $this->model->whereIn('commentable_id',function($q)use ($supplierId){
            $q->select('id')
                ->from('products')
                ->where('supplier_id', $supplierId);
        })->orderBy('created_at', 'desc')->paginable();

        return $comments;

    }

    public function commentsBySupplier($supplier)
    {
        return $supplier->comments()->sortable()->paginable();
    }
}