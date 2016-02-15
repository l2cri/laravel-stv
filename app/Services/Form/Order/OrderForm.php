<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 15.02.16
 * Time: 18:14
 */

namespace App\Services\Form\Order;


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

    public function __construct(ValidableInterface $validator, ProfileInterface $profile) {
        $this->validator = $validator;
        $this->profile = $profile;
    }

    public function create($input) {
        if ( ! $this->valid($input) ) return false;

        $profileId = $this->handleProfile($input);

        return true;
    }

    protected function handleProfile($input) {

        if ( isset($input['profile_id'])  && !empty($input['profile_id']) ) {
            if ($this->profile->update($input['profile_id'], $input) )
                return $input['profile_id'];

        } else {
            $input['user_id'] = Auth::user()->id;
            $profile = $this->profile->create($input);
            return $profile->id;
        }
    }
}