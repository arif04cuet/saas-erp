<?php

namespace Modules\Accounts\Services;

use App\Traits\CrudTrait;
use App\Utilities\DropDownDataFormatter;
use App\Utilities\EnToBnNumberConverter;
use App\Utilities\MonthNameConverter;
use Carbon\Carbon;
use Closure;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Modules\Accounts\Entities\EmployeeSalaryOutstanding;
use Modules\Accounts\Entities\Payslip;
use Modules\Accounts\Entities\PayslipDetail;
use Modules\Accounts\Entities\SalaryCategory;
use Modules\Accounts\Entities\SalaryRule;
use Modules\Accounts\Entities\SalaryStructure;
use Modules\Accounts\Repositories\PayslipRepository;
use Modules\HRM\Entities\Employee;
use Modules\HRM\Services\EmployeeService;

class PayslipService
{
    use CrudTrait;

    protected $payslipRepository;
    private $salaryRuleService;
    private $payslipDetailService;
    private $employeeService;
    private $gpfService;
    private $employeeSalaryOutstandingService;

    public function __construct(
        PayslipRepository $payslipRepository,
        SalaryRuleService $salaryRuleService,
        PayslipDetailService $payslipDetailService,
        EmployeeService $employeeService,
        GpfService $gpfService,
        EmployeeSalaryOutstandingService $employeeSalaryOutstandingService
    ) {
        $this->setActionRepository($payslipRepository);
        $this->payslipRepository = $payslipRepository;
        $this->salaryRuleService = $salaryRuleService;
        $this->payslipDetailService = $payslipDetailService;
        $this->employeeService = $employeeService;
        $this->gpfService = $gpfService;
        $this->employeeSalaryOutstandingService = $employeeSalaryOutstandingService;

    }

