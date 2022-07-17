<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Modules\TMS\Services\BookingVendorConfirmationService;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class RejectExpiredBookingRequest extends Command
{
    /**
     * @var BookingVendorConfirmationService
     */
    private $bookingVendorConfirmationService;
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'reject:expired-booking-request';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reject booking request that are not confirmed by the vendors (physical-facility-request)';

    /**
     * Create a new command instance.
     *
     * @param BookingVendorConfirmationService $bookingVendorConfirmationService
     */
    public function __construct(BookingVendorConfirmationService $bookingVendorConfirmationService)
    {
        parent::__construct();
        $this->bookingVendorConfirmationService = $bookingVendorConfirmationService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $deletedModels = $this->bookingVendorConfirmationService->rejectExpiredPhysicalFacilityBookingRequests();
        if ($deletedModels->count()) {
            $message = $deletedModels->count() . 'Pending Booking Requests Are Rejected !';
            Log::info($message);
            return $message;
        } else {
            $message = 'No Pending Booking Request is found !';
            Log::info($message);
            return $message;
        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [

        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
        ];
    }
}
