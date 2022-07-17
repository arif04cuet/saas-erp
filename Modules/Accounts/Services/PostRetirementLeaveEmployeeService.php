<?php

namespace Modules\Accounts\Services;

use App\Traits\CrudTrait;
use App\Utilities\DropDownDataFormatter;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Modules\Accounts\Repositories\PostRetirementLeaveEmployeeServiceRepository;
use Modules\HRM\Entities\Employee;
use Modules\HRM\Entities\LeaveRequest;
use Modules\HRM\Services\EmployeeService;
use Modules\HRM\Services\LeaveRequestService;

class PostRetirementLeaveEmployeeService
{
    use CrudTrait;
    private $employeeService;
    private $payscaleService;

    public function __construct(
        PostRetirementLeaveEmployeeServiceRepository $postRetirementLeaveEmployeeServiceRepository,
        EmployeeService $employeeService,
        PayscaleService $payscaleService
    ) {
        $this->setActionRepository($postRetirementLeaveEmployeeServiceRepository);
        $this->employeeService = $employeeService;
        $this->payscaleService = $payscaleService;
    }

    /**
     * <h3>Employee Dropdown</h3>
     * <p>Custom Implementation of concatenation</p>
     * @param Closure $implementedValue Anonymous Implementation of Value
     * @param Closure $implementedKey Anonymous Implementation Key index
     * @param array|null $query
     * @param bool $isEmptyOption
     * @return array
     */
    public function getRetiredEmployeesForDropdown(
        Closure $implementedValue = null,
        Closure $implementedKey = null,
        array $query = null,
        $isEmptyOption = false
    ) {
        $retiredEmployees = $query ? $this->actionRepository->findBy($query) : $this->actionRepository->findAll();

        return DropDownDataFormatter::getFormattedDataForDropdown(
            $retiredEmployees,
            $implementedKey ?: function ($retiredEmployee) {
                return $retiredEmployee->employee_id;
            },
            $implementedValue ?: function ($retiredEmployee) {
                return optional($retiredEmployee->employee)->getName() . ' - ' . optional($retiredEmployee->employee)->employee_id;
            },
            $isEmptyOption
        );
    }

    public function getPRLEmployee()
    {
        return $this->actionRepository->getModel()
            ->where('eligible_month', '>=', 0)
            ->where('total_amount', '>=', 0)->get();
    }

    /**
     * Create a PRL employee passing these parameters
     * @param Employee $employee
     * @param $startDate -- PRL Joining Date
     * @param $duration -- Overall PRL finishing Date
     * @throws \Exception  - If creation fails, exception gets thrown
     */
    public function createPrlEmployee(Employee $employee, $startDate, $duration)
    {
        $prlEmployeeData['employee_id'] = $employee->id;
        $contract = $employee->employeeContract;
        $basicSalary = $this->payscaleService->getBasicSalary($contract->salary_grade, $contract->increment) ?? 0;
        $prlEmployeeData['basic_salary'] = $basicSalary;
        // if duration is >12, eligible_month = duration - 12 , else 0
        // eligible month cant be greater than 18.
        $startDate = Carbon::createFromFormat('Y-m-d H:i:s', $startDate);
        // adding directly changes the instance value, better copy it
        $endDate = $startDate->copy()->addDays($duration);
        $duration = $startDate->diffInMonths($endDate);
        $duration = $duration > 12 ? $duration - 12 : 0;
        $duration = $duration > 18 ? 18 : $duration;
        $prlEmployeeData['start_date'] = $startDate;
        $prlEmployeeData['end_date'] = $endDate;
        $prlEmployeeData['eligible_month'] = $duration;
        if (!$this->actionRepository->save($prlEmployeeData)) {
            throw new \Exception('PRL Employee Creation Failed');
        }
    }

}

