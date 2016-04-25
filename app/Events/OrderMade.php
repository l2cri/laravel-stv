<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class OrderMade extends Event
{
    use SerializesModels;

    public $orders;
    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(array $orders)
    {
        $this->orders = $orders;
    }
}
