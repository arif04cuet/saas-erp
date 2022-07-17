<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\TMS\Entities\TrainingCourseAdministration;

class NotifyCourseAdministration
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $trainingCourseAdministration;

    /**
     * Create a new event instance.
     * @param TrainingCourseAdministration $trainingCourseAdministration
     */
    public function __construct(TrainingCourseAdministration $trainingCourseAdministration)
    {
        $this->trainingCourseAdministration = $trainingCourseAdministration;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }

}
