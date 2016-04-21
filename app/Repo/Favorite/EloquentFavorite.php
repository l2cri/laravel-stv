<?php
/**
 * Created by PhpStorm.
 * User: l2cri
 * Date: 05.04.16
 * Time: 16:16
 */

namespace App\Repo\Favorite;

use App\Repo\RepoTrait;
use Illuminate\Database\Eloquent\Model;
use Auth;

class EloquentFavorite implements FavoriteInterface
{
    use RepoTrait;

    protected $model;

    public function __construct(Model $model){
        $this->model = $model;
    }

    public function add($product_id, $user_id)
    {
        return $this->model->create(['product_id'=>$product_id,'user_id'=>$user_id]);
    }

    public function get($user_id)
    {
        // TODO: Implement get() method.
    }

    public function deleteFav($element){

        return $this->delete($element->id);
    }

    public function checkUnique($user_id,$product_id)
    {
        $query = $this->model->where('user_id',$user_id)->where('product_id',$product_id);

        return $query->first();
    }

    public function byProduct($product_id)
    {
        if(!Auth::check()) return false;

        $user_id = userId();
        return $this->checkUnique($user_id,$product_id);
    }
}