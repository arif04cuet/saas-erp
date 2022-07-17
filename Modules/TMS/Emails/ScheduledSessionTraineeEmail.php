<?php

namespace Modules\TMS\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\TMS\Entities\Trainee;

class ScheduledSessionTraineeEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $trainee;
    private $data;

    /**
     * ScheduledSessionTraineeEmail constructor.
     * @param Trainee $trainee
     * @param array $data
     */
    public function __construct(Trainee $trainee, $data = [])
    {
        $this->trainee = $trainee;
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('tms::emails.session.schedule.trainee.notification')
            ->with([
                'trainee' => $this->trainee,
                'data' => $this->data
            ]);
    }
}
