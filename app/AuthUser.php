<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 01.12.15
 * Time: 12:05
 */

namespace App;

use Auth;

class AuthUser
{
    public function isAdmin(){

        $user = Auth::user();
        if ($user instanceof User) return $user->isAdmin();

        return false;
    }

    public function can($action) {
        $user = Auth::user();
        if ( !($user instanceof User) ) return false;

        $actions = array();
        foreach($user->roles as $role) {
            foreach($role->abilities as $ability){
                $actions[] = $ability->action;
            }
        }
        if (in_array($action, $actions)) return true;
        return false;
    }
}