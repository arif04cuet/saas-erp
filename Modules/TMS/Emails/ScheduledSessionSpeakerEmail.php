<?php

namespace Modules\TMS\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\TMS\Entities\TrainingCourseResource;

class ScheduledSessionSpeakerEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $resource;
    private $data;

    /**
     * ScheduledSessionSpeakerEmail constructor.
     * @param TrainingCourseResource $resource
     * @param array $data
     */
    public function __construct(TrainingCourseResource $resource, $data = [])
    {
        $this->resource = $resource;
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('tms::emails.session.schedule.speaker.notification')
            ->with([
                'resource' => $this->resource,
                'data' => $this->data
            ]);
    }
}
