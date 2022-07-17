<?php
/**
 * Created by PhpStorm.
 * User: siaminflack
 * Date: 9/11/19
 * Time: 2:50 PM
 */

namespace Modules\HRM\Services\LeaveService;


use Illuminate\Support\Arr;
use Modules\HRM\Entities\LeaveRequest;
use Modules\HRM\Services\LeaveRequestService;

class PostRetirementLeaveCalculator extends ServicePeriodLeaveCalculator
{
    private $leaveRequest;
    /**
     * ServicePeriodLeave constructor.
     * @param LeaveRequestService $leaveRequestService
     * @param LeaveRequest $leaveRequest
     */
    public function __construct(LeaveRequestService $leaveRequestService, LeaveRequest $leaveRequest)
    {
        $leaveDayLimit = (12 * 30); // month * days
        $leaveCountLimit = 1; // once in whole service period

        $this->leaveRequest = $leaveRequest;

        parent::__construct($leaveRequestService, $this->leaveRequest, $leaveDayLimit, $leaveCountLimit);
    }

    private function hasRequesterRetired(): bool
    {
        return Arr::get($this->leaveRequest, 'requester.employee.is_retired')
            ? true
            : $this->checkAge(59);
    }

    public function getAvailableLeaveDays(): int
    {
        $isRetired = $this->hasRequesterRetired();

        return $isRetired ? parent::getAvailableLeaveDays() : 0;
    }

    public function getLeaveConfig(): object
    {
        $config = parent::getLeaveConfig();

        $config->is_retired = $this->hasRequesterRetired();

        return $config;
    }

    public function isValidRequest(): bool
    {
        return $this->hasRequesterRetired() ? parent::isValidRequest() : false;
    }

    private function checkAge($age)
    {
        $birthDate = Arr::get($this->leaveRequest, 'requester.employee.employeePersonalInfo.date_of_birth', null);

        if (is_null($birthDate)) {
            return false;
        } else {
            return Carbon::parse($birthDate)->age >= $age;
        }
    }
}
