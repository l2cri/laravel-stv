<?php
/**
 * Created by PhpStorm.
 * User: ley
 * Date: 18.02.16
 * Time: 17:20
 */

namespace App\Repo\Order;

use App\Repo\RepoTrait;
use Illuminate\Database\Eloquent\Model;
use PDF;
use App;

class EloquentOrder implements OrderInterface
{
    use RepoTrait;

    protected $model;
    protected $modelStatus;
    protected $modelDelivery;
    protected $modelPayment;

    public function __construct(Model $model, Model $modelStatus, Model $modelDelivery, Model $modelPayment){
        $this->model = $model;
        $this->modelStatus = $modelStatus;
        $this->modelDelivery = $modelDelivery;
        $this->modelPayment = $modelPayment;
    }

    public function delete($id){
        $order = $this->model->find($id);

        foreach ($order->cartItems as $item){
            $item->conditions()->delete();
            $item->delete();
        }

        $order->conditions()->delete();
        $order->delete();
    }

    public function statuses()
    {
        return $this->modelStatus->all();
    }

    public function byWhereIn($field, array $array){
        return $this->model->whereIn($field, $array)->get();
    }

    public function deliveries(){
        return $this->modelDelivery->all();
    }

    public function payments(){
        return $this->modelPayment->all();
    }

    public function create(array $data) {

        // сохраняем данные доставки в отдельный массив
        $deliveryArr = $data['delivery'];
        unset($data['delivery']);
        $data['delivery_id'] = $deliveryArr['id'];

        // создаем заказ
        $order = $this->model->create($data);

        // сохранение доставки в виде Condition morph
        // сохраняем Condition
        $attr = serialize($deliveryArr);

        $order->conditions()->create([
            'name' => $deliveryArr['name'],
            'type' => 'delivery',
            'target' => 'order',
            'value' => $deliveryArr['price'],
            'attributes' => $attr
        ]);

//        $this->makeInvoice($order);

        return $order;
    }

    public function makeInvoice($order) {
        $html = view('panel.invoice')->render();

        $filename = $this->invoceFileNameWithPath($order);
        $pdf = PDF::load($html)->output();
        file_put_contents($filename, $pdf);

        return response()->download($filename);
    }

    public function invoceFileNameWithPath($order){
        $filename = md5($order->created_at).'_'.$order->id.'.pdf';
        $path = getMultiplePath(config('marketplace.invoices'), $filename, 2);
        return $path.'/'.$filename;
    }

    public function getInvoice($orderId)
    {
        $order = $this->model->find($orderId);
        $filename = $this->invoceFileNameWithPath($order);

        if (!file_exists($filename))
            return $this->makeInvoice($order);
        else return response()->download($filename);
    }


}