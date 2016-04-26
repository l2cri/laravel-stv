<?php

namespace App\Listeners;

use App\Events\OrderMade;
use App\Repo\Order\OrderInterface;
use App\User;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderMadeMails
{
    protected $mailer;
    protected $repo;
    protected $userModel;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Mailer $mailer, OrderInterface $orderInterface, User $userModel)
    {
        $this->mailer = $mailer;
        $this->repo = $orderInterface;
        $this->userModel = $userModel;
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
        $user = $this->userModel->find($event->userId);

        foreach ($event->ordersIds as $orderId){

            // вытащить заказ
            $order = $this->repo->byId($orderId);

            // отправить письмо поставщику
            $supplier = $order->supplier;
            $email = $supplier->user->email;

            $this->mailer->send('emails.ordersupplier', compact('supplier', 'user', 'order'), function ($m) use ($email) {
                $m->from(config('marketplace.email'))
                    ->to($email)
                    ->subject(config('marketplace.emailOrderNew'));
            });

            // добавить заказ в массив для письма клиенту
            $orders[] = $order;
        }

        // отправить письмо пользователю
        $email = $user->email;

        $this->mailer->send('emails.orderuser', compact('orders', 'user'), function ($m) use ($email) {
            $m->from(config('marketplace.email'))
                ->to($email)
                ->subject(config('marketplace.emailOrderNew'));
        });
    }
}
