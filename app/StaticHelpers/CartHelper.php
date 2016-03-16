<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 16.03.16
 * Time: 15:48
 */

namespace App\StaticHelpers;


class CartHelper
{
    public static function getConditions($item){
        $conditions = array();
        foreach($item->conditions as $condition) {
            $arr = $condition->getAttributes();
            if (isset($arr['name'])) $conditions[] = $arr['name'];
        }

        return $conditions;
    }
}