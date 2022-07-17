<?php

namespace Modules\HRM\Events;

use Illuminate\Queue\SerializesModels;
use Modules\HRM\Entities\CalendarEvent;

class CalendarEventPosted
{
    use SerializesModels;
    /**
     * @var CalendarEvent
     */
    public $calendarEvent;

    /**
     * Create a new event instance.
     *
     * @param CalendarEvent $calendarEvent
     */
    public function __construct(CalendarEvent $calendarEvent)
    {
        $this->calendarEvent = $calendarEvent;
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
