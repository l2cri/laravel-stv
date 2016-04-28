<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 18.02.16
 * Time: 17:20
 */

namespace App\Repo\Order;

use App\Repo\RepoTrait;
use Illuminate\Database\Eloquent\Model;


class EloquentOrder implements OrderInterface
{
    use RepoTrait;

    protected $model;
    protected $modelStatus;

    public function __construct(Model $model, Model $modelStatus){
        $this->model = $model;
        $this->modelStatus = $modelStatus;
    }

    public function delete($id){
        $order = $this->model->find($id);

        foreach ($order->cartItems as $item){
            $item->conditions()->delete();
            $item->delete();
        }

        $order->delete();
    }

    public function statuses()
    {
        return $this->modelStatus->all();
    }

    public function byWhereIn($field, array $array){
        return $this->model->whereIn($field, $array)->get();
    }
}