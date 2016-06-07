<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 06.02.16
 * Time: 4:18
 */

namespace App\Repo\Cart;
use App\Repo\RepoTrait;
use Cart;
use Illuminate\Database\Eloquent\Model;
use App\Extensions\OrderCart;
use App\Services\CartConditions\ActionConditionHandler;
use App\Services\CartConditions\WhosaleConditionHandler;

class CartRepo implements CartInterface
{
    use RepoTrait;

    protected $model;
    protected $conditionModel;
    protected $product;

    public function __construct(Model $model, Model $conditionModel, Model $product) {
        $this->app = app();
        $this->model = $model;
        $this->conditionModel = $conditionModel;
        $this->product = $product;
    }

    public function add($data)
    {
        // TODO: Implement add() method.
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

            if ( !$cartItem = $this->model->create($data)) throw new CartItemNotSavedException();

            foreach($item->conditions as $condition){
                $this->saveCondition($cartItem, $condition);
            }
        }
    }

    public function all($columns = array('*'))
    {
        return Cart::getContent();
    }

    public function clear(){
        Cart::clear();
    }

    public function updateOrderCart($data)
    {
        $cart = new OrderCart($data['orderId'], $this->model);

        foreach ($data['cartIds'] as $id => $qnt) {

            $cart->update($id, array(
                'quantity' => array(
                    'relative' => false, // чтобы не прибавляло или убавляло, а ставило жестко
                    'value' => $qnt
                ),
            ));

            $item = $cart->get($id);
            $this->cartConditions($item, $cart);

            $itemCart = $this->model->find($id);

            // если кол-во ноль, то удаляем из корзины
            if ($qnt <= 0) {
                $this->deleteConditions($itemCart);
                $itemCart->delete();
            } else {

                // обновить запись в корзине
                $this->model->where('id', '=', $id)->update(array(
                    'final_price' => $item->getPriceWithConditions(),
                    'quantity' => $item->quantity,
                    'subtotal' => $item->getPriceSum(),
                    'total' => $item->getPriceSumWithConditions(),
                ));

                // добавить condigions если их еще нет
                $this->saveIfNoConditions($item, $itemCart);

            }
            // если нет, то обновляем cart_items
        }

        return $cart;
    }

    public function addOrderCartItem($userId, $orderId, $data){

        $cart = new OrderCart($orderId, $this->model);

        // добавляем товар в корзину, для того, чтобы ее потом пересчитать и обновить сумму заказа
        $cart->add($data['id'], $data['name'], $data['price'], 1, $data['attributes']);

        $item = $cart->get($data['id']);
        $this->cartConditions($item, $cart);

        // сохраняем товар в корзине заказа
        $this->save( array( $item ), $orderId, $userId);

        return $cart;
    }

    public function cartConditions($items, $cart){
        $conditionWhosale = new WhosaleConditionHandler($this->app->make('App\Repo\Product\ProductInterface'), $this->app->make('App\Repo\Supplier\SupplierInterface'));
        $conditionAction = new ActionConditionHandler($this->app->make('App\Repo\Product\ProductInterface'), $this->app->make('App\Repo\Supplier\SupplierInterface'));
        $conditionWhosale->setNext($conditionAction);
        $conditionWhosale->process($items, $cart);
    }

    protected function saveIfNoConditions($item, $itemCart){
        foreach($item->conditions as $condition){
            $result = $this->model->where('id', '=', $itemCart->id)->whereHas('conditions', function($query) use ($condition){
                $query->where('name', '=', $condition->getName());
            })->get();

            if (!$result->count() > 0) $this->saveCondition($itemCart, $condition);
        }
    }

    protected function saveCondition($cartItem, $condition){
        $attr = serialize($condition->getAttributes());

        $cartItem->conditions()->create([
            'name' => $condition->getName(),
            'type' => $condition->getType(),
            'target' => $condition->getTarget(),
            'value' => $condition->getValue(),
            'attributes' => $attr
        ]);
    }

    // для удаления скидок при удалении товара из заказа
    protected function deleteConditions($cartItem){
        $cartItem->conditions()->delete();
    }

    // удалить скидку вручную
    public function deleteCondition($orderId, $conditionId, $userId){

        // вытащим сразу id связанного cart_item
        $condition = $this->conditionModel->find($conditionId);
        $cartItemId = $condition->conditionable->id;

        $this->conditionModel->destroy($conditionId);

        // инициализируем корзину товарами и скидками для пересчета заказа - для этого мы ее возвращаем
        $cart = new OrderCart($orderId, $this->model);
        $cart->getContent();

        // обновить cart_item запись в бд
        $item = $cart->get($cartItemId);
        $data = array(
            'final_price' => $item->getPriceWithConditions(),
            'subtotal' => $item->getPriceSum(),
            'total' => $item->getPriceSumWithConditions()
        );
        $this->update($data, $cartItemId);

        return $cart;
    }

    /**
     * @return вес в граммах
     */
    public function weight() {
        $weight = 0;

        $items = Cart::getContent();
        foreach ($items as $item) {
            $product = $this->product->find($item->id);
            $weight += $product->weight;
        }

        return $weight;
    }
}