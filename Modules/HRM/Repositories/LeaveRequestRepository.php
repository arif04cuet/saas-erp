<?php

/**
 * Created by PhpStorm.
 * User: siaminflack
 * Date: 6/24/19
 * Time: 5:29 PM
 */

namespace Modules\HRM\Repositories;


use App\Repositories\AbstractBaseRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Modules\HRM\Constants\LeaveTypes;
use Modules\HRM\Entities\Employee;
use Modules\HRM\Entities\LeaveRequest;
use Modules\HRM\Entities\LeaveType;

class LeaveRequestRepository extends AbstractBaseRepository
{
    protected $modelName = LeaveRequest::class;

    public function checkLeaveAlreadyExists($userId, $startDate, $endDate)
    {
        return $this->model->where('requester_id', $userId)
            ->whereDate('start_date', '<=', $startDate)
            ->whereDate('end_date', '>=', $endDate)
            ->count();
    }

    public function getConsumedLeaveByType($typeId, $requesterId = null, $start = 0, $end = null)
    {
        if (is_null($requesterId)) {
            $requesterId = Auth::user()->id;
        }
        if (is_null($end)) {
            $end = Carbon::parse()->format('Y-m-d');
        }
        // for casual and rest leave, we need to check some custom logic, lets separate these
        $casualLeaveType = $this->getCasualLeave();

        $restAndRecreationLeave = $this->getRestAndRecreationLeave();

        if (!is_null($casualLeaveType) && ($typeId == $casualLeaveType->id)) {
            return $this->getConsumedCasualLeave($casualLeaveType, $requesterId, $start, $end);
        }
        if (!is_null($restAndRecreationLeave) && ($typeId == $restAndRecreationLeave->id)) {
            return $this->getConsumedRestAndRecreationLeave($restAndRecreationLeave, $requesterId, $start, $end);
        }

        return $this->model->where('requester_id', $requesterId)
            ->where('leave_type_id', $typeId)
            ->where('status', 'approved')
            // ->whereDate('start_date', '>=', $start)
            // ->whereDate('end_date', '<=', $end)
            ->sum('duration');
    }

    public function getEmployeeExtraLeaveByType($typeId, $requesterId = null)
    {
        if (is_null($requesterId)) {
            $requesterId = Auth::user()->id;
        }

        return $this->model->where('requester_id', $requesterId)
            ->where('leave_type_id', $typeId)
            ->where('status', 'added')
            ->sum('duration');
    }

    public function getExtraLeaveByPurpose($typeId, $requesterId = null)
    {
        if (is_null($requesterId)) {
            $requesterId = Auth::user()->id;
        }

        return $this->model->where('requester_id', $requesterId)
            ->where('leave_type_purpose_id', $typeId)
            ->where('status', 'added')
            ->sum('duration');
    }

    public function getConsumedLeaveByPurpose($typeId, $requesterId = null, $start = 0, $end = null)
    {
        if (is_null($requesterId)) {
            $requesterId = Auth::user()->id;
        }
        if (is_null($end)) {
            $end = Carbon::parse()->format('Y-m-d');
        }

        return $this->model->where('requester_id', $requesterId)
            ->where('leave_type_purpose_id', $typeId)
            ->where('status', 'approved')
            ->whereDate('start_date', '>=', $start)
            ->whereDate('end_date', '<=', $end)
            ->sum('duration');
    }

    public function getConsumedCasualLeave(LeaveType $casualLeave, $requesterId = null, $start = 0, $end = null)
    {
        // we have to check if the user took the rest and recreational leave between his eligible years
        // if so, we then have to remove its amount from casual leave
        $consumedLeave = $this->model->where('requester_id', $requesterId)
            ->where('leave_type_id', $casualLeave->id)
            ->where('status', 'approved')
            ->whereDate('start_date', '>=', $start)
            ->whereDate('end_date', '<=', $end)
            ->sum('duration');

        $restAndRecreationLeaveFlag = $this->isEligibleForAnotherRestRecreationalLeave($requesterId);
        if (!$restAndRecreationLeaveFlag) {
            // that means he recently took this leave, so deduct the amount from consumed casual leave
            $consumedLeave = abs($consumedLeave - $casualLeave->amount);
        }
        return $consumedLeave;
    }

    public function getConsumedRestAndRecreationLeave(
        LeaveType $restAndRecreationLeave,
        $requesterId = null
    ): int {
        $eligibleForRestAndRecreationLeave = $this->isEligibleForAnotherRestRecreationalLeave($requesterId);
        if ($eligibleForRestAndRecreationLeave) {
            return 0;
        } else {
            return $restAndRecreationLeave->amount;
        }
    }

    /**
     * @param $requesterId
     * @return bool
     */
    public function isEligibleForAnotherRestRecreationalLeave($requesterId): bool
    {
        // user can only take this leave with the interval of 3 years

        $restAndRecreationLeave = $this->getRestAndRecreationLeave();

        $consumedRestLeave = $this->model->newQuery()
            ->where('requester_id', $requesterId)
            ->where('leave_type_id', $restAndRecreationLeave->id)
            ->where('status', 'approved')
            ->orderBy('created_at', 'desc')
            ->take(2)
            ->get();

        if (!$consumedRestLeave->count()) {
            return true;   // eligible
        } else {
            $leaveData = $consumedRestLeave->first();
            $startDate = Carbon::parse($leaveData->start_date);
            $endDate = Carbon::now();
            if ($endDate->diffInYears($startDate) < 3) {
                // the last leave he took was within 3 years so not eligible
                return false;
            } else {
                // he is eligible for another leave
                return true;
            }
        }
    }

    public function getRestRecreationRenewalDate(Employee $employee)
    {
        $jobJoiningDate = optional($employee->employeePersonalInfo)->job_joining_date;
        if (!is_null($jobJoiningDate)) {
            $jobJoiningDate = Carbon::parse($jobJoiningDate);
            $now = Carbon::now();
            $yearDiff = $now->diffInYears($jobJoiningDate);
            $floorValue = $yearDiff / 3; // periodic_year = 3
            $renewalDate = $jobJoiningDate->addYear($floorValue * 3);
            if ($renewalDate->isBefore($now)) {
                $renewalDate = $renewalDate->addYear(3);
            }
            return $renewalDate;
        }
        return null;
    }

    public function getUserLastLeave()
    {
        $user = Auth::user();

        return $this->model->where('requester_id', $user->id)->where('status', '!=', 'rejected')->first();
    }

    private function getCasualLeave()
    {
        return LeaveType::whereName(LeaveTypes::CasualLeave)->first();
    }

    private function getRestAndRecreationLeave()
    {
        return LeaveType::whereName(LeaveTypes::RestAndRecreationLeave)->first();
    }
}
