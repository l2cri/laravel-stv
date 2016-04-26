<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class OrderMade extends Event
{
    use SerializesModels;

    public $ordersIds;
    public $userId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(array $ordersIds, $userId)
    {
        $this->userId = $userId;
        $this->ordersIds = $ordersIds;
    }
}
