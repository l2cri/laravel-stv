<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 28.11.15
 * Time: 0:12
 */

namespace App\Services\Validation;


class InfopageValidator extends AbstractLaravelValidator
{
    protected $rules = array(
        'name' => 'required',
        'code' => 'required'
    );

    protected $messages = array(
        'name' => 'Название страницы обязательно для заполнения',
        'code' => 'Код для URL обязателен для заполнения',
    );

}