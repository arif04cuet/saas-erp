<?php
/**
 * Created by PhpStorm.
 * User: siaminflack
 * Date: 8/23/19
 * Time: 4:51 PM
 */

namespace Modules\HRM\Services\LeaveService;


use Modules\HRM\Entities\LeaveRequest;

class GeneralLeaveCalculator implements LeaveCalculatorInterface
{
    private $leaveDays;
    private $leaveRequest;

    /**
     * GeneralLeaveCalculator constructor.
     * @param int $leaveDays
     * @param LeaveRequest $leaveRequest
     */
    public function __construct(int $leaveDays, LeaveRequest $leaveRequest)
    {
        $this->leaveDays = $leaveDays;
        $this->leaveRequest = $leaveRequest;
    }

    public function getAvailableLeaveDays(): int
    {
        return $this->leaveDays;
    }

    public function getLeaveConfig(): object
    {
        return (object)[
            'is_subtractable' => false,
            'max_leave_duration_limit' => $this->leaveDays
        ];
    }

    public function isValidRequest(): bool
    {
        return $this->leaveRequest->duration <= $this->leaveDays;
    }
}