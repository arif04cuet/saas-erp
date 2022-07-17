<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class JobApplicantMail extends Mailable
{
    use Queueable, SerializesModels;

    private $applicant;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($applicant)
    {
        $this->applicant = $applicant;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $name = $this->applicant->applicant_name;
        $applicantId = $this->applicant->applicant_id;
        return $this->view('emails.job-applicants.applicant', compact('name', 'applicantId'));
    }
}
