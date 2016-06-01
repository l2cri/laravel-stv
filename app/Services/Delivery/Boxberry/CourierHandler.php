<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 31.05.16
 * Time: 17:08
 */

namespace App\Services\Delivery\Boxberry;


use App\Services\Delivery\DeliveryHandlerInterface;

class CourierHandler extends AbstractHandler implements DeliveryHandlerInterface
{
    public function getDeliveryWays()
    {
        $deliveryWays = array();

        if ( empty($this->zip) || empty($this->locationId) ) return false;

        // есть locationId - посмотреть, есть ли связанный с этим location город (таблица боксберри)
        // если нет, return false;

        // проверяем в таблице индексов для доставки, есть ли такой индекс, нет - return false;

        // делаем запрос на доставку и создаем/сеттим CourierWay
        // записыаем его в массив
        // возвращаем массив


    }

}