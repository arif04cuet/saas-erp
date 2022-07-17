<?php

namespace App\Mail;

use App\Entities\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\TMS\Entities\Trainee;

class PublicUserRegistrationMail extends Mailable
{
    use Queueable, SerializesModels;
    private $user;

    /**
     * PublicUserRegistrationMail constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $userName = 'User Name';
        return $this->view('emails.user.registration')->with([
            'id' => $this->user->id,
            'userName' => $userName
        ]);
    }
}
