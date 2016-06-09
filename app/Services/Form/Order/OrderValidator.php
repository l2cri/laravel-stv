<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 15.02.16
 * Time: 18:15
 */

namespace App\Services\Form\Order;


use App\Services\Validation\AbstractLaravelValidator;

class OrderValidator extends AbstractLaravelValidator
{
    protected $rules = array(
        'person' => 'required|string',
        'phone' => 'required|string',
        'profile_id' => 'numeric',
        'address' => 'required|string',
        'delivery_id' => 'string',
        'payment_id' => 'numeric',
        'dataWays' => 'array',

        // TODO:: добавить location_id, delivery_id, delivery_price(hidden), payment_id
    );
}