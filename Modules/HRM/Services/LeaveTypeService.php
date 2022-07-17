<?php

/**
 * Created by PhpStorm.
 * User: siaminflack
 * Date: 6/24/19
 * Time: 3:44 PM
 */

namespace Modules\HRM\Services;


use App\Traits\CrudTrait;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Modules\HRM\Constants\LeaveTypes;
use Modules\HRM\Entities\LeaveRequest;
use Modules\HRM\Entities\LeaveType;
use Modules\HRM\Entities\LeaveTypePurpose;
use Modules\HRM\Repositories\LeaveTypeRepository;
use Modules\HRM\Services\LeaveService\LeaveCalculatorFactory;

class LeaveTypeService
{
    use CrudTrait;

    /**
     * @var LeaveTypeRepository
     */
    private $leaveTypeRepository;
    /**
     * @var EmployeeService
     */
    private $employeeService;
    /**
     * @var LeaveRequestService
     */
    private $leaveRequestService;

    private const AGE_OF_RETIREMENT = 59;

    /**
     * EmployeeLeaveService constructor.
     * @param LeaveTypeRepository $leaveTypeRepository
     * @param EmployeeService $employeeService
     * @param LeaveRequestService $leaveRequestService
     */
    public function __construct(
        LeaveTypeRepository $leaveTypeRepository,
        EmployeeService $employeeService,
        LeaveRequestService $leaveRequestService
    ) {
        $this->leaveTypeRepository = $leaveTypeRepository;
        $this->setActionRepository($leaveTypeRepository);
        $this->employeeService = $employeeService;
        $this->leaveRequestService = $leaveRequestService;
    }

    public function getLeaveTypeOptions()
    {
        return $this->getLeaveTypes()->map(function ($leaveType) {
            return [
                'name' => trans('hrm::leave.' . $leaveType->name),
                'id' => $leaveType->id,
                'purposes' => $leaveType->purposes->map(function ($purpose) {
                    return [
                        'id' => $purpose->id,
                        'name' => trans("hrm::leave.$purpose->name")
                    ];
                })
            ];
        })
            ->values();
    }

    public function getLeaveTypes()
    {
        return $this->findAll()->whereNotIn('name', $this->exceptTypes())
            ->filter($this->isLeaf())
            ->filter($this->ignoreMaternityLeaveForMale())
            // ->filter($this->ignoreEarnedLeave())
            ->filter($this->ignorePostRetirementForNonRetiredEmp());
    }

    private function exceptTypes()
    {
        return [
            LeaveTypes::GovtLeave,
            LeaveTypes::PublicLeave,
            LeaveTypes::OptionalLeave,
            LeaveTypes::SpecialSickLeave,
            LeaveTypes::VacationDepartmentLeave,
            LeaveTypes::DepartmentLeave,
            LeaveTypes::CompulsoryLeave,
            LeaveTypes::WithoutPayLeave,
        ];
    }

    private function hasNoChild(LeaveType $leaveType)
    {
        if (is_null($leaveType)) {
            return false;
        }

        $leaveTypesChildren = $this->findBy(['parent_id' => $leaveType->id]);

        return ($leaveTypesChildren == null || ($leaveTypesChildren->isEmpty())) ? true : false;
    }

    /**
     * @return \Closure
     */
    private function isLeaf(): \Closure
    {
        return function ($leaveType) {
            if ($leaveType->name == LeaveTypes::PublicAndGovtLeave) {
                return true;
            }

            return (($leaveType->is_parent == false) ? true : ($this->hasNoChild($leaveType)));
        };
    }

    /**
     * @return \Closure
     */
    public function ignoreMaternityLeaveForMale(): \Closure
    {
        return function ($leaveType) {
            return !($leaveType->name == LeaveTypes::MaternityLeave && strtolower(Auth::user()->employee->gender) == 'male');
        };
    }

    /**
     * @return \Closure
     */
    public function ignoreEarnedLeave(): \Closure
    {
        return function ($leaveType) {
            return !($leaveType->name == LeaveTypes::AverageSalaryEarnedLeave || $leaveType->name == LeaveTypes::HalfAverageSalaryEarnedLeave);
        };
    }

