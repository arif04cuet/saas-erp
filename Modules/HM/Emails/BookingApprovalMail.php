<?php

namespace Modules\HM\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BookingApprovalMail extends Mailable
{
    use Queueable, SerializesModels;
    private $roomBooking;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data= null)
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
        $roomBooking = $this->roomBooking;

        if ($roomBooking->booking_type == 'physical_facility'){
            return $this->from('hostelmanager@bard.gov.bd', 'Hostel Manager')
                ->view('hm::emails.physical_facility_approval', compact('roomBooking'));
        }else{
            return $this->from('hostelmanager@bard.gov.bd', 'Hostel Manager')
                ->view('hm::emails.booking_approval', compact('roomBooking'));
        }
    }
}
