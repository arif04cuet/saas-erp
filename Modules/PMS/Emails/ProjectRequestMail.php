<?php

namespace Modules\PMS\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProjectRequestMail extends Mailable
{
    use Queueable, SerializesModels;
    private $projectRequest;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data = null)
    {
        $this->projectRequest = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('pms::emails.project_request')->with(['projectRequest' => $this->projectRequest]);
    }
}
