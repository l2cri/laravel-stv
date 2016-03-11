<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 09.03.16
 * Time: 18:26
 */

namespace App\Extensions;


use Darryldecode\Cart\Cart;
use App\Models\CartItem;
use Darryldecode\Cart\CartCollection;
use Darryldecode\Cart\CartConditionCollection;
use Darryldecode\Cart\ItemAttributeCollection;
use Darryldecode\Cart\Helpers\Helpers;
use Darryldecode\Cart\ItemCollection;

class OrderCart extends Cart
{
    protected $orderId;
    protected $items;
    protected $model;

    public function __construct($orderId, CartItem $model){
        $this->orderId = $orderId;
        $this->model = $model;
    }

    protected function save($cart)
    {
        //TODO сохранять корзину в cart_items
        // это значит делать update модели CartItem
        //$this->session->put($this->sessionKeyCartItems, $cart);
    }

    protected function saveConditions($conditions)
    {
        //TODO сохранять условия в таблицу - нужны для пересчетов при редактировании
        //$this->session->put($this->sessionKeyCartConditions, $conditions);
    }

    public function getConditions()
    {
        return new CartConditionCollection(array()); // TODO: доставать условия для этой корзины или заказа - разобраться
    }

    public function clearCartConditions()
    {
        // TODO: удалить условия для текущего заказа или айтема из таблицы условий
//        $this->session->put(
//            $this->sessionKeyCartConditions,
//            array()
//        );
    }

    public function getContent()
    {
        if (!($this->items instanceof CartCollection)) {

            $cartItems = array();

            $items = $this->model->where('order_id', '=', $this->orderId)->get()->all();
            foreach ($items as $item) {
                $cartItem = $this->validate(array(
                    'id' => $item->id,
                    'name' => $item->name,
                    'price' => Helpers::normalizePrice($item->price),
                    'quantity' => $item->quantity,
                    'attributes' => new ItemAttributeCollection(unserialize($item->attributes)),
                    'conditions' => new CartConditionCollection( array() ), // TODO: добавить условия из базы
                ));
                $cartItems[$item->id] = new ItemCollection($cartItem);
            }

            $this->items = new CartCollection( $cartItems );
        }

        return $this->items;
    }

    public function setContent($cart) {
        $this->items = $cart;
    }

    public function isEmpty()
    {
        return $this->items->isEmpty();
    }

    public function clear()
    {
        // на всякий случай заглушка
    }

    public function update($id, $data)
    {
        $cart = $this->getContent();

        $item = $cart->pull($id);

        foreach($data as $key => $value)
        {
            // if the key is currently "quantity" we will need to check if an arithmetic
            // symbol is present so we can decide if the update of quantity is being added
            // or being reduced.
            if( $key == 'quantity' )
            {
                // we will check if quantity value provided is array,
                // if it is, we will need to check if a key "relative" is set
                // and we will evaluate its value if true or false,
                // this tells us how to treat the quantity value if it should be updated
                // relatively to its current quantity value or just totally replace the value
                if( is_array($value) )
                {
                    if( isset($value['relative']) )
                    {
                        if( (bool) $value['relative'] )
                        {
                            $item = $this->updateQuantityRelative($item, $key, $value['value']);
                        }
                        else
                        {
                            $item = $this->updateQuantityNotRelative($item, $key, $value['value']);
                        }
                    }
                }
                else
                {
                    $item = $this->updateQuantityRelative($item, $key, $value);
                }
            }
            elseif( $key == 'attributes' )
            {
                $item[$key] = new ItemAttributeCollection($value);
            }
            else
            {
                $item[$key] = $value;
            }
        }

        $cart->put($id, $item);

        $this->setContent($cart);
    }

    public function add($id, $name = null, $price = null, $quantity = null, $attributes = array(), $conditions = array())
    {
        // if the first argument is an array,
        // we will need to call add again
        if( is_array($id) )
        {
            // the first argument is an array, now we will need to check if it is a multi dimensional
            // array, if so, we will iterate through each item and call add again
            if( Helpers::isMultiArray($id) )
            {
                foreach($id as $item)
                {
                    $this->add(
                        $item['id'],
                        $item['name'],
                        $item['price'],
                        $item['quantity'],
                        Helpers::issetAndHasValueOrAssignDefault($item['attributes'], array()),
                        Helpers::issetAndHasValueOrAssignDefault($item['conditions'], array())
                    );
                }
            }
            else
            {
                $this->add(
                    $id['id'],
                    $id['name'],
                    $id['price'],
                    $id['quantity'],
                    Helpers::issetAndHasValueOrAssignDefault($id['attributes'], array()),
                    Helpers::issetAndHasValueOrAssignDefault($id['conditions'], array())
                );
            }

            return $this;
        }

        // validate data
        $item = $this->validate(array(
            'id' => $id,
            'name' => $name,
            'price' => Helpers::normalizePrice($price),
            'quantity' => $quantity,
            'attributes' => new ItemAttributeCollection($attributes),
            'conditions' => $conditions,
        ));

        $cart = $this->getContent();

        $cart->put($id, new ItemCollection($item));

        $this->setContent($cart);

        return $this;
    }
}