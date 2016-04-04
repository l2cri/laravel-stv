<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 25.03.16
 * Time: 18:46
 */

namespace App\Services\Form\Action;


use App\Services\Validation\AbstractLaravelValidator;

class ActionValidator extends AbstractLaravelValidator
{
    protected $rules = array(
        'name' => 'required|string',
        'description' => 'string',
        'start' => 'required|date',
        'end' => 'required|date',
//        'active' => 'boolean', не работает на checkbox
        'percent' => 'numeric',
        'static' => 'numeric'
    );
}