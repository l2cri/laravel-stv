<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 25.03.16
 * Time: 17:40
 */

namespace App\Repo\Action;

use App\Repo\RepoTrait;
use Illuminate\Database\Eloquent\Model;

class EloquentAction implements ActionInterface
{
    use RepoTrait;

    protected $model;
    protected $product;

    public function __construct(Model $model, Model $product){
        $this->model = $model;
        $this->product = $product;
    }

    public function bySupplier($supplierId)
    {
        return $this->findAllBy('supplier_id', $supplierId);
    }

    public function revokeAll($actionId, $supplierId)
    {
        $this->product->where('supplier_id', '=', $supplierId)
                        ->where('action_id', '=', $actionId)
                        ->update($this->emptyData());
    }

    public function revokeOne($actionId, $productId)
    {
        $this->product->where('id', '=', $productId)
            ->update($this->emptyData());
    }

    public function applyAll($actionId, $supplierId)
    {
        $products = $this->product->where('supplier_id', '=', $supplierId)->get();
        foreach ($products as $product) {
            $this->product->where('id', '=', $product->id)
                            ->update($this->actionData($product->id, $actionId));
        }
    }

    public function applyOne($actionId, $productId)
    {
        $this->product->where('id', '=', $productId)
            ->update($this->actionData($productId, $actionId));
    }

    protected function emptyData(){
        return array('action_id' => null, 'action_price' => 0);
    }

    protected function actionData($productId, $actionId) {

        $data['action_id'] = $actionId;
        $data['action_price'] = $this->actionPrice($actionId, $productId);
        return $data;
    }

    public function actionPrice($actionId, $productId){
        $product = $this->product->find($productId);
        $action = $this->model->find($actionId);

        $price = 0;

        if (!empty($action->percent)) {
            $price = $product->regular_price - $product->regular_price * $action->percent / 100;
        } elseif (!empty($action->static)) {
            $price = $product->regular_price - $action->static;
        }

        if ($price < 0) $price = 0;

        return roundPrice($price);
    }
}