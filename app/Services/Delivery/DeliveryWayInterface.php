<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 01.06.16
 * Time: 15:23
 */

namespace App\Services\Delivery;

interface DeliveryWayInterface
{
    public function getName();
    public function getCost();
    public function getTime();
    public function getData();
}