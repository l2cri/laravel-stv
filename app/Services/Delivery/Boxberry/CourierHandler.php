<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 31.05.16
 * Time: 17:08
 */

namespace App\Services\Delivery\Boxberry;


use App\Services\Delivery\DeliveryHandlerInterface;
use App\Services\Delivery\Boxberry\Models\BoxberryCourierCities as BCities;
use App\Services\Delivery\Boxberry\Models\BoxberryCourierZips as BZips;

class CourierHandler extends AbstractHandler implements DeliveryHandlerInterface
{
    public function getDeliveryWays()
    {
        if ( empty($this->zip) || empty($this->locationId) ) return false;

        // есть locationId - посмотреть, есть ли связанный с этим location город (таблица боксберри)
        // если нет, return false;
        $bLocation = BCities::where('location_id', $this->locationId)->first();
        if (!$bLocation) return false;

        // проверяем в таблице индексов для доставки, есть ли такой индекс, нет - return false;
        $bZip = BZips::where('zip', $this->zip)->first();
        if (!$bZip) return false;

        $url = $this->url. '&method=DeliveryCosts'.
                            '&weight='.$this->weigth.
                            '&ordersum='.$this->sum.
                            '&deliverysum='.$this->deliverysum.
                            '&zip='.$this->zip.
                            '&paysum='.$this->paysum;

        $data = getJSONbyUrl($url);

        if ( !$data || isset($data[0]['err']) ) return false;

        $dWay = app('App\Services\Delivery\Boxberry\CourierWay', [ config('marketplace.boxberry_courier'),
                                                                    $data['price'],
                                                                    $data['delivery_period']
                                                                  ]);

        // возвращаем коллекцию
        return collect([$dWay]);
    }

}