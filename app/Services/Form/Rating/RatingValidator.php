<?php
/**
 * Created by PhpStorm.
 * User: l2cri
 * Date: 06.04.16
 * Time: 17:44
 */

namespace App\Services\Form\Rating;


use App\Services\Validation\AbstractLaravelValidator;

class RatingValidator extends AbstractLaravelValidator
{
    protected $rules = array(
        'rate' => 'required',
        'rateable_id' => 'required'
    );

    protected $messages = array(
        'rate.required' => 'Не передан рейтинг.',
        'rateable_id.required' => 'Нет объекта для рейтинга.',
    );
}