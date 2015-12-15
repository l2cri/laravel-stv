<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 09.12.15
 * Time: 19:55
 */

/*
 * возвращает все возможные действия в системе
 */

function allActions(){
    $actions = array();
    $abilities = \App\Models\Ability::all();
    foreach ($abilities as $ability) {
        $actions[] = $ability->action;
    }
    return $actions;
}