<?php

namespace Modules\TMS\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CourseAdministrationsTraineeListEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $recipient;
    private $data;

    /**
     * CourseAdministrationsTraineeListEmail constructor.
     * @param $recipient
     * @param $data
     */
    public function __construct($recipient, $data)
    {
        $this->recipient = $recipient;
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('tms::emails.course.administration.trainee.list.notification')
            ->with([
                'recipient' => $this->recipient,
                'data' => $this->data
            ]);
    }
}
