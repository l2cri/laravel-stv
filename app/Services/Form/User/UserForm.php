<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 12.05.16
 * Time: 15:43
 */

namespace App\Services\Form\User;


use App\Repo\User\UserInterface;
use App\Services\Form\FormTrait;
use App\Services\Validation\AbstractLaravelValidator;

class UserForm
{
    use FormTrait;

    protected $validator;
    protected $user;

    public function __construct(AbstractLaravelValidator $validator, UserInterface $user) {
        $this->validator = $validator;
        $this->user = $user;
    }

    public function update(array $input){

        $userId = userId();
        if (!empty($userId)){
            unset($input['_token']);

            if (isset($input['password']) && !empty($input['password'])){

                $input['password'] = bcrypt($input['password']);
                $input['password_confirmation'] = bcrypt($input['password_confirmation']);
            }

            if ( ! $this->valid($input) ) return false;

            unset($input['password_confirmation']);

            $this->user->update($input, $userId);
        }
        return false;
    }
}