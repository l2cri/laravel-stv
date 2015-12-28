<?php
namespace App\Services\Form\Section;

/**
 * Created by PhpStorm.
 * User: ley
 * Date: 15.12.15
 * Time: 19:39
 */

use \App\Services\Validation\AbstractLaravelValidator;

class SectionValidator extends AbstractLaravelValidator
{
    protected $rules = array(
        'parent_id' => 'exists:sections,id', // айди родительской категории должен быть в таблице sections
        'name' => 'required|string', // обязательно поле - строка
        'description' => 'string', // необязательное поле - текст
    );

    protected $messages = array(
        'parent_id.exists' => 'Такой родительской категории не существует.',
    );
}