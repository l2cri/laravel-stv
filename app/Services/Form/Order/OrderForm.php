<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 15.02.16
 * Time: 18:14
 */

namespace App\Services\Form\Order;


use App\Exceptions\OrderNotCreatedException;
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
        $this->saveBySuppliers($bySuppliersArray, $profileId);

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
}