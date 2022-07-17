<?php

namespace Modules\HM\Console;

use Illuminate\Console\Command;
use Modules\HM\Entities\BookingCheckin;
use Modules\HM\Entities\BookingGuestInfo;
use Modules\HM\Entities\BookingRequestForward;
use Modules\HM\Entities\BookingRoomInfo;
use Modules\HM\Entities\CheckinDetail;
use Modules\HM\Entities\CheckinPayment;
use Modules\HM\Entities\CheckinRoom;
use Modules\HM\Entities\CheckinTrainee;
use Modules\HM\Entities\Room;
use Modules\HM\Entities\RoomBooking;
use Modules\HM\Entities\RoomBookingRequester;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ResetHostelBookingCheckinData extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'reset:hm-booking-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset Hostel RoomBooking,Checkin, Payment Related Information';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // booking request data
        RoomBooking::truncate();
        RoomBookingRequester::truncate();
        RoomBookingRequester::truncate();
        // checkin related data
        BookingCheckin::truncate();
        BookingGuestInfo::truncate();
        BookingRequestForward::truncate();
        BookingRoomInfo::truncate();
        // room assignment and payment
        CheckinDetail::truncate();
        CheckinPayment::truncate();
        CheckinRoom::truncate();
        CheckinTrainee::truncate();
        // Make All room Status Available
        Room::query()->update(['status' => 'available']);
    }
}
