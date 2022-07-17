<?php


namespace Modules\VMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Modules\HRM\Entities\Employee;
use Modules\VMS\Entities\Trip;
use Modules\VMS\Entities\Vehicle;

class TripRepository extends AbstractBaseRepository
{
    protected $modelName = Trip::class;

    public function getTripsForBilling()
    {
        $status = Trip::getStatuses();
        $tripTypes = Trip::getTypes();
        return $this->getModel()->newQuery()
            ->where('status', '=', $status['completed'])
            ->where('type', '!=', $tripTypes['official'])
            ->get();
    }

    /**
     * @param array $data [contains project id]
     * @return Builder[]|Collection
     */
    public function getTripsByProjectId(array $data)
    {
        return $this->getModel()->newQuery()->whereIn('project_id', $data)->get();
    }

    /**
     * @param array $tripData [contains trip id]
     * @return mixed
     */
    public function getTripExpenseByProject(array $tripData)
    {
        return $this->tripBillPaymentRepository->getTripExpenseByProject($tripData);
    }

    /**
     * return recent trips made by the requester
     * @param $requesterId
     * @param bool $currentMonthsOnly
     */
    public function getRecentTripsOfRequester($requesterId, $currentMonthsOnly = true)
    {
        $recentTrips = null;
        $status = Trip::getStatuses();
        $currentMonthFirstDate = Carbon::now()->startOfMonth()->format('Y-m-d');
        $currentMonthLastDate = Carbon::now()->lastOfMonth()->format('Y-m-d');
        if ($currentMonthsOnly) {
            $recentTrips = $this->getModel()->newQuery()
                ->whereRequesterId($requesterId)
                ->whereBetween('start_date_time', [$currentMonthFirstDate, $currentMonthLastDate])
                ->whereNotIn('status', [$status['pending'], $status['rejected'], $status['cancelled']])
                ->get();
        } else {
            $recentTrips = $this->getModel()
                ->newQuery()
                ->whereRequesterId($requesterId)
                ->whereNotIn('status', [$status['pending'], $status['rejected'], $status['cancelled']])
                ->get();
        }
        return $recentTrips;
    }

    public function getCompletedTripOfEmployeeByMonth(Employee $employee, Carbon $date)
    {
        $status = Trip::getStatuses();
        $types = Trip::getTypes();
        $currentMonthFirstDate = $date->startOfMonth()->format('Y-m-d');
        $currentMonthLastDate = $date->lastOfMonth()->format('Y-m-d');
        return $this->getModel()->newQuery()
            ->whereRequesterId($employee->id)
            ->whereType($types['personal'])
            ->whereBetween('start_date_time', [$currentMonthFirstDate, $currentMonthLastDate])
            ->whereStatus($status['completed'])
            ->get();
    }

    public function getExpiredTrips(Carbon $threshHold)
    {
        $threshHold = $threshHold->format('Y-m-d H:i:s');
        return $this->getModel()->newQuery()
            ->whereBetween('end_date_time', '<', $threshHold)
            ->get();
    }

    public function getTripsFilteredForIndex(array $data)
    {
        $startDateTime = Carbon::parse($data['start_date_time'])->format('Y-m-d') ?? null;
        $endDateTime = Carbon::parse($data['end_date_time'])->format('Y-m-d') ?? null;
        $query = $this->getModel()->newQuery();
        return $query->where('start_date_time', '>=', $startDateTime)
            ->where('end_date_time', '<=', $endDateTime)
            ->get();
    }

    public function getOverlappedTripsForVehicle(Trip $sourceTrip, Vehicle $vehicle)
    {
        $startDateTime = $sourceTrip->start_date_time;
        $endDateTime = $sourceTrip->end_date_time;
        $tripStatus = Trip::getStatuses();
        return $vehicle->trips()
            ->whereStatus($tripStatus['approved'])
            ->where(function($query) use ($startDateTime, $endDateTime){
                $query->whereBetween('start_date_time', [$startDateTime,$endDateTime])
                    ->orWhereBetween('end_date_time', [$startDateTime,$endDateTime]);
            })
            ->get();
    }

}
