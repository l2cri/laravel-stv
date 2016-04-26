<?php

namespace App\Listeners;

use App\Repo\Order\OrderInterface;
use App\User;
use Illuminate\Contracts\Mail\Mailer;
use App\Events\OrderStatusChanged;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderStatusChangeMail
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
     * @param  OrderStatusChanged  $event
     * @return void
     */
    public function handle(OrderStatusChanged $event)
    {
        $order = $this->repo->byId($event->ordersId);
        $user = $this->userModel->find($event->userId);
        $supplier = $order->supplier;

        // отправить письмо пользователю
        $email = $user->email;
        $subject = config('marketplace.emailOrderStatusChanged')." ".$order->status->name;

        $this->mailer->send('emails.order_status_change', compact('order', 'user', 'supplier'), function ($m) use ($email, $subject) {
            $m->from(config('marketplace.email'))
                ->to($email)
                ->subject($subject);
        });
    }
}
