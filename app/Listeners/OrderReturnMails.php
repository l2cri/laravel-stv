<?php

namespace App\Listeners;

use App\Events\OrderReturned;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderReturnMails
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OrderReturned  $event
     * @return void
     */
    public function handle(OrderReturned $event)
    {
        //
    }
}
