<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class OrderStatusChanged extends Event
{
    use SerializesModels;

    public $ordersId;
    public $userId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($ordersId, $userId)
    {
        $this->userId = $userId;
        $this->ordersId = $ordersId;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
