<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 05.04.16
 * Time: 23:56
 */

namespace App\Repo\Message;


use App\Repo\RepoTrait;
use Illuminate\Database\Eloquent\Model;

class EloquentMessage implements MessageInterface
{
    use RepoTrait;
    protected $model;

    public function __construct(Model $model) {
        $this->model = $model;
    }

    public function userSaw($orderId)
    {
        $this->model->where('order_id', '=', $orderId)->update(['user_saw' => true]);
    }

    public function supplierSaw($orderId)
    {
        $this->model->where('order_id', '=', $orderId)->update(['supplier_saw' => true]);
    }

    public function userNew($orderId)
    {
        return $this->model->where('order_id', '=', $orderId)->whereNull('user_saw')->get();
    }

    public function supplierNew($orderId)
    {
        return $this->model->where('order_id', '=', $orderId)->whereNull('supplier_saw')->get();
    }
}