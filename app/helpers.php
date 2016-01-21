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

/*
 * возвращает символ для html деревьев
 */

function treeSymbol($q, $sign){

    if (empty($q)) return '';

    $str = '';
    for($i = 0; $i < $q; $i++){
        $str .= $sign;
    }
    return $str;
}

/*
 * почистить массив от пустых значений - для инпута
 */

function removeEmptyValues(array $array){

    return array_filter($array, function($v, $k) {

        if (is_array($v)) return count($v);
        return strlen(trim($v));
    }, ARRAY_FILTER_USE_BOTH);
}