<?php

namespace Modules\VMS\Console;

use Illuminate\Console\Command;
use Modules\VMS\Entities\Trip;
use Modules\VMS\Entities\Vehicle;
use Modules\VMS\Services\TripService;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ReleaseExpiredTripVehicles extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'release:vehicles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Release the vehicles, where trip end time has already expired!';
    protected $tripService;

    /**
     * Create a new command instance.
     *
     * @param TripService $tripService
     */
    public function __construct(TripService $tripService)
    {
        parent::__construct();
        $this->tripService = $tripService;
    }


    public function handle()
    {
        $vehicleStatus = Vehicle::getStatuses();
        $tripStatus = Trip::getStatuses();
        $trips = $this->tripService->getExpiredTripsNow();
        foreach ($trips as $trip) {
            // release the vehicles and update trip status
            $trip->vehicles()->update(['status' => $vehicleStatus['available']]);
            $this->tripService->update($trip, ['status' => $tripStatus['completed']]);
        }
    }
}
