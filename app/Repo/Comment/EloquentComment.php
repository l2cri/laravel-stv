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

        return $product->comments()->create($data);
    }

    public function getByObject($product)
    {
        Input::replace(array('limit' => '4','page' => $this->page));
        return $product->comments()->orderBy('created_at', 'desc')->paginable();
    }

    public function byProductId($id){
        $product = $this->productModel->find($id);

        return $this->getByObject($product);
    }
}