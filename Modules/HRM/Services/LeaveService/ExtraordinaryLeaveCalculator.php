<?php
/**
 * Created by PhpStorm.
 * User: siaminflack
 * Date: 8/23/19
 * Time: 4:30 PM
 */

namespace Modules\HRM\Services\LeaveService;


use Illuminate\Support\Arr;
use Modules\HRM\Entities\LeaveRequest;

class ExtraordinaryLeaveCalculator implements LeaveCalculatorInterface
{
    private $leaveRequest;

    /**
     * ExtraordinaryLeaveCalculator constructor.
     * @param LeaveRequest $leaveRequest
     */
    public function __construct(LeaveRequest $leaveRequest)
    {
        $this->leaveRequest = $leaveRequest;
    }

    public function getAvailableLeaveDays(): int
    {
        $leaveDays = $this->getLeaveDayLimit();

        if ($this->isSubtractable()) {
            $spentLeaveDays = LeaveRequest::where('leave_type_id', $this->leaveRequest->leave_type_id)
                ->where('requester_id', $this->leaveRequest->requester_id)
                ->where('leave_type_purpose_id', $this->leaveRequest->leave_type_purpose_id)
                ->where('status', 'approved')
                ->sum('duration');

            $remainingLeaveDays = $leaveDays - $spentLeaveDays;

            return ($remainingLeaveDays) > 0 ? $remainingLeaveDays : 0;
        } else {
            return $leaveDays;
        }
    }

    private function getPurposeMaximumAllowedDays()
    {
        return $this->leaveRequest->purpose->maximum_allowed_days ?? 0;
    }

    /**
     * @return float|int
     */
    private function getHealthLeaveDays()
    {
        if ($this->isPermanentEmployee()) {
            return $this->getPurposeMaximumAllowedDays();
        } else {
            return 3 * 30; // month * days
        }
    }

    /**
     * @return float|int
     */
    private function getPersonalLeaveDays()
    {
        if ($this->isPermanentEmployee()) {
            return $this->getPurposeMaximumAllowedDays();
        } else {
            return 12 * 30; // month * days
        }
    }

    private function getStudyLeaveDays()
    {
        if ($this->isPermanentEmployee()) {
            return $this->getPurposeMaximumAllowedDays();
        } else {
            return 24 * 30; // month * days
        }
    }

    public function getLeaveConfig(): object
    {
        $config = [
            'is_subtractable' => $this->isSubtractable(),
            'purpose' => $this->leaveRequest->purpose->name,
            'max_leave_duration_limit' => $this->getLeaveDayLimit()
        ];

        return (object)$config;
    }

    /**
     * @return bool
     */
    private function isSubtractable(): bool
    {
        if ($this->leaveRequest->purpose->name == 'health') {
            return false;
        } elseif ($this->leaveRequest->purpose->name == 'personal' &&  $this->isPermanentEmployee()) {
            return false;
        }

        return true;
    }

    /**
     * @return float|int
     */
    private function getLeaveDayLimit()
    {
        $leavePurpose = $this->leaveRequest->purpose->name;

        switch ($leavePurpose) {
            case 'health':
                return $this->getHealthLeaveDays();
            case 'personal':
                return $this->getPersonalLeaveDays();
            case 'study':
                return $this->getStudyLeaveDays(); // month * days
        }
    }

    /**
     * @return bool
     */
    private function isPermanentEmployee(): bool
    {
        $employeeServiceType = Arr::get($this->leaveRequest, 'requester.employee.status');

        return $employeeServiceType == 'permanent';
    }

    public function isValidRequest(): bool
    {
        return (($this->leaveRequest->duration <= $this->getAvailableLeaveDays())
            && ($this->leaveRequest->duration <= $this->getLeaveDayLimit()));
    }
}