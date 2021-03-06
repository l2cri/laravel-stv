<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 31.05.16
 * Time: 18:07
 */

namespace App\Services\Delivery\Boxberry;

use App\Services\Delivery\DeliveryHandlerInterface;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractHandler implements DeliveryHandlerInterface
{
    protected $model;
    protected $sort = 1;
    protected $locationId; // айди нашей локации, словать курьеской службы будет иметь отношение один к одному с нашими локациями,
                         // соответственно можно выбрать из словаря город по location_id
    protected $sum; // сумма заказа без доставки
    protected $deliverysum; // сумма доставки, объявленная клиенту
    protected $paysum; // сумма, сколько нужно взять с клиента, если ноль - видимо предоплаченный заказ
    protected $weigth; // вес
    protected $volume; // объем - по API boxberry здесь должны быть ширина, высота и глубина - подумать как это считать
                     // пока не будем задавать вообще, неизвестно какие будут коробки
    protected $zip;    // индекс города для курьерской доставки

    protected $url;

    public function __construct(Model $model, $locationId, $sum, $deliverysum = 0, $paysum = 0, $weight, $volume, $zip) {
        $this->model = $model;
        $this->locationId = $locationId;
        $this->sum = $sum;
        $this->deliverysum = $deliverysum;
        $this->paysum = $paysum;
        $this->weigth = $weight;
        $this->volume = $volume;
        $this->zip = $zip;

        $this->url = 'http://api.boxberry.de/json.php?token='.config('marketplace.boxberry_token');
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getSort()
    {
        return $this->sort;
    }

    public abstract function getDeliveryWays();
}