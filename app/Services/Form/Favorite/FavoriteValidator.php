<?php
/**
 * Created by PhpStorm.
 * User: l2cri
 * Date: 08.04.16
 * Time: 13:55
 */

namespace App\Services\Form\Favorite;

use App\Services\Validation\AbstractLaravelValidator;

class FavoriteValidator extends AbstractLaravelValidator
{
    protected $rules = [
        'user_id' => 'required|numeric',
        'product_id' => 'required|numeric',
    ];

    protected $messages = array(
        'user_id.required' => 'Пользователь не указан.',
        'product_id.required' => 'Не указан товар',
    );
}