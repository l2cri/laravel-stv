<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 31.05.16
 * Time: 15:32
 */

namespace App\Services\Delivery;


use Illuminate\Database\Eloquent\Model;

class DeliveryService implements DeliveryServiceInterface
{
    /**
     * @var Model
     */
    private $model;

    public function __construct(Model $model){
        $this->model = $model;
        // можно здесь эту модель extend, добавить зависимости от таблиц боксберри
    }

    public function getDeliveries($locationId, $sum, $deliverysum = 0, $paysum = 0, $weight, $volume, $zip = false)
    {
        // достать из базы все обработчики
        $handlers = $this->getHandlers([
            $locationId, $sum, $deliverysum, $paysum, $weight, $volume, $zip
        ]);
        uasort($handlers, function($a, $b){
           /* @var $a \App\Services\Delivery\DeliveryHandlerInterface
            * @var $b \App\Services\Delivery\DeliveryHandlerInterface
            */
            if ($a->getSort() == $b->getSort()) return 0;
            return ($a->getSort() < $b->getSort()) ? -1 : 1;
        });
        return $handlers;
    }

    private function getHandlers(array $params){

        $handlers = array();
        array_unshift($params, false); // пустой элемент в начало массива, в него будем записывать модель

        $deliveries = $this->model->whereNotNull('type')->get();
        foreach ($deliveries as $delivery) {
            if ( isset($delivery->type) && !empty($delivery->type) ){
                $params[0] = $delivery;
                $handlers[] = app($delivery->type, $params);
            }
        }

        return $handlers;
    }

}