    /**
     * @return \Closure
     */
    private function ignorePostRetirementForNonRetiredEmp(): \Closure
    {
        return function ($leaveType) {
            if ($leaveType->name == LeaveTypes::PostRetirementLeave) {
                return Arr::get(Auth::user(), 'employee.is_retired')
                    ? $leaveType
                    : ($this->checkAge() ? $leaveType : false);
            }

            return $leaveType;
        };
    }

    private function checkAge()
    {
        $birthDate = Arr::get(Auth::user(), 'employee.employeePersonalInfo.date_of_birth', null);

        if (is_null($birthDate)) {
            return false;
        } else {
            return Carbon::parse($birthDate)->age >= self::AGE_OF_RETIREMENT;
        }
    }

    public function updateLeaveType(array $data, $id)
    {
        // if leave type has purpose - we have to save the purpose data
        $leaveType = $this->findOne($id);
        if ($leaveType->purposes->count()) {
            $totalDays = 0;
            foreach ($data['purpose_data'] as $key => $value) {
                $totalDays += $value['amount'];
                $leaveTypePurpose = LeaveTypePurpose::find($key);
                $leaveTypePurpose->update($value);
            }

            $this->update($this->findOne($id), ['amount' =>  $totalDays]);

            return $leaveType;
        } else {
            return $this->update($this->findOne($id), $data);
        }
    }

    public function getRestAndRecreationalLeave()
    {
        return $this->actionRepository->getRestAndRecreationalLeave();
    }

    public function updateYearAndMaxDaysOfLeave(LeaveType $leaveType)
    {
        // if we have to update a leavetypes data, we can add a new case
        switch ($leaveType->name) {
            case LeaveTypes::CasualLeave:
                $leaveType = $this->updateYearandLeaveDay(
                    $leaveType,
                    $leaveType->amount ?? 20,
                    $leaveType->maximum_allowed_days ?? 10
                );
                return $leaveType;
            case LeaveTypes::RestAndRecreationLeave:
                $leaveType = $this->updateYearandLeaveDay(
                    $leaveType,
                    $leaveType->amount ?? 15,
                    $leaveType->maximum_allowed_days ?? 15
                );
                return $leaveType;
            default:
                return $leaveType;
        }
    }

    /**
     * Return all the max allowed days
     * @param LeaveType $leaveType
     * @return array
     */
    public function getLeavePurposeMaxDays(LeaveType $leaveType): array
    {
        $maxDays = [];
        foreach ($leaveType->purposes as $purpose) {
            $consumedLeave = $this->leaveRequestService->getConsumedLeaveByPurpose($purpose->id);
            $calculatePurposeLeave = $this->leaveRequestService->getExtraLeaveByPurpose($purpose->id);
            $maxDays[$purpose->id] = [
                'maximum_allowed_days' => $purpose->maximum_allowed_days ?? 0,
                'amount' => $purpose->amount + $calculatePurposeLeave - $consumedLeave
            ];
        }
        return $maxDays;
    }

    /**
     * -----------------------------------------------------------------------------------------------------------
     *                                              Private Methods
     * -----------------------------------------------------------------------------------------------------------
     */

    /**
     * @param LeaveType $leaveType
     * @param $yearDay
     * @param $maxLeaveDay
     */
    private function updateYearandLeaveDay(LeaveType $leaveType, $yearDay, $maxLeaveDay)
    {
        $data = [];
        $data['amount'] = !is_null($leaveType->amount) ? $leaveType->amount : $yearDay;
        $data['maximum_allowed_days'] = !is_null($leaveType->maximum_allowed_days) ? $leaveType->maximum_allowed_days : $maxLeaveDay;
        return $this->update($leaveType, $data);
    }

    public function removeEarnedLeave($types)
    {
        foreach ($types as $key => $type) {
            if ($type->name == LeaveTypes::AverageSalaryEarnedLeave || $type->name == LeaveTypes::HalfAverageSalaryEarnedLeave) {
                unset($types[$key]);
            }
        }
        return $types;
    }
}
