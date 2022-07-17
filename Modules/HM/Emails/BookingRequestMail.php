<?php

namespace Modules\HM\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use phpDocumentor\Reflection\Types\Null_;

class BookingRequestMail extends Mailable
{
    use Queueable, SerializesModels;
    private $roomBooking ;


    public function __construct($data = null)
    {
        $this->roomBooking = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('hm::emails.booking_request_overview')->with(['roomBooking' => $this->roomBooking]);

//        return $this->markdown('hm::emails.test');

    }
}
