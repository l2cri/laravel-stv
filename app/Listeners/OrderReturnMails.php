<?php

namespace App\Listeners;

use App\Repo\Order\OrderInterface;
use App\User;
use Illuminate\Contracts\Mail\Mailer;
use App\Events\OrderReturned;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderReturnMails
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
     * @param  OrderReturned  $event
     * @return void
     */
    public function handle(OrderReturned $event)
    {
        $order = $this->repo->byId($event->ordersId);
        $user = $this->userModel->find($event->userId);

        // отправить письмо поставщику
        $supplier = $order->supplier;
        $email = $supplier->user->email;

        $this->mailer->send('emails.order_return_supplier', compact('supplier', 'user', 'order'), function ($m) use ($email) {
            $m->from(config('marketplace.email'))
                ->to($email)
                ->subject(config('marketplace.emailOrderReturned'));
        });

        // отправить письмо пользователю
        $email = $user->email;

        $this->mailer->send('emails.order_return_user', compact('order', 'user', 'supplier'), function ($m) use ($email) {
            $m->from(config('marketplace.email'))
                ->to($email)
                ->subject(config('marketplace.emailOrderReturned'));
        });
    }
}
