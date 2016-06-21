<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 15.02.16
 * Time: 18:14
 */

namespace App\Services\Form\Order;

use App\Exceptions\OrderNotCreatedException;
use App\Extensions\OrderCart;
use App\Models\CartItem;
use App\Repo\Cart\CartInterface;
use App\Repo\Message\MessageInterface;
use App\Repo\Order\OrderInterface;
use App\Repo\Product\ProductInterface;
use App\Repo\Profile\ProfileInterface;
use App\Services\Form\FormTrait;
use App\Services\Validation\ValidableInterface;
use Auth;

class OrderForm
{
    use FormTrait; // валидации и возврат ошибок

    protected $order;
    protected $validator;
    protected $profile;
    protected $cart;
    protected $user;
    protected $product;
    protected $message;

    public function __construct(ValidableInterface $validator, ProfileInterface $profile,
                                CartInterface $cart, OrderInterface $order, ProductInterface $product,
                                MessageInterface $message) {
        $this->validator = $validator;
        $this->profile = $profile;
        $this->cart = $cart;
        $this->order = $order;
        $this->user = Auth::user();
        $this->product = $product;
        $this->message = $message;
    }

    public function create($input) {
        if ( ! $this->valid($input) ) return false;

        $profileId = $this->handleProfile($input);
        $bySuppliersArray = $this->devideBySuppliers();

        $deliveryArr = $this->getDeliveryArray($input);

        // если что-то пойдет не так, то бросит исключение
        $orders = $this->saveBySuppliers($bySuppliersArray, $profileId, $deliveryArr);

        // поэтому смело чистим корзину
        $this->cart->clear();

        return $orders;
    }

    public function update($input){
        $id = $input['orderId'];

        $order = $this->order->byId($id);
        if ($order->status_id !== $input['orderstatus'] ) {
            $changed = true;
        } else $changed = false;

        $data = array(
            'innercomment' => $input['innercomment'],
            'status_id' => $input['orderstatus']);
        $this->order->update($data, $id);

        return $changed;
    }

    protected function save($supplierId, $profileId, $cart, $deliveryArr){
        $subtotal = 0;
        $total = 0;

        foreach($cart as $item) {
            $subtotal += $item->getPriceSum();
            $total += $item->getPriceSumWithConditions();
        }

        $data = array(
            'user_id' => $this->user->id,
            'supplier_id' => $supplierId,
            'profile_id' => $profileId,
            'subtotal' => $subtotal,
            'total' => $total
        );

        // добавляем доставку
        $data['delivery'] = $deliveryArr;

        $order = $this->order->create($data);

        if ($order !== null) return $order->id;

        throw new OrderNotCreatedException();
    }

    public function saveUserMessage($input) {
        $input['user_id'] = userId();
        $input['user_saw'] = true;
        $this->message->create($input);
    }

    public function saveSupplierMessage($input) {
        $input['user_id'] = userId();
        $input['supplier_saw'] = true;
        $this->message->create($input);
    }

    protected function saveBySuppliers($arr, $profileId, $deliveryArr) {

        $orders = array();

        // цену доставки делим на разные заказы
        $supplierCount = count($arr);
        $deliveryPrice = roundPrice($deliveryArr['price'] / $supplierCount);
        $deliveryArr['price'] = $deliveryPrice;

        foreach ($arr as $supplierId => $cart) {
            $orderId = $this->save($supplierId, $profileId, $cart, $deliveryArr);
            $this->cart->save($cart, $orderId, $this->user->id);
            $orders[] = $orderId;
        }

        return $orders;
    }

    protected function devideBySuppliers(){

        $arr = array();
        $items = $this->cart->all();

        foreach ($items as $item){
            $supplierId = $item->attributes->supplier_id;
            $arr[$supplierId][] = $item;
        }

        return $arr;
    }

    protected function handleProfile($input) {

        $collection = collect($input);
        $filtered = $collection->only(['person', 'phone', 'address', 'location_id']);
        $arr = $filtered->all();

        if ( isset($input['profile_id'])  && !empty($input['profile_id']) ) {
            if ($this->profile->update($arr, $input['profile_id']) )
                return $input['profile_id'];

        } else {
            $arr['user_id'] = $this->user->id;
            $profile = $this->profile->create($arr);
            return $profile->id;
        }
    }

    public function updateOrderCart($data) {

        $cart = $this->cart->updateOrderCart($data); //new OrderCart($data['orderId'], $model);

        // пересчитываем и обновляем парметры заказа
        $this->updateOrderAfterCartUpdate($cart, $data['orderId']);
    }

    public function addOrderCartItem($input) {

        $product = $this->product->byId($input['productId']);
        $attributes = array( 'unit' => $product->unit,
            'file' => $product->photos[0]->file,
            'section_url' => $product->sections[0]->url,
            'section_name' => $product->sections[0]->name,
            'supplier_name' => $product->supplier->name,
            'supplier_id' => $product->supplier->id,
            'whosale_price' => $product-> whosale_price
        );
        $data = array(
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'attributes' => $attributes
        );

        $cart = $this->cart->addOrderCartItem($this->user->id, $input['orderId'], $data);
        $this->updateOrderAfterCartUpdate($cart, $input['orderId']);
    }

    public function deleteOrderCartItem($input){
        $data = array(
            'orderId' => $input['orderId'],
            'cartIds' => array($input['itemId'] => 0)
        );
        $cart = $this->cart->updateOrderCart($data);
        $this->updateOrderAfterCartUpdate($cart, $data['orderId']);
    }

    protected function updateOrderAfterCartUpdate($cart, $orderId) {
        $this->order->update(array(
            'subtotal' => $cart->getSubTotal(),
            'total' => $cart->getTotal()
        ), $orderId);
    }

    public function deleteCondition($orderId, $conditionId){
        $cart = $this->cart->deleteCondition($orderId, $conditionId, $this->user->id);
        $this->updateOrderAfterCartUpdate($cart, $orderId);
    }

    public function returnOrder($orderId){
        $this->order->update(['returned' => true], $orderId);
    }

    /**
     * все что связано с доставкой
     * @return array массив вида delivery_id для заказа и data для создания condition на заказ
     */
    private function getDeliveryArray($input) {

        if (!isset($input['delivery_id'])){
            return ['id' => config('marketplace.nodelivery_id'), 'price' => 0, 'data' => '', 'name' => ''];
        }

        $deliveryArr = explode('_', $input['delivery_id']);
        $deliveryId = $deliveryArr[0];
        $dataWays = $input['dataWays'];

//        var_dump($dataWays); die();

        $deliveryData = unserialize( base64_decode($dataWays[$deliveryArr[1]]) );
        $deliveryPrice = $deliveryData[1];

        return ['id' => $deliveryId, 'price' => $deliveryPrice, 'data' => $deliveryData, 'name' => $deliveryData[0]];
    }
}