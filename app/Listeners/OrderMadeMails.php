<?php

namespace App\Listeners;

use App\Events\OrderMade;
use App\Repo\Order\OrderInterface;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderMadeMails
{
    protected $mailer;
    protected $repo;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Mailer $mailer, OrderInterface $orderInterface)
    {
        $this->mailer = $mailer;
        $this->repo = $orderInterface;
    }

    /**
     * Handle the event.
     *
     * @param  OrderMade  $event
     * @return void
     */
    public function handle(OrderMade $event)
    {
        $orders = array();
        foreach ($event->orders as $orderId){
            // вытащить заказ
            $orders[] = $this->repo->byId($orderId);
            // отправить письмо поставщику
            // добавить заказ в массив для письма
        }
    }
}