    /**
     * create payslip for an employee
     *
     * @param $data
     *
     * @return Model|void
     */
    public function createPayslip(array $data)
    {
        DB::beginTransaction();
        try {
            $employee = $this->getEmployee($data['employee_id']);
            $this->isPreviouslyCreated($data);
            $data = $this->modifyPayslipCreationData($data, $employee);
            $payslip = $this->save($data);
            $employeeStructure = $this->getEmployeeStructure($data, $payslip, $employee);
            if (!isset($employeeStructure)) {
                throw new Exception(trans('accounts::payroll.flash_messages.salary_structure_not_found',
                    ['name' => $employee->getName() ?? '']));
            }
            $salaryRules = $this->salaryRuleService->getAllRules($employeeStructure);
            $total = 0;
            $deduction = 0;
            $payslipData = [];
            foreach ($salaryRules as $salaryRule) {
                $payslipData['payslip_id'] = $payslip->id;
                $payslipData['salary_rule_id'] = $salaryRule->id;
                $payslipData['amount'] = $this->salaryRuleService->getGrandTotalAmount($employee, $salaryRule,
                    $payslip);
                if ($salaryRule->salaryCategory->name == SalaryCategory::SALARY_CATEGORY_DEDUCTION) {
                    $deduction += $payslipData['amount'];
                } else {
                    $total += $payslipData['amount'];
                }
                $payslipDetail = $this->payslipDetailService->save($payslipData);
                // check if there is any outstanding data
                $outstandingRuleData = $this->employeeSalaryOutstandingService->getOutstandingOfSalaryRule($payslip,
                    $salaryRule);
                if ($outstandingRuleData) {
                    $this->updatePayslipDetailAmount($outstandingRuleData, $payslipDetail, $payslipData['amount']);
                }
            }
            $total_amount = $total - $deduction;
            $payslip->update(['total_amount' => $total_amount]);
            DB::commit();
            Session::flash('success', trans('accounts::payroll.flash_messages.payslip_create'));
            return $payslip;
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage() . " traceback: " . $e->getTraceAsString());
            if (app()->environment() == "development") {
                Session::flash('error', $e->getMessage());
            } else {
                Session::flash('error', trans('labels.generic_error_message'));
            }
            return;
        }
    }

    private function getEmployeeSalaryStructure(Employee $employee)
    {
        return $this->employeeService->getEmployeeSalaryStructure($employee);
    }

    private function getEmployee($employee_id)
    {
        return $this->employeeService->findOne($employee_id);
    }

    public function getEmployeesWithoutPayslip($from = null, $to = null, $type, $bonusStructureId)
    {
        if ($type == Payslip::getTypes()[0]) {
            $employeeIdsWithPayslip = $this->payslipRepository->getEmployeeIds($from, $to);
            $uniqueEmployeeIdsWithPayslip = collect($employeeIdsWithPayslip)->unique()->toArray();
            return $this->employeeService->findAll()->whereNotIn('id', $uniqueEmployeeIdsWithPayslip);
        } else {
            $employeeIdsWithPayslip = $this->payslipRepository->getEmployeeIds($from, $to, $type);
            $uniqueEmployeeIdsWithPayslip = collect($employeeIdsWithPayslip)->unique();
            $uniqueEmployeeIdsWithPayslip = $uniqueEmployeeIdsWithPayslip->filter(function ($e) use (
                $from,
                $to,
                $bonusStructureId
            ) {
                $alreadyDisbursed = $this->hasAlreadyReceivedPayrollBonus($from, $to, $e, $bonusStructureId);
                if ($alreadyDisbursed) {
                    return true;
                } else {
                    return false;
                }
            })->toArray();
            return $this->employeeService->findAll()->whereNotIn('id', $uniqueEmployeeIdsWithPayslip);
        }
    }

    public function getNextPayslipId()
    {
        return $this->actionRepository->max() + 1;
    }

    /**
     * @param array $data
     * @throws Exception
     */
    private function isPreviouslyCreated(array $data)
    {
        $employee = $this->getEmployee($data['employee_id']);
        if (isset($data['bonus'])) {
            $data['type'] = Payslip::getTypes()[1];
        } else {
            $data['type'] = Payslip::getTypes()[0];
        }
        $payslips = $this->actionRepository->getModel()->newQuery()
            ->where('period_from', '>=', $data['period_from'])
            ->where('period_to', '<=', $data['period_to'])
            ->where('type', $data['type'])
            ->where('employee_id', $data['employee_id'])->get();

        if ($payslips->count() > 0 && $data['type'] == Payslip::getTypes()[0]) {
            // only 1 general payslip at a month
            throw new Exception(trans('accounts::payroll.flash_messages.already_found',
                ['name' => $employee->getName()]
            ));
        }

        if ($payslips->count() > 0 && $data['type'] == Payslip::getTypes()[1]) {
            // we got a previous slip of bonus
            // now we have to check that payslip to identify its'code
            // for same code, we cant let them run again in this month
            $bonusStructure = SalaryStructure::find($data['bonus_structure_id']);
            $bonusRules = $bonusStructure->rules->pluck('id');
            foreach ($payslips as $payslip) {
                $salaryRules = $this->payslipDetailService
                    ->findBy(['payslip_id' => $payslip->id])
                    ->filter(function ($s) {
                        return $s->amount;
                    });
                $salaryRuleIds = $salaryRules->pluck('salary_rule_id');
                foreach ($bonusRules as $bonusRule) {
                    if (in_array($bonusRule, $salaryRuleIds->toArray())) {
                        throw new Exception(trans('accounts::payroll.flash_messages.bonus_already_found'));
                    }
                }
            }
        }
    }


    /**
     * <h3>Employee Dropdown</h3>
     * <p>Custom Implementation of concatenation</p>
     *
     * @param Closure $implementedValue Anonymous Implementation of Value
     * @param Closure $implementedKey Anonymous Implementation Key index
     * @param array|null $query
     * @param bool $isEmptyOption
     *
     * @return array
     */
    public function getEmployeesForDropdown(
        Closure $implementedValue = null,
        Closure $implementedKey = null,
        array $query = null,
        $isEmptyOption = false
    ) {
        $employees = $query ? $this->employeeService->findBy($query) : $this->employeeService->findAll();
        // filter out the employees which do not have any
        $employees = $employees->filter(function ($e) {
            return $e->employeeContract;
        });
        return DropDownDataFormatter::getFormattedDataForDropdown(
            $employees,
            $implementedKey,
            $implementedValue ?: function ($employee) {
                return $employee->employee_id . ' - ' . $employee->first_name . ' ' . $employee->last_name . ' - ' . $employee->mobile_one;
            },
            $isEmptyOption
        );
    }

    /**
     * @param Payslip $payslip
     *
     * @return array
     */
    public function getAllSalaryOutstandingRulesName(
        Payslip $payslip
    ): array {
        $data = $this->employeeSalaryOutstandingService->getAllProcessedSalaryOutstandingOfPayslip($payslip);
        return $data->pluck('salary_rule_id')->toArray();
    }

    /**
     * @param                 $outstandingRuleData
     * @param PayslipDetail $payslipDetail
     * @param int $previousAmount
     */
    private function updatePayslipDetailAmount(
        $outstandingRuleData,
        PayslipDetail $payslipDetail,
        int $previousAmount
    ): void {
        $amount = $previousAmount;
        if ($outstandingRuleData) {
            // it should be one, just to be sure -> looping through
            foreach ($outstandingRuleData as $data) {
                $amount += $data->amount;
                $this->employeeSalaryOutstandingService->makeOutstandingRuleInactive($data);
            }
        }
        if ($amount > $previousAmount) {
            $this->payslipDetailService->update($payslipDetail, ['amount' => $amount]);
        }
    }

    /**
     * @param Collection $payslips
     *
     * @return Collection
     */
    public function getPayslipsSortedByDesignation(
        Collection $payslips
    ): Collection {
        return $payslips->sortBy(function ($p) {
            return (int)$p->employee->designation->hierarchy_level;
        })->values();
    }

    /**
     * Get Payslips sorted by their service period length
     * This function returns them in desc order
     *
     * @param $employees
     *
     * @return mixed
     */
    public function getPayslipsSortedByServicePeriod(
        $payslips
    ) {
        $payslips = $payslips->each(function ($p) {
            $p->service_period = $this->employeeService->getEmployeeServicePeriod($p->employee);
            return $p;
        })->sortByDesc(function ($p) {
            return (int)$p->service_period;
        })->values();
        return $payslips;
    }

    /**
     * This method returns payslips sorted by
     * their designation and service period
     *
     * @param $payslips
     *
     * @return Collection
     */
    public function getPayslipsSortedByDesignationAndServicePeriod(
        Collection $payslips
    ): Collection {
        // sort by designation
        // for each designation, sort by their service period
        // merge the total employees
        $payslips = $this->addEmployeeLevelToCollection($payslips);
        $payslips = $this->getPayslipsSortedByDesignation($payslips);
        $designationLevels = $payslips->pluck('employee_level')->unique();
        $sortedPayslips = collect();
        foreach ($designationLevels as $designationLevel) {
            $hayStack = $payslips;
            $newCollection = $hayStack->filter(function ($p) use ($designationLevel) {
                return $p->employee_level == $designationLevel;
            });
            $newCollection = $this->getPayslipsSortedByServicePeriod($newCollection);
            $sortedPayslips = $sortedPayslips->merge($newCollection);
        }
        return $sortedPayslips;
    }

    public function ignoreRejectedPayslips(
        $payslips
    ) {
        $payslips = $payslips->filter(function ($p) {
            return $p->status == 'draft';
        });
//        dd($payslips->pluck('employee_id')->all());
        return $payslips;
    }

    /**
     * This method adds 'employee_name' attr. to a payslip
     * You can access like: $payslips->employee_name
     *
     * @param $payslips
     *
     * @return mixed
     */
    public function addEmployeeNameToCollection(
        $payslips
    ) {
        return $payslips->each(function ($p) {
            return $p->employee_name = $p->employee->getName();
        });
    }

    /**
     * This method adds 'employee_level' attr. to a payslip
     * You can access like: $payslips->employee_level
     *
     * @param $payslips
     *
     * @return mixed
     */
    public function addEmployeeLevelToCollection(
        $payslips
    ) {
        return $payslips->each(function ($p) {
            return $p->employee_level = $p->employee->designation->hierarchy_level;
        });
    }

    /**
     * Filter from the given payslips by month and year
     * @param null $payslips
     * @param string $payslipPeriod e.g: 'March,2020'
     * @return Collection
     */
    public function filterPayslipsByMonthAndYear(
        $payslips = null,
        string $payslipPeriod
    ) {
        $month = Carbon::parse($payslipPeriod)->format('m');
        $year = Carbon::parse($payslipPeriod)->format('Y');
        if (is_null($payslips)) {
            return $this->actionRepository->getPayslipsByMonthAndYear($month, $year);
        }

        return $payslips->filter(function ($p) use ($year) {
            return $p->period_from->format('Y') == $year;
        })->filter(function ($p) use ($month) {
            return $p->period_from->format('m') == $month;
        });
    }

    /**
     * Filter payslips by employees, grade,structure,only bank employee, only PRL employee
     * @param array $data
     * @return Builder[]|\Illuminate\Database\Eloquent\Collection|Collection
     */
    public function filterPayslipsByEmployees(
        array $data
    ) {
        $employees = Employee::with('designation', 'employeeContract')->get();
        // get employee with contract
        $employees = $employees->filter(function ($e) {
            return $e->employeeContract;
        });
        // If id found, override the default employees
        // filter employee with employee_id
        if (isset($data['employee_id']) && (!is_null($data['employee_id']))) {
            $filterId = Employee::find($data['employee_id'])->pluck('id');
            $employees = $employees->whereIn('id', $filterId);
        }
        // filter with salary structure
        if (isset($data['salary_structures']) && (!is_null($data['salary_structures']))) {
            $employees = $this->filterEmployeeWithParam($data['salary_structures'], $employees, 'salary_structure_id');
        }
        // filter with salary grade
        if (isset($data['salary_grade']) && !is_null($data['salary_grade'])) {
            $employees = $this->filterEmployeeWithParam($data['salary_grade'], $employees, 'salary_grade');
        }
        //filter with bank account no for bank report
        if (isset($data['report_type']) && !is_null($data['report_type']) && ($data['report_type'] == 'bank')) {
            $employees = $employees->filter(function ($p) {
                return !is_null(optional($p->employeeContract)->bank_account_no);
            });
        }
        // if only_prl_employee set, filter Only PRL employee
        if (isset($data['only_prl_employee'])) {
            $employees = $employees->filter(function ($e) {
                return $e->postRetirementLeaveEmployee;
            });
        }
        if (!$employees->count()) {
            return collect();
        }
        // filter from payslip
        $query = (new Payslip)->newQuery();
        //filter employees
        $query->whereIn('employee_id', $employees->pluck('id')->toArray());
        $payslips = $query->get();
        return $payslips;
    }


    /**
     * Filter Employee By their grade and structures
     * @param $parameters
     * @param Collection $employees
     * @param null $key ['salary_structure_id','salary_grade']
     * @return Collection
     */
    private function filterEmployeeWithParam(
        $parameters,
        Collection $employees,
        $key = null
    ): Collection {
        $filteredEmployees = collect();
        foreach ($parameters as $id) {
            $result = collect();
            $result = $employees->filter(function ($e) use ($key, $id) {
                return $e->employeeContract->$key == $id;
            });
            if ($result->count()) {
                $filteredEmployees->push($result);
            }
        }
        $employees = $filteredEmployees;
        return $employees->flatten();
    }

    /**
     * Filter all the payslips by status
     * @param Collection $payslips
     * @param string $status
     * @return Collection
     */
    public function filterPayslipsByStatus(Collection $payslips, string $status)
    {
        return $payslips->filter(function ($item) use ($status) {
            return $item->status == $status;
        });
    }

    /**
     * Modify reference and payslip name
     * @param array $data
     * @param Model $employee
     * @return array
     */
    private function modifyPayslipCreationData(
        array $data,
        Model $employee
    ) {
        if (isset($data['bonus'])) {
            $data['payslip_name'] = $this->getPayslipName(
                Payslip::getTypes()[1], $employee, $data['period_to']
            );
            $data['reference'] = $this->getPayslipReference(
                Payslip::getTypes()[1], $employee, $data['period_to']
            );
            $data['type'] = Payslip::getTypes()[1];
        } else {
            $data['payslip_name'] = $this->getPayslipName(
                Payslip::getTypes()[0], $employee, $data['period_to']
            );
            $data['reference'] = $this->getPayslipReference(
                Payslip::getTypes()[0], $employee, $data['period_to']
            );
            $data['type'] = Payslip::getTypes()[0];
        }
        return $data;
    }


    /**
     * @param $payslipType
     * @param $employee
     * @param $date
     * @return string
     */
    public function getPayslipName(
        $payslipType,
        Model $employee,
        $date
    ) {
        $date = Carbon::parse($date);
        $detailDate = MonthNameConverter::en2bn($date->format('F')) . ',' .
            EnToBnNumberConverter::en2bn($date->format('Y'), false);
        if ($payslipType == Payslip::getTypes()[1]) {
            return $employee->getName() . ' - ' . $detailDate . ' মাসের বোনাস বেতন স্লিপ';
        } else {
            return $employee->getName() . ' - ' . $detailDate . ' মাসের বেতন স্লিপ';
        }
    }

    /**
     * @param $payslipType
     * @param $employee
     * @param $date
     * @return string
     */
    public function getPayslipReference(
        $payslipType,
        Model $employee,
        $date
    ) {
        if ($payslipType == Payslip::getTypes()[1]) {
            $payslipData['reference'] = "PAYSLIP/BARD/BONUS/" . $employee->employee_id . "/" .
                date('F/Y', strtotime($date));
        } else {
            $payslipData['reference'] = "PAYSLIP/BARD/" . $employee->employee_id . "/" .
                date('F/Y', strtotime($date));
        }
        return $payslipData['reference'];
    }

    /**
     * @param array $data
     * @param Model $payslip
     * @param Model|null $employee
     * @return mixed
     * @throws Exception
     */
    private function getEmployeeStructure(
        array $data,
        Model $payslip,
        ?Model $employee
    ): SalaryStructure {
        if ($payslip->type == Payslip::getTypes()[1]) {
            if (is_null($data['bonus_structure_id'])) {
                throw new Exception("Bonus Structure Should Be Selected" . $employee->getName());
            }
            $employeeStructure = SalaryStructure::find($data['bonus_structure_id']);
        } else {
            $employeeStructure = $this->getEmployeeSalaryStructure($employee);
        }
        return $employeeStructure;
    }

    /**
     * method to check if an employee already received bonus of given BonusStructureId
     * @param $from
     * @param $to
     * @param $employeeId
     * @param $bonusStructureId
     * @return bool
     */
    public function hasAlreadyReceivedPayrollBonus($from, $to, $employeeId, $bonusStructureId)
    {
        $payslips = $this->actionRepository->getModel()->newQuery()
            ->where('period_from', '>=', $from)
            ->where('period_to', '<=', $to)
            ->where('type', Payslip::getTypes()[1])
            ->where('employee_id', $employeeId)
            ->get();
        if ($payslips->count() > 0) {
            $bonusStructure = SalaryStructure::find($bonusStructureId);
            $bonusRuleIds = $bonusStructure->rules->pluck('id');
            $totalSalaryRuleIds = collect();
            foreach ($payslips as $payslip) {
                $salaryRuleIds = $this->payslipDetailService
                    ->findBy(['payslip_id' => $payslip->id])
                    ->filter(function ($s) {
                        return $s->amount;
                    })
                    ->pluck('salary_rule_id');
                $totalSalaryRuleIds = $totalSalaryRuleIds->merge($salaryRuleIds);
            }
            $interSect = array_intersect($totalSalaryRuleIds->toArray(), $bonusRuleIds->toArray());
            if ($interSect) {
                return true;
            }
            return false;
        } else {
            return false;
        }
    }

    /**
     * You can filter from existing payslips by its type
     * @param Collection $payslips
     * @param $typeName - ['general','festival_bonus','boishakhi_bonus']
     * @return Collection
     */
    public function filterPayslipsByTypeName(Collection $payslips, $typeName): Collection
    {
        $typeGeneral = Payslip::getTypes()[0];
        // for general
        if ($typeName == $typeGeneral) {
            return $payslips->filter(function ($p) use ($typeName) {
                return $p->type == $typeName;
            });
        }

        $payslips = $payslips->filter(function ($p) use ($typeGeneral) {
            return $p->type != $typeGeneral;
        });
        $codes = null;
        // for bonus
        if ($typeName == array_keys(Payslip::getTypesForDropdown())[1]) {
            // festival bonus
            $codes = SalaryRule::getOnlyFestivalBonusCodes();
        }
        if ($typeName == array_keys(Payslip::getTypesForDropdown())[2]) {
            // boishakhi bonus
            $codes = SalaryRule::getOnlyBoishakhiBonusCodes();
        }
        $codeRules = $this->salaryRuleService->getRulesByCodes($codes);
        $codeRulesIds = $codeRules->pluck('id')->toArray();
        return $payslips->filter(function ($p) use ($codeRulesIds) {
            $detailCodes = $p->payslipDetails->pluck('salary_rule_id')->toArray();
            return !empty(array_intersect($codeRulesIds, $detailCodes));
        });
    }

    /**
     * Filter Payslip Between two date range
     * @param Collection $payslips
     * @param $from
     * @param $to
     * @return Collection
     */
    public function filterPayslipsByDateRange(Collection $payslips, $from, $to)
    {
        return $payslips->filter(function ($payslip) use ($from, $to) {
            $from = Carbon::parse($from)->firstOfMonth();
            $to = Carbon::parse($to)->lastOfMonth();
            return ($payslip->period_from->gte($from) && $payslip->period_to->lte($to));
        });

    }


}

