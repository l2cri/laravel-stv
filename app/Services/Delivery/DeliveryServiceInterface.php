<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 31.05.16
 * Time: 15:16
 */

namespace App\Services\Delivery;


interface DeliveryServiceInterface
{
    public function getDeliveries($locationId, $sum, $deliverysum = 0, $paysum = 0, $weight, $volume, $zip = false);
}