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
    public function __construct(Model $model){
        $this->model = $model;
    }

    public function delete($id){
        $order = $this->model->find($id);

        foreach ($order->cartItems as $item){
            $item->conditions()->delete();
            $item->delete();
        }

        $order->delete();
    }
}