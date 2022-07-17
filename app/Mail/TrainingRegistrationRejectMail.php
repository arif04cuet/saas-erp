<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\TMS\Entities\Trainee;

class TrainingRegistrationRejectMail extends Mailable
{
    use Queueable, SerializesModels;
    private $trainee;

    /**
     * TrainingRegistrationApproveMail constructor.
     * @param Trainee $trainee
     */
    public function __construct(Trainee $trainee)
    {
        $this->trainee = $trainee;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $trainingTitle = $this->trainee->training->title;
        return $this->view('emails.training.registration-reject.php')->with([
            'trainee' => $this->trainee,
            'training_title' => $trainingTitle
        ]);
    }
}
