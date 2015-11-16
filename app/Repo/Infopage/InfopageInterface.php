<?php

/**
 * Created by PhpStorm.
 * User: ley
 * Date: 16.11.15
 * Time: 20:53
 */

namespace App\Repo\Infopage;

interface InfopageInterface
{
    /**
     * Возвращает информационную страницу по коду в url
     *
     * @param $code код в url
     * @return object Object информационной страницы
     */
    public function byCode($code);
}