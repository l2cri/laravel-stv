<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 12.05.16
 * Time: 15:42
 */

namespace App\Services\Form\User;


use App\Services\Validation\AbstractLaravelValidator;

class UserValidator extends AbstractLaravelValidator
{
    protected $rules = array(
        'name' => 'required|string',
        'email' => 'required|email',
        'password' => 'required|confirmed|min:6',
    );
}