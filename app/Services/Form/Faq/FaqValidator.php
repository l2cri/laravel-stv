<?php
/**
 * Created by PhpStorm.
 * User: l2cri
 * Date: 05.04.16
 * Time: 18:02
 */

namespace App\Services\Form\Faq;


use App\Services\Validation\AbstractLaravelValidator;

class FaqValidator extends AbstractLaravelValidator
{
    protected $rules = [
        'user_id' => 'required|numeric',
        'question' => 'required|string',
        'product_id' => 'required',
    ];

    protected $messages = array(
        'user_id.required' => 'Пользователь не указан.',
        'question.required' => 'Не введен вопрос',
        'product_id.required' => 'Не указан товар',
    );
}