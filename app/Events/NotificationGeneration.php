<?php

namespace App\Events;

use App\Models\NotificationInfo;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotificationGeneration
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $notificationInfo;

    /**
     * Create a new event instance.
     *
     * @param NotificationInfo $notificationInfo
     */
    public function __construct(NotificationInfo $notificationInfo)
    {
        $this->notificationInfo = $notificationInfo;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
//    public function broadcastOn()
//    {
//        return new PrivateChannel('channel-name');
//    }
}
