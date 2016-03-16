<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 14.03.16
 * Time: 18:29
 */

namespace App\Services\CartConditions;

use App\Repo\Product\ProductInterface;
use App\Repo\Supplier\SupplierInterface;
use Darryldecode\Cart\Cart;
use Darryldecode\Cart\CartCondition;

/**
 * @property ProductInterface $product
 * @property SupplierInterface $supplier
 */
class WhosaleConditionHandler extends AbstractConditionHandler
{
    protected $name = 'whosale';

    protected function _process($item, Cart $cart)
    {
        // если оптовое условие ок
        if ($this->whosale($item, $cart)) {

            $cart->clearItemConditions($item->id);

            // текущая цена - оптовая цена - изменение в скидку записываем
            $discount = floatval($item->price - $item->attributes->get('whosale_price'));

            $condition = new CartCondition(array(
                'name' => $this->name,
                'type' => $this->name,
                'target' => 'item',
                'value' => -$discount,
                'attributes' => array('name' => 'Оптовая цена')
            ));

            $cart->addItemCondition($item->id, $condition);
        }

        // добавляем условие в корзину
    }

    protected function whosale($item, Cart $cart){
        // если кол-во товара ок для оптовой цена - возвращем true
        if ( $this->quantity( $cart->get($item['id']) ) ) return true;

        // если товаров поставщика в корзине ок для оптовой цены - возвращаем true
        if ($this->order_sum($cart->get($item['id']), $cart)) return true;

        return false;
    }

    protected function quantity($item){

        $product = $this->product->byId($item['id']);
        if ($product->whosale_quantity <= $item->quantity) return true;

        return false;
    }

    protected function order_sum($currentItem, $cart){

        // текущий поставщик
        $supplierId = $currentItem->attributes->get('supplier_id');

        // ищем все товары текущего поставщика в коллекции
        $filtered = $cart->getContent()->filter(function ($item) use ($supplierId) {
            if ($item->attributes->get('supplier_id') == $supplierId) return true;
        });

        // сумма заказа для текущего поставщика, если товары все будут по оптовой цене
        $whosale_current_sum = 0;
        foreach ($filtered->all() as $item) {
            $whosale_current_sum += floatval($item->attributes->get('whosale_price') * $item->quantity);
        }

        $supplier = $this->supplier->byId($supplierId);

        $whosale_order = $this->supplier->byId($supplierId)->whosale_order;

        // если текущая сумма заказа для данного поставщика по оптовым ценам больше или равна той, что в настройках, то тру
        if($whosale_current_sum >= $this->supplier->byId($supplierId)->whosale_order) return true;

        return false;
    }

}