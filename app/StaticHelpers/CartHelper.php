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
            if ( array_key_exists('attributes', $arr) ) $arr = unserialize($arr['attributes']);

            if (array_key_exists('name', $arr)) {

                if (isset($condition->id)){
                    $conditions[$condition->id] = $arr['name'];
                } else $conditions[] = $arr['name'];
            }
        }

        return $conditions;
    }
}