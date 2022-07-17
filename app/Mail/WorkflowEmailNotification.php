<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class WorkflowEmailNotification extends Mailable
{
    use Queueable, SerializesModels;

    private $title;
    private $message;
    private $url;

    /**
     * Create a new message instance.
     *
     * @param $title
     * @param $message
     * @param $url
     */
    public function __construct($title, $message, $url)
    {
        $this->_title = $title;
        $this->message = $message;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject($this->title)
            ->markdown('emails.workflow.notification_email')
            ->with([
                'title' => $this->title,
                'message' => $this->message,
                'url' => $this->url
            ]);
    }
}
