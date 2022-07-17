<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\HRM\Entities\JobCircular;

class ShortListedApplicantMail extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var JobCircular
     */
    private $circular;
    private $admitCardId;

    /**
     * Create a new message instance.
     *
     * @param JobCircular $circular
     * @param $admitCardId
     */
    public function __construct(JobCircular $circular, $admitCardId)
    {
        $this->circular = $circular;
        $this->admitCardId = $admitCardId;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $circular = $this->circular;
        $link = route('job-admit-cards.admit-card', $this->admitCardId);
        return $this->view('emails.job-applicants.shortlisted-applicant',
            compact('circular', 'link'));
    }
}
