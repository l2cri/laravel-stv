<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 14.03.16
 * Time: 18:29
 */

namespace App\Services\CartConditions;

use Darryldecode\Cart\Cart;
use Darryldecode\Cart\CartCondition;

class ActionConditionHandler extends AbstractConditionHandler
{
    protected $name = 'action';

    protected function _process($item, Cart $cart)
    {
        // если у товара есть акция и акционная цена
        $productId = $item->attributes->get('product_id') ? $item->attributes->get('product_id') : $item['id'];
        $product = $this->product->byId( $productId );

        if ( !empty($product->action_id) && !empty($product->action_price) ) {

            $cart->clearItemConditions($item->id);

            // регулярная цена - текущая цена - изменение в скидку записываем
            $discount = floatval($item->price - $product->action_price);

            $condition = new CartCondition(array(
                'name' => $this->name,
                'type' => $this->name,
                'target' => 'item',
                'value' => -$discount,
                'attributes' => array('name' => $product->action->name)
            ));

            $cart->addItemCondition($item->id, $condition);

            return true;
        }

        return false;
    }

}