<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 01.12.15
 * Time: 12:02
 */

namespace App\Facades;


use Illuminate\Support\Facades\Facade;

class AuthUser extends Facade
{
    protected static function getFacadeAccessor() { return 'auth.user'; }
}