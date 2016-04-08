<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 08.04.16
 * Time: 19:26
 */

namespace App\Services\Form\Supplier;


use App\Services\Validation\AbstractLaravelValidator;

class SupplierValidator extends AbstractLaravelValidator
{
    protected $rules = array(
        'user_id' => 'exists:users,id', // айди родительской категории должен быть в таблице sections
        'name' => 'required|string', // обязательно поле - строка
        'code' => 'required|string', // обязательно поле - строка
        'description' => 'string', // необязательное поле - текст
        'conditions' => 'string', // необязательное поле - текст
        'responsibility' => 'string', // необязательное поле - текст
        'whosale_order' => 'numeric',
        'whosale_quantity' => 'numeric',
        'color' => 'string',
        'logo' => 'image'
    );
}