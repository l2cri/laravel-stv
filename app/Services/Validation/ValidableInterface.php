<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 27.11.15
 * Time: 23:56
 */

namespace App\Services\Validation;


interface ValidableInterface
{
    /**
     * данные для валидации
     *
     * @param array
     * @return \App\Services\Validation\ValidableInterface
     */
    public function with(array $input);

    /**
     * Проходит ли валидация
     *
     * @return boolean
     */
    public function passes();

    /**
     * Ошибки валидации
     *
     * @return array
     */
    public function errors();
}

/*
 * Использование
 *
 *  if ( !$validator->with($input)->passes() ){
 *      return $validator->errors();
 *  }
 */