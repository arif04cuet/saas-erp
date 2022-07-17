<?php

namespace Modules\HRM\Services;

use App\Traits\CrudTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Modules\HRM\Constants\LeaveTypes;
use Modules\HRM\Entities\LeaveType;
use Modules\HRM\Services\LeaveService\AttendanceLeaveCalculator;
use Modules\HRM\Services\LeaveService\PeriodicYearLeaveCalculator;
use Modules\HRM\Repositories\LeaveTypeRepository;

class LeaveCalculationService
{
    public $leaveTypeService;
    public $leaveRequestService;

    private $consumedLeavesByTypes;

    /**
     * LeaveCalculationService constructor.
     * @param LeaveTypeService $leaveTypeService
     * @param LeaveRequestService $leaveRequestService
     */
    public function __construct(
        LeaveTypeService $leaveTypeService,
        LeaveRequestService $leaveRequestService,
        LeaveTypeRepository $leaveTypeRepository
    ) {
        $this->leaveTypeService = $leaveTypeService;
        $this->leaveRequestService = $leaveRequestService;
        $this->leaveTypeRepository = $leaveTypeRepository;
    }

    public function getLeaveBalanceByType($typeId, $requesterId = null, $startDate = null)
    {
        $leaveType = $this->leaveTypeService->findOne($typeId);

        if (is_null($requesterId)) {
            $requesterId = Auth::user()->id;
        }
        if (is_null($startDate)) {
            $startDate = Carbon::parse()->format('Y-m-d');
        }


        switch ($leaveType->name) {
            case LeaveTypes::CasualLeave:
                $data = [
                    'periodic_year' => 1,
                    'year_day_limit' => $leaveType->amount,
                    'leave_day_limit' => $leaveType->maximum_allowed_days,
                ];
                return $this->getBalanceForPeriodicLeaveYear($typeId, $data, $requesterId, $startDate);
            case LeaveTypes::RestAndRecreationLeave:
                $data = [
                    'periodic_year' => 3,
                    'year_day_limit' => $leaveType->amount,
                    'leave_day_limit' => $leaveType->maximum_allowed_days,
                ];
                return $this->getBalanceForPeriodicLeaveYear($typeId, $data, $requesterId, $startDate);
            default:
                $data = [
                    'year_day_limit' => $leaveType->amount,
                ];
                return $this->getBalanceForRegularLeave($typeId, $data, $requesterId, $startDate);
        }
    }

    /**
     * @param $typeId
     * @param $data
     * @param null $requesterId
     * @param null $startDate
     * @return array
     */
    public function getBalanceForPeriodicLeaveYear($typeId, $data, $requesterId = null, $startDate = null)
    {
        $periodicCalculator = app()->make(PeriodicYearLeaveCalculator::class, [
            'periodicYear' => $data['periodic_year'],
            'periodicYearLeaveDayLimit' => $data['year_day_limit'],
            'leaveDayLimit' => $data['leave_day_limit'],
        ]);
        list($start, $end) = $periodicCalculator->getPeriodicalYearStartAndEnd();
        $calculateConsumed = $this->leaveRequestService->getConsumedLeave($typeId, $requesterId, $start, $end);

        return [$calculateConsumed, ($data['year_day_limit'] - $calculateConsumed)];
    }

    /**
     * @param $typeId
     * @param null $requesterId
     * @param null $startDate
     * @return array
     */
    public function getBalanceForRegularLeave($typeId, $data, $requesterId = null, $startDate = null)
    {
        $calculateConsumed = $this->leaveRequestService->getConsumedLeave($typeId, $requesterId, 0, $startDate);
        $attendanceDivisor =  $this->makeDynamicAttendanceDivisor($typeId);
        $calculateAvailable = app()->make(
            AttendanceLeaveCalculator::class,
            [
                'startDate' => $startDate,
                'requesterId' => $requesterId,
                'leaveTypeId' => $typeId,
                'attendanceDivisor' => $attendanceDivisor,
            ]
        );

        if ($attendanceDivisor == 1) {
            return [$calculateConsumed, ($data['year_day_limit'] - $calculateConsumed)];
        }
        return [$calculateConsumed, $calculateAvailable->getAvailableLeaveDays()];
    }

    public function makeDynamicAttendanceDivisor($typeId)
    {
        $type = $this->leaveTypeService->findOne($typeId);
        if ($type->name == "average_salary_earned_leave") {
            return 11;
        } elseif ($type->name == "half_average_salary_earned_leave") {
            return 12;
        } else {
            return 1;
        }
    }

    public function updateYearAndMaxDaysOfLeave(LeaveType $leaveType)
    {
        return $this->leaveTypeService->updateYearAndMaxDaysOfLeave($leaveType);
    }

    public function getLeavePurposeMaxDays(LeaveType $leaveType)
    {
        return $this->leaveTypeService->getLeavePurposeMaxDays($leaveType);
    }

    public function getAllTypes()
    {
        return $this->leaveTypeRepository->getAll();
    }

    public function getBalanceForEarnedLeaves($motherTypeId)
    {
        $types = $this->getAllTypes();
        $leaves = $this->getLeaveBalanceByType($motherTypeId);

        $totalEarnedLeaveBalance = $leaves[1];
        $consumed = 0;
        foreach ($types as  $type) {
            if ($type->mother_type_id == $motherTypeId) {
                $leaves = $this->getLeaveBalanceByType($type->id);
                $consumed += $leaves[0];
            }
        }
        return $totalEarnedLeaveBalance - $consumed;
    }
}
