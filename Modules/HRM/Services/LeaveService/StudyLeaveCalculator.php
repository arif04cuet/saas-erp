<?php

/**
 * Created by PhpStorm.
 * User: siaminflack
 * Date: 8/22/19
 * Time: 5:12 PM
 */

namespace Modules\HRM\Services\LeaveService;


use Carbon\Carbon;
use Modules\HRM\Entities\LeaveRequest;
use Modules\HRM\Services\EmployeeService;

class StudyLeaveCalculator implements LeaveCalculatorInterface
{
    private $leaveRequest;
    private $employeeService;
    private $servicePeriodLeaveLimit = 28 * 30; // month * days
    private $maxLeaveDayLimit = 12 * 30; // month * days

    /**
     * StudyLeaveCalculator constructor.
     * @param LeaveRequest $leaveRequest
     * @param EmployeeService $employeeService
     */
    public function __construct(
        LeaveRequest $leaveRequest,
        EmployeeService $employeeService
    ) {
        $this->leaveRequest = $leaveRequest;
        $this->employeeService = $employeeService;
    }

    public function getAvailableLeaveDays(): int
    {
        // TODO: implement purpose based leave calculation

        $servicePeriod = $this->getLeaveRequesterServicePeriod();

        if ($servicePeriod <= 5) {
            abort(500, trans('error.service_period_less_than_five'));
        } elseif ($servicePeriod >= 22 && $servicePeriod <= 25) {
            abort(500, trans('error.service_period_greater_than_twentytwo'));
        } else {
            $spentLeaveDays = LeaveRequest::where('requester_id', $this->leaveRequest->requester_id)
                ->where('leave_type_id', $this->leaveRequest->leave_type_id)
                ->where('status', 'approved')
                ->sum('duration');

            $remainingLeaveDays = $this->servicePeriodLeaveLimit - $spentLeaveDays;

            return ($remainingLeaveDays) > 0 ? ($remainingLeaveDays) : 0;
        }
    }

    public function getLeaveConfig(): object
    {
        $config = [
            'is_subtractable' => true,
            'service_period_leave_limit' => $this->servicePeriodLeaveLimit,
            'max_leave_duration_limit' => $this->maxLeaveDayLimit,
        ];

        return (object) $config;
    }

    public function isValidRequest(): bool
    {
        return (($this->leaveRequest->duration <= $this->getAvailableLeaveDays())
            && ($this->leaveRequest->duration <= $this->maxLeaveDayLimit));
    }

    /**
     * @return int
     * @throws \Exception
     */
    private function getLeaveRequesterServicePeriod(): int
    {
        $joiningDate = $this->employeeService->getEmployeeJoiningDate($this->leaveRequest->requester->employee);

        $servicePeriod = Carbon::parse($this->leaveRequest->start_date)->diffInYears($joiningDate);

        return $servicePeriod;
    }
}
