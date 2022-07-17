<?php
/**
 * Created by PhpStorm.
 * User: siaminflack
 * Date: 7/4/19
 * Time: 5:48 PM
 */

namespace Modules\HRM\Services\LeaveService;


use Carbon\Carbon;
use Modules\HRM\Entities\LeaveRequest;
use Modules\HRM\Services\LeaveRequestService;

class PeriodicYearLeaveCalculator implements LeaveCalculatorInterface
{
    private $leaveRequestService;
    private $leaveRequest;
    private $periodicYear;
    private $periodicYearLeaveDayLimit;
    private $leaveDayLimit;

    /**
     * YearlyLeaveCalculator constructor.
     * @param LeaveRequestService $leaveRequestService
     * @param LeaveRequest $leaveRequest
     * @param int $periodicYear
     * @param int $periodicYearLeaveDayLimit
     * @param int $leaveDayLimit
     */
    public function __construct(
        LeaveRequestService $leaveRequestService,
        LeaveRequest $leaveRequest,
        int $periodicYear,
        int $periodicYearLeaveDayLimit,
        int $leaveDayLimit
    ) {
        $this->leaveRequest = $leaveRequest;
        $this->periodicYear = $periodicYear;
        $this->periodicYearLeaveDayLimit = $periodicYearLeaveDayLimit;
        $this->leaveDayLimit = $leaveDayLimit;
        $this->leaveRequestService = $leaveRequestService;
    }

    public function getAvailableLeaveDays(): int
    {
        $leaveSpentInCurrentPeriod = $this->getLeaveSpentInCurrentPeriod();

        if ($leaveSpentInCurrentPeriod < $this->periodicYearLeaveDayLimit) {
            $remainingLeaveDays = $this->periodicYearLeaveDayLimit - $leaveSpentInCurrentPeriod;

            return ($remainingLeaveDays) > 0 ? ($remainingLeaveDays) : 0;
        } else {
            return 0;
        }
    }

    /**
     * @return array
     */
    public function getPeriodicalYearStartAndEnd()
    {
        $leaveStartDate = Carbon::parse($this->leaveRequest->start_date);

//        $periodicalFiscalYearStart = Carbon::createFromFormat('d M Y', "01 Jul {$leaveStartDate->format('Y')}");
        // NOTE:: The year range changed to Jan to Dec according to BARD authority
        $periodicalFiscalYearStart = Carbon::createFromFormat('d M Y', "01 Jan {$leaveStartDate->format('Y')}");
        $periodicalFiscalYearEnd = $periodicalFiscalYearStart->copy()->subDay()->addYears($this->periodicYear);

        if ($leaveStartDate->lessThan($periodicalFiscalYearStart)) {
            $periodicalFiscalYearStart->subYears($this->periodicYear);
            $periodicalFiscalYearEnd->subYears($this->periodicYear);
        }

        return [$periodicalFiscalYearStart, $periodicalFiscalYearEnd];
    }

    public function getLeaveConfig(): object
    {
        list($periodStart, $periodEnd) = $this->getPeriodicalYearStartAndEnd();

        $config = [
            'is_subtractable' => true,
            'periodic_year' => "$this->periodicYear ({$periodStart->format('Y')} - {$periodEnd->format('Y')})",
            'periodic_year_leave_limit' => $this->periodicYearLeaveDayLimit,
            'max_leave_duration_limit' => $this->leaveDayLimit,
        ];

        return (object)$config;
    }

    public function isValidRequest(): bool
    {
        $leaveStartDate = Carbon::parse($this->leaveRequest->start_date);
        $leaveEndDate = Carbon::parse($this->leaveRequest->end_date);

        list($periodStartDate, $periodEndDate) = $this->getPeriodicalYearStartAndEnd();

        if ($leaveStartDate->greaterThanOrEqualTo($periodStartDate) && $leaveEndDate->lessThanOrEqualTo($periodEndDate)) {
            return ($this->leaveRequest->duration <= $this->leaveDayLimit)
                && ($this->leaveRequest->duration <= $this->getAvailableLeaveDays());
        } else {
            return false;
        }
    }

    /**
     * @return mixed
     */
    private function getLeaveSpentInCurrentPeriod()
    {
        list($periodStartDate, $periodEndDate) = $this->getPeriodicalYearStartAndEnd();

        $leaveSpentInCurrentPeriod = LeaveRequest::where('requester_id', $this->leaveRequest->requester_id)
            ->where('leave_type_id', $this->leaveRequest->leave_type_id)
            ->where('status', 'approved')
            ->whereDate('start_date', '>=', $periodStartDate)
            ->whereDate('end_date', '<=', $periodEndDate)
            ->sum('duration');

        return $leaveSpentInCurrentPeriod;
    }
}
