<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 31.05.16
 * Time: 17:23
 */

namespace App\Services\Delivery\Boxberry;


use App\Services\Delivery\DeliveryHandlerInterface;

class PointsHandler extends AbstractHandler implements DeliveryHandlerInterface
{
    private $sort = 2;

    public function getDeliveryWays()
    {
        // TODO: Implement getDeliveryWays() method.
    }
}