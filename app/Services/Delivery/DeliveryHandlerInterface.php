<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 31.05.16
 * Time: 16:51
 */

namespace App\Services\Delivery;


interface DeliveryHandlerInterface
{
    public function getModel();
    public function getSort();
    public function getDeliveryWays();
}