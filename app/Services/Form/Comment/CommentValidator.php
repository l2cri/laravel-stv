<?php
/**
 * Created by PhpStorm.
 * User: Unizoo5
 * Date: 25.03.2016
 * Time: 18:52
 */

namespace App\Services\Form\Comment;


use App\Services\Validation\AbstractLaravelValidator;

class CommentValidator extends AbstractLaravelValidator
{
    protected $rules = array(
        'user_id' => 'required', // айди родительской категории должен быть в таблице sections
        'text' => 'required|string', // обязательно поле - строка
    );

    protected $messages = array(
        'user_id.required' => 'Пользователь не указан.',
        'text.required' => 'Не введен текст'
    );
}