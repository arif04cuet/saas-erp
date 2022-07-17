<?php
/**
 * Created by PhpStorm.
 * User: siaminflack
 * Date: 8/22/19
 * Time: 2:54 PM
 */

namespace Modules\HRM\Services\LeaveService;


use Modules\HRM\Constants\LeaveTypes;
use Modules\HRM\Entities\LeaveRequest;

class LeaveNotDueLeaveCalculator implements LeaveCalculatorInterface
{
    private $leaveRequest;

    /**
     * LimitedPurposeLeaveCalculator constructor.
     * @param LeaveRequest $leaveRequest
     */
    public function __construct(LeaveRequest $leaveRequest)
    {
        $this->leaveRequest = $leaveRequest;
    }

    public function getAvailableLeaveDays(): int
    {
        if ($this->leaveRequest->purpose->name == 'others') {
            if ($this->hasNoEarnedLeave()) {
                return PHP_INT_MAX;
            } else {
                return 0;
            }
        } else {
            $leaveDayLimit = $this->getMaxLeaveDayLimit();

            $spentLeaveDays = $this->getSpentLeaveDays();

            $remainingLeaveDays = $leaveDayLimit - $spentLeaveDays;

            return ($remainingLeaveDays) > 0 ? $remainingLeaveDays : 0;
        }
    }

    public function getLeaveConfig(): object
    {
        $config = [
            'is_subtractable' => $this->leaveRequest->purpose->name == 'others' ? false : true,
            'purpose' => $this->leaveRequest->purpose->name,
        ];

        if ($this->leaveRequest->purpose->name == 'others') {
            $config['max_leave_duration_limit'] = $this->getMaxLeaveDayLimit();
            $config['has_earned_leave'] = !$this->hasNoEarnedLeave();
        } else {
            $config['service_period_leave_limit'] = $this->getMaxLeaveDayLimit();
        }

        return (object)$config;
    }

    /**
     * @return bool
     */
    private function hasNoEarnedLeave(): bool
    {
        $avgEarnedLeaveCalculator = app()->make(AttendanceLeaveCalculator::class, [
            'startDate' => $this->leaveRequest->start_date,
            'requesterId' => $this->leaveRequest->requester_id,
            'leaveTypeId' => 2,
            'attendanceDivisor' => LeaveTypes::AverageSalaryEarnedLeaveDivisor
        ]);

        $halfAvgEarnedLeaveCalculator = app()->make(AttendanceLeaveCalculator::class, [
            'startDate' => $this->leaveRequest->start_date,
            'requesterId' => $this->leaveRequest->requester_id,
            'leaveTypeId' => 3,
            'attendanceDivisor' => LeaveTypes::HalfAverageSalaryEarnedLeaveDivisor
        ]);

        $hasNoEarnedLeave = $avgEarnedLeaveCalculator->getAvailableLeaveDays() == 0
            && $halfAvgEarnedLeaveCalculator->getAvailableLeaveDays() == 0;

        return $hasNoEarnedLeave;
    }

    /**
     * @return float|int
     */
    private function getMaxLeaveDayLimit()
    {
        switch ($this->leaveRequest->purpose->name) {
            case 'health':
                return 12 * 30; // month * days
            case 'personal':
                return 3 * 30; // month * days
            case 'others':
                return PHP_INT_MAX;
        }
    }

    /**
     * @return mixed
     */
    private function getSpentLeaveDays()
    {
        return LeaveRequest::where('requester_id', $this->leaveRequest->requester_id)
            ->where('leave_type_id', $this->leaveRequest->leave_type_id)
            ->where('leave_type_purpose_id', $this->leaveRequest->leave_type_purpose_id)
            ->where('status', 'approved')
            ->sum('duration');
    }

    public function isValidRequest(): bool
    {
        return $this->leaveRequest->duration <= $this->getAvailableLeaveDays();
    }
}