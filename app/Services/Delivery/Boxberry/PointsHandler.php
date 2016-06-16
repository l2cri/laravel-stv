<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 31.05.16
 * Time: 17:23
 */

namespace App\Services\Delivery\Boxberry;


use App\Services\Delivery\DeliveryHandlerInterface;
use App\Services\Delivery\Boxberry\Models\BoxberryPointsCities as BCities;
use App\Services\Delivery\Boxberry\Models\BoxberryPoints as BPoints;

class PointsHandler extends AbstractHandler implements DeliveryHandlerInterface
{
    protected $sort = 2;

    public function getDeliveryWays()
    {
        // коллекция способов доставки
        $ways = array();

        if ( empty($this->locationId) ) return false;

        /**
         * @var BCities $bLocation
         */
        $bLocation = BCities::where('location_id', $this->locationId)->first();
        if (!$bLocation) return false;

        // точки самовывоза для этого города
        $points = $bLocation->points;

        // считаем для первой точки, потому что цена и время одинаковые, только точки разные
        $url = $this->url. '&method=DeliveryCosts'.
            '&target='.$points[0]['code'].
            '&weight='.$this->weigth.
            '&ordersum='.$this->sum.
            '&deliverysum='.$this->deliverysum.
            '&paysum='.$this->paysum;

        $data = getJSONbyUrl($url);
        if ( !$data || isset($data[0]['err']) ) return false;

        foreach ($points as $point) {

            $name = $point['name'];
            $name .= (!empty($point['metro'])) ? ', м. '.$point['metro'] : '';

            $ways[] = app('App\Services\Delivery\Boxberry\PointsWay', [ 'Самовывоз '.$name,
                                                                        $data['price'],
                                                                        $data['delivery_period'],
                                                                        implode_assoc($point->toArray())
                                                                    ]);
        }

        if (!count($ways)) return false;
        return collect($ways);
    }
}