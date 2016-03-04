<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 03.03.16
 * Time: 18:50
 */

namespace App\Services\Form\Profile;


use App\Services\Validation\AbstractLaravelValidator;

class ProfileValidator extends AbstractLaravelValidator
{
    protected $rules = array(
        'name' => 'required|string',
        'person' => 'required|string',
        'phone' => 'required|string',
        'profile_id' => 'numeric',
        'address' => 'required|string',

        // TODO:: добавить location_id, default(bool), company_id(for corporate)
    );
}