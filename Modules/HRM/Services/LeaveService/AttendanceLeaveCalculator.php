<?php

/**
 * Created by PhpStorm.
 * User: siaminflack
 * Date: 7/4/19
 * Time: 4:22 PM
 */

namespace Modules\HRM\Services\LeaveService;


use App\Entities\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Arr;
use Modules\HRM\Constants\LeaveTypes;
use Modules\HRM\Entities\LeaveRequest;
use Modules\HRM\Services\EmployeeService;
use Modules\HRM\Services\LeaveRequestService;

class AttendanceLeaveCalculator implements LeaveCalculatorInterface
{
    private $employeeService;
    private $leaveRequestService;
    private $attendanceDivisor;
    private $startDate;
    private $requesterId;
    private $leaveTypeId;
    private $leaveRequest = null;

    /**
     * AttendanceLeaveCalculator constructor.
     * @param EmployeeService $employeeService
     * @param LeaveRequestService $leaveRequestService
     * @param string $startDate
     * @param int $requesterId
     * @param int $leaveTypeId
     * @param int $attendanceDivisor
     */
    public function __construct(
        EmployeeService $employeeService,
        LeaveRequestService $leaveRequestService,
        string $startDate,
        int $requesterId,
        int $leaveTypeId,
        int $attendanceDivisor
    ) {
        $this->employeeService = $employeeService;
        $this->leaveRequestService = $leaveRequestService;
        $this->attendanceDivisor = $attendanceDivisor;
        $this->startDate = $startDate;
        $this->requesterId = $requesterId;
        $this->leaveTypeId = $leaveTypeId;
    }

    public function getAvailableLeaveDays(): int
    {
        $leaveStartDate = Carbon::parse($this->startDate);

        $spentLeaves = $this->leaveRequestService->getSpentEarnedLeaves(
            $this->requesterId,
            $this->leaveTypeId
        );

        $user = User::findOrFail($this->requesterId);
        $attendance = $this->employeeService->getAttendanceWithLeave($user->employee, $leaveStartDate);

        $earnedLeaveCount = bcdiv($attendance, $this->attendanceDivisor, 2);
        $earnedLeaveCount = round($earnedLeaveCount, 2, PHP_ROUND_HALF_UP);

        $remainingLeaveDays = $earnedLeaveCount - $spentLeaves;


        return ($remainingLeaveDays) > 0 ? $remainingLeaveDays : 0;
    }

    public function setLeaveRequest(LeaveRequest $leaveRequest)
    {
        $this->leaveRequest = $leaveRequest;
    }

    public function getLeaveConfig(): object
    {
        $config = [
            'is_subtractable' => true,
            'attendanceDivisor' => $this->attendanceDivisor,
        ];

        if (!is_null($this->leaveRequest)) {
            list($leaveTypeName, $leavePurposeName) = $this->getLeaveTypeAndPurposeName();

            $config["purpose"] = $leavePurposeName;
            $config["max_leave_duration_limit"] = $this->getLeaveMaxDurationOnTypeAndPurpose(
                $leaveTypeName,
                $leavePurposeName
            );
        }

        return (object)$config;
    }

    public function isValidRequest(): bool
    {
        if (is_null($this->leaveRequest)) {
            throw new ModelNotFoundException('Leave Request must be set to check if leave can be approved');
        }

        list($leaveTypeName, $leavePurposeName) = $this->getLeaveTypeAndPurposeName();

        $maxLeaveDuration = $this->getLeaveMaxDurationOnTypeAndPurpose($leaveTypeName, $leavePurposeName);

        return ($this->leaveRequest->duration <= $this->getAvailableLeaveDays())
            && ($this->leaveRequest->duration <= $maxLeaveDuration);
    }

    /**
     * @param string $leaveTypeName
     * @param string $leavePurposeName
     * @return int
     */
    private function getLeaveMaxDurationOnTypeAndPurpose(string $leaveTypeName, string $leavePurposeName): int
    {
        $purposeMaxLeaveLimits = [
            LeaveTypes::AverageSalaryEarnedLeave => [
                'health' => 6 * 30, // month * days,
                'personal' => 4 * 30, // month * days
                'ex_bangladesh_leave' => PHP_INT_MAX,
            ],
            LeaveTypes::HalfAverageSalaryEarnedLeave => [
                'health' => 18 * 30, // month * days
                'personal' => 8 * 30, // month * days
            ]
        ];

        return $purposeMaxLeaveLimits[$leaveTypeName][$leavePurposeName];
    }

    /**
     * @return array
     */
    private function getLeaveTypeAndPurposeName(): array
    {
        $leaveTypeName = Arr::get($this->leaveRequest, 'type.name');
        $leavePurposeName = Arr::get($this->leaveRequest, 'purpose.name');
        return array($leaveTypeName, $leavePurposeName);
    }
}
