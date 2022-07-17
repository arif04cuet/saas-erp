<?php

/**
 * Created by PhpStorm.
 * User: siaminflack
 * Date: 7/4/19
 * Time: 4:21 PM
 */

namespace Modules\HRM\Services\LeaveService;

use Modules\HRM\Constants\LeaveTypes;
use Modules\HRM\Entities\LeaveRequest;
use Modules\HRM\Entities\LeaveType;
use phpDocumentor\Reflection\Types\This;

class LeaveCalculatorFactory
{
    public static function makeCalculator(LeaveRequest $leaveRequest)
    {
        $parameters = ['leaveRequest' => $leaveRequest];
        $type = $leaveRequest->type;
        switch ($type->name) {
            case LeaveTypes::AverageSalaryEarnedLeave:
                return self::makeAttendanceLeaveCalculator(
                    $type,
                    $leaveRequest,
                    LeaveTypes::AverageSalaryEarnedLeaveDivisor
                );
            case LeaveTypes::HalfAverageSalaryEarnedLeave:
                return self::makeAttendanceLeaveCalculator(
                    $type,
                    $leaveRequest,
                    LeaveTypes::HalfAverageSalaryEarnedLeaveDivisor
                );
            case LeaveTypes::CasualLeave:
                return self::makePeriodicYearLeaveCalculator(
                    $leaveRequest,
                    1,
                    $type->amount ?? 20,
                    $type->maximum_allowed_days ?? 10
                );
            case LeaveTypes::RestAndRecreationLeave:
                return self::makePeriodicYearLeaveCalculator(
                    $leaveRequest,
                    3,
                    $type->amount ?? 15,
                    $type->maximum_allowed_days ?? 15
                );
            case LeaveTypes::MaternityLeave:
                $leaveDayLimit = $type->maximum_allowed_days ?? (6 * 30); // month * days
                return self::makeServicePeriodLeaveCalculator($leaveRequest, $leaveDayLimit, 2);
            case LeaveTypes::PostRetirementLeave:
                return app()->make(PostRetirementLeaveCalculator::class, $parameters);
            case LeaveTypes::NotDueLeave:
                return app()->make(LeaveNotDueLeaveCalculator::class, $parameters);
            case LeaveTypes::StudyLeave:
                return app()->make(StudyLeaveCalculator::class, $parameters);
            case LeaveTypes::ExtraordinaryLeave:
                return app()->make(ExtraordinaryLeaveCalculator::class, $parameters);
            case LeaveTypes::QuarantineLeave:
                $parameters['leaveDays'] = self::getLeaveDays($type, $leaveRequest);
                return app()->make(GeneralLeaveCalculator::class, $parameters);
            case LeaveTypes::PublicAndGovtLeave:
                $parameters['leaveDays'] = self::getLeaveDays($type, $leaveRequest);
                return app()->make(GeneralLeaveCalculator::class, $parameters);
            case LeaveTypes::SpecialDisabilityLeaveFullPay:
                $parameters['leaveDays'] = $type->maximum_allowed_days ?? (24 * 30); // month * days
                return app()->make(GeneralLeaveCalculator::class, $parameters);
            case LeaveTypes::SpecialDisabilityLeaveHalfPay:
                $parameters['leaveDays'] = $type->maximum_allowed_days ?? (24 * 30); // month * days
                return app()->make(GeneralLeaveCalculator::class, $parameters);
            case LeaveTypes::HospitalLeaveFullPay:
                $parameters['leaveDays'] = $type->maximum_allowed_days ?? (3 * 30); // month * days
                return app()->make(GeneralLeaveCalculator::class, $parameters);
            case LeaveTypes::HospitalLeaveHalfPay:
                $parameters['leaveDays'] = $type->maximum_allowed_days ?? (3 * 30); // month * days
                return app()->make(GeneralLeaveCalculator::class, $parameters);
            default:
                $parameters['leaveDays'] = 1;
                return app()->make(GeneralLeaveCalculator::class, $parameters);
        }
    }

    /**
     * @param LeaveType $leaveType
     * @param LeaveRequest $leaveRequest
     * @param int $attendanceDivisor
     * @return mixed
     */
    private static function makeAttendanceLeaveCalculator(
        LeaveType $leaveType,
        LeaveRequest $leaveRequest,
        int $attendanceDivisor
    ) {
        $calculator = app()->make(
            AttendanceLeaveCalculator::class,
            [
                'startDate' => $leaveRequest->start_date,
                'requesterId' => $leaveRequest->requester_id,
                'leaveTypeId' => $leaveType->id,
                'attendanceDivisor' => $attendanceDivisor,
            ]
        );

        $calculator->setLeaveRequest($leaveRequest);

        return $calculator;
    }

    /**
     * @param LeaveRequest $leaveRequest
     * @param $periodicYear
     * @param $periodicYearLeaveDayLimit
     * @param $leaveDayLimit
     * @return mixed
     */
    private static function makePeriodicYearLeaveCalculator(
        LeaveRequest $leaveRequest,
        $periodicYear,
        $periodicYearLeaveDayLimit,
        $leaveDayLimit
    ) {
        return app()->make(PeriodicYearLeaveCalculator::class, [
            'leaveRequest' => $leaveRequest,
            'periodicYear' => $periodicYear,
            'periodicYearLeaveDayLimit' => $periodicYearLeaveDayLimit,
            'leaveDayLimit' => $leaveDayLimit,
        ]);
    }

    /**
     * @param LeaveRequest $leaveRequest
     * @param int $leaveDayLimit
     * @param int $leaveCountLimit
     * @return mixed
     */
    private static function makeServicePeriodLeaveCalculator(
        LeaveRequest $leaveRequest,
        int $leaveDayLimit,
        int $leaveCountLimit
    ) {
        return app()->make(ServicePeriodLeaveCalculator::class, [
            'leaveRequest' => $leaveRequest,
            'leaveDayLimit' => $leaveDayLimit, // month * days
            'leaveCountLimit' => $leaveCountLimit
        ]);
    }

    /**
     * If leaveRequest has leave_type_purpose_id, get its max day
     * otherwise get the leave_type max day
     * @param LeaveType $leaveType
     * @param LeaveRequest $leaveRequest
     */
    private static function getLeaveDays(LeaveType $leaveType, LeaveRequest $leaveRequest)
    {
        if (isset($leaveRequest->leave_type_purpose_id) && !is_null($leaveRequest->leave_type_purpose_id)) {
            // that means user requested for a specific leave type
            $leaveTypePurpose = $leaveType->purposes()->find($leaveRequest->leave_type_purpose_id);
            return $leaveTypePurpose->maximum_allowed_days ?? 0;
        } else {
            return $leaveType->maximum_allowed_days ?? 0;
        }
    }
}
