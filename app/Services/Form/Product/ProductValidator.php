<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 21.01.16
 * Time: 2:22
 */

namespace App\Services\Form\Product;


use \App\Services\Validation\AbstractLaravelValidator;

class ProductValidator extends AbstractLaravelValidator
{
    protected $rules = array(

        'active' => 'boolean',
        'name' => 'required|string',
        'articul' => 'string',
        'barcode' => 'string',
        'section_ids' => 'required|array',
        'price' => 'required|numeric',
        'whosale_price' => 'required_with:whosale_quantity|numeric',
        'whosale_quantity' => 'required_with:whosale_price|numeric',
        'preview' => 'string',
        'description' => 'string',

        'parent_id' => 'exists:sections,id', // айди родительской категории должен быть в таблице sections
        // обязательно поле - строка
        'description' => 'string', // необязательное поле - текст
    );

    protected $messages = array(
        'whosale_price.required_with' => 'Оптовая цена должна быть указана вместе с минимальным количеством товара, доступным для покупки оптом.',
        'whosale_quantity.required_with' => 'Оптовая цена должна быть указана вместе с минимальным количеством товара, доступным для покупки оптом.',
    );
}