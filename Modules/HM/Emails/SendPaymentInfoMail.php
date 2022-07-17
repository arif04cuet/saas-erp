<?php

    namespace Modules\HM\Emails;

    use Illuminate\Bus\Queueable;
    use Illuminate\Mail\Mailable;
    use Illuminate\Queue\SerializesModels;
    use Illuminate\Contracts\Queue\ShouldQueue;
    use Modules\HM\Services\CheckinService;

    class SendPaymentInfoMail extends Mailable
    {
        use Queueable, SerializesModels;

        /**
         * Create a new message instance.
         *
         * @return void
         */
        private $roomBooking;
        private $checkinPayment;
        private $paidAmount;
        private $paymentType;
        private $duration;
        private $grandTotal;

        public function __construct($roomBooking = null, $paidAmount = null, $paymentType = null, $duration = 1)
        {
            $this->roomBooking = $roomBooking;
            $this->paidAmount = $paidAmount;
            $this->paymentType = $paymentType;
            $this->duration = $duration;
            $totalAmount = $roomBooking->roomInfos->sum(
                    function ($roomInfo) {
                        return $roomInfo->rate * $roomInfo->quantity;
                    }) * $duration;
            $vatTax = $totalAmount * (20/100);
            $this->grandTotal = $totalAmount + $vatTax;
        }

        /**
         * Build the message.
         *
         * @return $this
         */
        public function build()
        {
            return $this->view('hm::emails.booking_payment_info')->with(
                [
                    'roomBooking' => $this->roomBooking,
                    'paidAmount' => $this->paidAmount,
                    'paymentType' => $this->paymentType,
                    'duration' => $this->duration,
                    'grandTotal' => $this->grandTotal
                ]);

        }
    }
