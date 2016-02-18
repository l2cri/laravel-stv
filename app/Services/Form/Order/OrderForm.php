<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 15.02.16
 * Time: 18:14
 */

namespace App\Services\Form\Order;


use App\Repo\Cart\CartInterface;
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

    public function __construct(ValidableInterface $validator, ProfileInterface $profile, CartInterface $cart) {
        $this->validator = $validator;
        $this->profile = $profile;
        $this->cart = $cart;
    }

    public function create($input) {
        if ( ! $this->valid($input) ) return false;

        $profileId = $this->handleProfile($input);
        $bySuppliersArray = $this->devideBySuppliers();

        return true;
    }

    protected function devideBySuppliers(){
        $arr = array();
        dd($this->cart->all()); die();

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
            $arr['user_id'] = Auth::user()->id;
            $profile = $this->profile->create($arr);
            return $profile->id;
        }
    }
}