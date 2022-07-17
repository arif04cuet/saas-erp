<?php

namespace Modules\VMS\Services;

use App\Traits\CrudTrait;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Modules\HRM\Entities\Employee;
use Modules\VMS\Entities\TripLimit;
use Modules\VMS\Repositories\TripLimitRepository;
use Modules\VMS\Repositories\TripRepository;

class TripLimitService
{
    use CrudTrait;

    private $tripLimitService;

    /**
     * @var TripRepository
     */
    private $tripRepository;

    public function __construct(TripLimitRepository $tripLimitRepository, TripRepository $tripRepository)
    {
        $this->setActionRepository($tripLimitRepository);
        $this->tripRepository = $tripRepository;
    }

    public function setSessionValues(TripLimit $tripLimit)
    {
        session(['_old_input.designation_id' => $tripLimit->designation_id]);
        session(['_old_input.limit' => $tripLimit->limit]);
    }

    public function clearSessionValues()
    {
        if (Session::has('_old_input.designation_id')) {
            Session::forget('_old_input.designation_id');
        }
        if (Session::has('_old_input.limit')) {
            Session::forget('_old_input.limit');
        }
    }

    /**
     * We check if the user crossed its limits
     * if there is no limit set for a designation, we assume it has not crossed limits
     * @param Employee $employee
     * @return bool
     */
    public function hasRequesterCrossedTripLimits(Employee $employee): bool
    {
        $crossedLimits = false;
        $maxLimit = $this->getRequesterMaxTripLimits($employee);
        if (is_null($maxLimit)) {
            return $crossedLimits;
        }
        $recentMonthTrips = $this->tripRepository->getRecentTripsOfRequester($employee->id);
        $userTrips = $recentMonthTrips->count();
        if ($userTrips >= $maxLimit) {
            $crossedLimits = true;
        }
        return $crossedLimits;
    }

    public function getRequesterMaxTripLimits(Employee $employee)
    {
        $user = $employee->user;
        if (is_null($user)) {
            return null;
        }
        $userDesignation = get_user_designation($user);
        if (is_null($userDesignation)) {
            return null;
        }
        $tripLimit = $this->findBy(['designation_id' => $userDesignation->id])->first();

        if (is_null($tripLimit)) {
            return null;
        }
        return $tripLimit->limit;
    }
}

