<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendCourseAdministrator extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $employee, $training;

    public function __construct($employee, $training)
    {
        $this->employee = $employee;
        $this->training = $training;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('tms::training.course.administration.partial.email-template')
            ->with([
                'employee' => $this->employee,
                'training' => $this->training
            ]);
    }
}
