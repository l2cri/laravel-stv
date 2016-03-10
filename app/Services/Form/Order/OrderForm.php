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
use App\Repo\Order\OrderInterface;
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

    public function __construct(ValidableInterface $validator, ProfileInterface $profile,
                                CartInterface $cart, OrderInterface $order) {
        $this->validator = $validator;
        $this->profile = $profile;
        $this->cart = $cart;
        $this->order = $order;
        $this->user = Auth::user();
    }

    public function create($input) {
        if ( ! $this->valid($input) ) return false;

        $profileId = $this->handleProfile($input);
        $bySuppliersArray = $this->devideBySuppliers();

        // если что-то пойдет не так, то бросит исключение
        $this->saveBySuppliers($bySuppliersArray, $profileId);

        // поэтому смело чистим корзину
        $this->cart->clear();

        return true;
    }

    protected function save($supplierId, $profileId, $cart){
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

        $order = $this->order->create($data);

        if ($order !== null) return $order->id;

        throw new OrderNotCreatedException();
    }

    protected function saveBySuppliers($arr, $profileId) {
        foreach ($arr as $supplierId => $cart) {
            $orderId = $this->save($supplierId, $profileId, $cart);
            $this->cart->save($cart, $orderId, $this->user->id);
        }
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
        $filtered = $collection->only(['person', 'phone', 'address']);
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

        $model = new CartItem();
        $cart = new OrderCart($data['orderId'], $model);

        foreach ($data['cartIds'] as $id => $qnt) {

            $cart->update($id, array(
                'quantity' => array(
                    'relative' => false, // чтобы не прибавляло или убавляло, а ставило жестко
                    'value' => $qnt
                ),
            ));

            // если кол-во ноль, то удаляем из корзины
            if ($qnt <= 0) {
                $model->destroy($id);
            } else {

                $item = $cart->get($id);

                $model->where('id', '=', $id)->update(array(
                    'final_price' => $item->getPriceWithConditions(),
                    'quantity' => $item->quantity,
                    'subtotal' => $item->getPriceSum(),
                    'total' => $item->getPriceSumWithConditions(),
                ));
            }
            // если нет, то обновляем cart_items
        }

        // пересчитываем и обновляем парметры заказа

        $this->order->update(array(
            'subtotal' => $cart->getSubTotal(),
            'total' => $cart->getTotal()
        ), $data['orderId']);

    }

    public function addOrderCart() {

    }

    protected function getOrderCart($orderId) {

    }
}