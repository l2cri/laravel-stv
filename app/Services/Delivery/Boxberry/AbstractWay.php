<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 01.06.16
 * Time: 15:28
 */

namespace App\Services\Delivery\Boxberry;


use App\Services\Delivery\DeliveryWayInterface;

abstract class AbstractWay implements DeliveryWayInterface
{
    private $name;
    private $cost;
    private $time;
    private $data;

    public function __construct() {
        // пока не понятно, что сюда задавать
    }

    public function getName()
    {
        return $this->name;
    }

    public function getCost()
    {
        return $this->cost;
    }

    public function getTime()
    {
        return $this->time;
    }

    public function getData()
    {
        return $this->data;
    }

}