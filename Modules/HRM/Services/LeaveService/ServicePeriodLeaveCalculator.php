<?php
/**
 * Created by PhpStorm.
 * User: siaminflack
 * Date: 8/22/19
 * Time: 10:28 AM
 */

namespace Modules\HRM\Services\LeaveService;


use Modules\HRM\Entities\LeaveRequest;
use Modules\HRM\Services\LeaveRequestService;

class ServicePeriodLeaveCalculator implements LeaveCalculatorInterface
{
    private $leaveRequestService;
    private $leaveDayLimit;
    private $leaveCountLimit;
    private $leaveRequest;

    /**
     * ServicePeriodLeave constructor.
     * @param LeaveRequestService $leaveRequestService
     * @param LeaveRequest $leaveRequest
     * @param int $leaveDayLimit
     * @param int $leaveCountLimit
     */
    public function __construct(
        LeaveRequestService $leaveRequestService,
        LeaveRequest $leaveRequest,
        int $leaveDayLimit,
        int $leaveCountLimit
    )
    {
        $this->leaveRequestService = $leaveRequestService;
        $this->leaveDayLimit = $leaveDayLimit;
        $this->leaveCountLimit = $leaveCountLimit;
        $this->leaveRequest = $leaveRequest;
    }

    public function getAvailableLeaveDays(): int
    {
        $spentLeaveCount = $this->getSpentLeaveCount();

        return ($spentLeaveCount < $this->leaveCountLimit)
            ? $this->leaveDayLimit
            : 0;
    }

    public function getLeaveConfig(): object
    {
        $config = [
            'is_subtractable' => true,
            'service_period_leave_count_limit' => $this->leaveCountLimit,
            'spent_leave_count' => $this->getSpentLeaveCount(),
            'max_leave_duration_limit' => $this->leaveDayLimit,
        ];

        return (object)$config;
    }

    /**
     * @return int
     */
    private function getSpentLeaveCount(): int
    {
        return $spentLeaveCount = $this->leaveRequestService->findBy([
            'requester_id' => $this->leaveRequest->requester_id,
            'leave_type_id' => $this->leaveRequest->leave_type_id,
            'status' => 'approved'
        ])->count();
    }

    public function isValidRequest(): bool
    {
        return (($this->leaveRequest->duration <= $this->leaveDayLimit)
            && ($this->getSpentLeaveCount() < $this->leaveCountLimit));
    }
}