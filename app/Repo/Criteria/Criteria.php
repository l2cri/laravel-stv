<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 29.01.16
 * Time: 17:20
 */

namespace App\Repo\Criteria;


abstract class Criteria
{
    public abstract function apply($model);
}