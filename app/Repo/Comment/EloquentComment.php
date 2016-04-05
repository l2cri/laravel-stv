<?php
/**
 * Created by PhpStorm.
 * User: Unizoo5
 * Date: 24.03.2016
 * Time: 17:36
 */

namespace App\Repo\Comment;


use App\Repo\RepoTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class EloquentComment implements CommentInterface
{
    use RepoTrait;

    protected $model;
    protected $productModel;
    protected $page = 1;

    public function __construct(Model $model,Model $productModel){
        $this->model = $model;
        $this->productModel = $productModel;
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

    public function getByObject($product)
    {
        //Input::replace(array('limit' => '4','page' => $this->page));
        return $product->comments()->where('moderated',1)->orderBy('created_at', 'desc')->paginable(null, 2);
    }

    public function byProductId($id){
        $product = $this->productModel->find($id);

        return $this->getByObject($product);
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
}