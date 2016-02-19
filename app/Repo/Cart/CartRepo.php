<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 06.02.16
 * Time: 4:18
 */

namespace App\Repo\Cart;
use Cart;
use Illuminate\Database\Eloquent\Model;

class CartRepo implements CartInterface
{
    protected $model;

    public function __construct(Model $model) {
        $this->model = $model;
    }

    public function add($data)
    {
        // TODO: Implement add() method.
    }

    public function update($id, $data)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function save($items, $orderId = null, $userId = null)
    {
        foreach ($items as $item) {
            $data = array(
                'product_id' => $item->id,
                'order_id' => $orderId,
                'user_id' => $userId,
                'name' => $item->name,
                'price' => $item->price,
                'final_price' => $item->getPriceWithConditions(),
                'quantity' => $item->quantity,
                'subtotal' => $item->getPriceSum(),
                'total' => $item->getPriceSumWithConditions(),
                'attributes' => serialize($item->attributes->all())
            );

            if ( !$this->model->create($data)) throw new CartItemNotSavedException();
        }
    }

    public function all()
    {
        return Cart::getContent();
    }

    public function clear(){
        Cart::clear();
    }

}