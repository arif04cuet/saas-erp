<?php
/**
 * Created by PhpStorm.
 * User: bs130
 * Date: 10/21/18
 * Time: 3:17 PM
 */

namespace Modules\Accounts\Services;

use App\Traits\CrudTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Accounts\Entities\ContributionRegister;
use Modules\Accounts\Entities\EmployeeContractAssignedRule;
use Modules\Accounts\Entities\Payslip;
use Modules\Accounts\Entities\SalaryBasic;
use Modules\Accounts\Entities\SalaryCategory;
use Modules\Accounts\Entities\SalaryRule;
use Modules\Accounts\Entities\SalaryStructure;
use Modules\Accounts\Repositories\PayscaleRepository;
use Modules\Accounts\Entities\SalaryRuleChild;
use Modules\Accounts\Repositories\SalaryRuleRepository;
use Modules\HRM\Entities\Employee;
use Modules\HRM\Entities\EmployeeReligion;
use Modules\HRM\Services\EmployeePersonalInfoService;
use Modules\HRM\Services\EmployeeSpouseChildrenService;
use PhpParser\Node\Expr\Array_;

class SalaryRuleService
{
    use CrudTrait;

    private $salaryRuleRepository;
    private $employeeContractAssignedRuleService;
    private $payscaleService;
    private $gpfService;
    private $employeeSpouseChildrenService;

    /**
     * SalaryRuleService constructor.
     * @param SalaryRuleRepository $salaryRuleRepository
     * @param EmployeeContractAssignedRuleService $employeeContractAssignedRuleService
     * @param PayscaleService $payscaleService
     * @param GpfService $gpfService
     * @param EmployeeSpouseChildrenService $employeeSpouseChildrenService
     */
    public function __construct
    (
        SalaryRuleRepository $salaryRuleRepository,
        EmployeeContractAssignedRuleService $employeeContractAssignedRuleService,
        PayscaleService $payscaleService,
        GpfService $gpfService,
        EmployeeSpouseChildrenService $employeeSpouseChildrenService
    ) {
        $this->setActionRepository($salaryRuleRepository);
        $this->salaryRuleRepository = $salaryRuleRepository;
        $this->gpfService = $gpfService;
        $this->employeeContractAssignedRuleService = $employeeContractAssignedRuleService;
        $this->payscaleService = $payscaleService;
        $this->employeeSpouseChildrenService = $employeeSpouseChildrenService;
    }

    /**
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function saveData($data)
    {
        if ($data['condition_type'] != 2) {
            $data['range_based_on'] = null;
        }
        if ($data['amount_type'] != 2) {
            $data['percentage_based_on'] = null;
        }
        $savedRule = $this->save($data);
        if (isset($data['child_salary_rules'])) {
            $this->saveChildRules($data['child_salary_rules'], $savedRule->id);
        }

        return $savedRule;
    }

    public function saveChildRules($data, $ruleId)
    {
        foreach ($data as $datum) {
            $child = new SalaryRuleChild;
            $child->salary_rule_id = $ruleId;
            $child->child_rule_id = $datum;

            $child->save();
        }
    }

    public function saveSalaryCategory($data)
    {
        $salaryCategory = new SalaryCategory;
        $salaryCategory->name = $data['name'];
        $salaryCategory->description = $data['description'];

        return $salaryCategory->save();
    }

    public function saveContributionRegister($data)
    {
        $contributionRegister = new ContributionRegister;
        $contributionRegister->name = $data['name'];
        $contributionRegister->description = $data['description'];

        return $contributionRegister->save();
    }

    /**
     * @param $data
     * @param $id
     * @return Model|mixed
     */
    public function updateData($data, $id)
    {
        $salaryRule = $this->findOrFail($id);
        SalaryRuleChild::where('salary_rule_id', $id)->delete();
        if (isset($data['child_salary_rules'])) {
            $this->saveChildRules($data['child_salary_rules'], $id);
        }
        return $this->update($salaryRule, $data);
    }

    /**
     * @param Employee $employee
     * @param $salaryGrade
     * @param int $increment
     * @return float|int
     */
    private function calculateGpfAmount(Employee $employee, $salaryGrade, int $increment)
    {
        $activePercentage = $this->gpfService->getActiveGpfPercentage($employee);
        $basicSalary = $this->payscaleService->getBasicSalary($salaryGrade, $increment);
        $amount = $this->roundUpBasic(($basicSalary / 100) * $activePercentage);
        return $amount;
    }

    public function roundUpBasic($basic)
    {
        return round(ceil(($basic) / 10)) * 10;
    }

    public function getRulesForDropdown()
    {
        return $this->findAll()->pluck('name', 'id');
    }

    public function getRulesForJson()
    {
        $rules = $this->findAll();
        $rulesForJson = [];
        foreach ($rules as $rule) {
            $rulesForJson[$rule->id] = [
                'id' => $rule->id,
                'name' => $rule->name,
                'code' => $rule->code,
                'category' => $rule->salaryCategory->name,
                'contribution_register' => $rule->contribution_register ?? "",
                'url' => route('salary-rule.show', $rule->id)
            ];

        }

        return $rulesForJson;
    }

    public function getGpfcRule()
    {
        return $this->findBy(['code' => 'GPFC'])->first();
    }

    /**
     * get all rules for a structure
     * @param SalaryStructure $salaryStructure
     * @return mixed
     */
    public function getAllRules(SalaryStructure $salaryStructure)
    {
        return $salaryStructure->getAllRules();
    }

    /**
     * based on the condition, call the calculate function
     * @param Employee $employee
     * @param SalaryRule $salaryRule
     * @param Payslip $payslip
     * @return int
     */
    public function getTotalAmount(Employee $employee, SalaryRule $salaryRule, Payslip $payslip): int
    {
        $conditionTypes = config('constants.condition_types');
        $amount = $this->calculateForSalaryRule($employee, $salaryRule, $conditionTypes, $payslip);
        if ($salaryRule->children->count()) {
            foreach ($salaryRule->children as $childRule) {
                $amount += $this->calculateForSalaryRule($employee, $childRule->salaryRule, $conditionTypes, $payslip);
            }
        }
        return $amount;
    }

    /**
     * calculate all the computation part and return an amount
     * @param Employee $employee
     * @param SalaryRule $salaryRule
     * @param Payslip $payslip
     * @return int
     */
    private function calculate(Employee $employee, SalaryRule $salaryRule, Payslip $payslip): int
    {
        // amount types are - Fixed Amount,Percentage,assign-in-contract
        $amountTypes = config('constants.amount_types');
        $value = $salaryRule->amount_type;
        if ($amountTypes[$value] === $amountTypes[1]) {
            return ($salaryRule->fixed_amount * $salaryRule->quantity);
        } else {
            if ($amountTypes[$value] === $amountTypes[2]) {
                return $this->calculatePercentageAmount($employee, $salaryRule, $payslip);
            } else {
                if ($amountTypes[$value] === $amountTypes[3]) {
                    return $this->calculateAssignedContractAmount($employee, $salaryRule);
                } else {
                    return 0;
                }
            }
        }
    }

    /**
     * get details from employee contract assigned table
     * @param Employee $employee
     * @param SalaryRule $salaryRule
     * @return mixed
     */
    private function getEmployeeContractAssignedRule(Employee $employee, SalaryRule $salaryRule)
    {
        return $this->employeeContractAssignedRuleService->findBy(
            [
                'employee_contract_id' => $employee->employeeContract->id,
                'salary_rule_id' => $salaryRule->id
            ])->first();
    }

    /**
     * get Economy Code Related To Salary Rule
     * @param SalaryRule $salaryRule
     * @return mixed
     */
    public function getSalaryRuleEconomyCode(SalaryRule $salaryRule)
    {
        if (isset($salaryRule->debit_account)) {
            return $salaryRule->debit_economy_code;
        } else {
            return $salaryRule->credit_economy_code;
        }
    }

    /**
     *  check if the amount is in the range and return it
     * @param $min
     * @param $max
     * @param $value
     * @return int
     */
    private function IsAmountInRange($min, $max, $value): bool
    {
        if (isset($min) && !isset($max)) {
            return $value >= $min ? 1 : 0;
        } elseif (isset($max) && !isset($min)) {
            return $value <= $max ? 1 : 0;
        } elseif (isset($max) && isset($min)) {
            return ($min <= $value) && ($value <= $max);
        } else {
            return 0;
        }
    }

    private function getAmountFromRange($min, $max, $value)
    {
        if (isset($min) && !isset($max)) {
            return $value < $min ? $min : $value;
        } elseif (isset($max) && !isset($min)) {
            return $value >= $max ? $max : $value;
        } elseif (isset($max) && isset($min)) {
            return ($value <= $min) ? $min : (($value >= $max) ? $max : $value);
        } else {
            return $value;
        }
    }

    /**
     * @param Employee $employee
     * @param SalaryRule $salaryRule
     * @return float|int
     */
    private function calculatePercentageAmount(Employee $employee, SalaryRule $salaryRule, Payslip $payslip)
    {
        $percentageRule = $this->getPercentageBasedRule($salaryRule);
        if ($percentageRule) {
            $amount = $this->getGrandTotalAmount($employee, $percentageRule, $payslip);
            $value = ($amount * $salaryRule->percentage) / 100;
            $value = $value * ($salaryRule->quantity);
            return $this->getAmountFromRange($salaryRule->min_amount, $salaryRule->max_amount, $value);
        } else {
            return 0;
        }
    }

    /**
     * @param Employee $employee
     * @param SalaryRule $salaryRule
     * @return float|int
     */
    private function calculateAssignedContractAmount(Employee $employee, SalaryRule $salaryRule)
    {
        $employeeContractAssignedRule = $this->getEmployeeContractAssignedRule($employee, $salaryRule);
        if ($employeeContractAssignedRule) {
            return $employeeContractAssignedRule->amount * $salaryRule->quantity;
        } else {
            return 0;
        }
    }

    /**
     * @param Employee $employee
     * @param SalaryRule $salaryRule
     * @param Payslip $payslip
     * @return int
     */
    private function getRangeConditionAmount(Employee $employee, SalaryRule $salaryRule, Payslip $payslip): int
    {
        $conditionRule = $this->getRangeBasedRule($salaryRule);
        $amount = $this->getGrandTotalAmount($employee, $conditionRule, $payslip);
        $flag = $this->IsAmountInRange($salaryRule->min_range, $salaryRule->max_range, $amount);
        $value = 0;
        if ($flag) {
            $value = $this->calculate($employee, $salaryRule, $payslip);
        }
        return $value;
    }

    /**
     * @param Employee $employee
     * @param SalaryRule $salaryRule
     * @param Payslip $payslip
     * @return int
     */
    private function getChildRulesAmount(Employee $employee, SalaryRule $salaryRule, Payslip $payslip): int
    {
        $amount = 0;
        if ($salaryRule->children->count()) {
            $childRules = $salaryRule->children;
            foreach ($childRules as $childRule) {
                $amount += $this->getGrandTotalAmount($employee, $salaryRule, $payslip);
            }
            return $amount;
        } else {
            return 0;
        }
    }

    /**
     * calculate salary rule based on other conditions
     * @param Employee $employee
     * @param SalaryRule $salaryRule
     * @param Payslip $payslip
     * @return int
     */
    public function calculateRebelAmount(Employee $employee, SalaryRule $salaryRule, Payslip $payslip): int
    {
        if (SalaryRule::HRA_ALLOWANCE_CODE == $salaryRule->code) {
            if ($employee->employeeContract->house_allotment) {
                return 0;
            } else {
                return $this->getTotalAmount($employee, $salaryRule, $payslip);
            }
        } else {
            if (SalaryRule::EDUCATION_ALLOWANCE_CODE == $salaryRule->code) {
                $amount = $this->getTotalAmount($employee, $salaryRule, $payslip);
                $children = $this->getEmployeeChildren($employee);
                $totalAmount = $amount * $children;
                if ($totalAmount > SalaryRule::MAX_AMOUNT_FOR_EA) {
                    $totalAmount = SalaryRule::MAX_AMOUNT_FOR_EA;
                }
                return $totalAmount;
            } else {
                if (SalaryRule::GPF_CODE == $salaryRule->code) {
                    $salaryGrade = $employee->employeeContract->salary_grade;
                    $increment = $employee->employeeContract->increment;
                    if ($payslip->period_from->month == SalaryRule::GPFC_CUSTOM_CALCULATION_MONTH) {
                        $increment = $this->payscaleService->nextApplicableIncrement($salaryGrade, $increment);
                    }
                    $amount = $this->calculateGpfAmount($employee, $salaryGrade, $increment);
                    return $amount;
                } else {
                    return $this->payscaleService->getBasicSalary($employee->employeeContract->salary_grade,
                        $employee->employeeContract->increment);
                }
            }
        }
    }

    /**
     * get employee children
     * @param Employee $employee
     * @return int
     */
    private function getEmployeeChildren(Employee $employee)
    {
        $children = $this->employeeSpouseChildrenService->children($employee->id);
        return $children->filter(function ($child) {
            return $child->is_attestation_letter_submitted;
        })->filter(function ($child) {
            $childYear = Carbon::now()->diffInYears($child->date_of_birth);
            return $childYear <= SalaryRule::MAX_AGE_LIMIT_OF_CHILDREN;
        })->count();
    }

    /**
     * return - range based rule
     * @param SalaryRule $salaryRule
     * @return Model|null
     */
    private function getRangeBasedRule(SalaryRule $salaryRule)
    {
        return $this->actionRepository->findOne($salaryRule->range_based_on);
    }

    /**
     * @param SalaryRule $salaryRule
     * @return Model|null
     */
    private function getPercentageBasedRule(SalaryRule $salaryRule)
    {
        return $this->actionRepository->findOne($salaryRule->percentage_based_on);
    }


    /**
     * Do not call this function, this isn't ready yet
     * @param Employee $employee
     * @param SalaryRule $salaryRule
     * @param Payslip $payslip
     * @return int
     */
    public function getGrandTotalAmount(Employee $employee, SalaryRule $salaryRule, Payslip $payslip): int
    {
        $rebelRules = SalaryRule::rebelRules;
        if (in_array($salaryRule->code, $rebelRules)) {
            return $this->calculateRebelAmount($employee, $salaryRule, $payslip);
        } else {
            return $this->getTotalAmount($employee, $salaryRule, $payslip);
        }
    }

    /**
     * Compute salary for rebel codes
     * @param Employee $employee
     * @param SalaryRule $salaryRule
     * @param array $conditionTypes
     * @param Payslip $payslip
     * @return int
     */
    private function calculateForSalaryRule(
        Employee $employee,
        SalaryRule $salaryRule,
        array $conditionTypes,
        Payslip $payslip
    ): int {
        $salaryRule = $this->changeSalaryRuleByReligionForFestivalBonus($employee, $salaryRule);
        if (is_null($salaryRule)) {
            return 0;
        }
        $value = $salaryRule->condition_type;
        if ($conditionTypes[$value] == $conditionTypes[1]) {
            return $this->calculate($employee, $salaryRule, $payslip);
        } else {
            if ($conditionTypes[$value] == $conditionTypes[2]) {
                return $this->getRangeConditionAmount($employee, $salaryRule, $payslip);
            } else {
                if ($conditionTypes[$value] == $conditionTypes[3]) {
                    return $this->calculate($employee, $salaryRule, $payslip);
                } else {
                    return 0;
                }
            }
        }
    }

    /**
     * get all the bonus salary rules
     * @return mixed
     */
    public function getBonusRules()
    {
        return $this->actionRepository->getRuleByCodes(SalaryRule::getBonusCodes());

    }

    /**
     * @param Employee $employee
     * @param SalaryRule $salaryRule
     * @return SalaryRule|null
     */
    private function changeSalaryRuleByReligionForFestivalBonus(
        Employee $employee,
        SalaryRule $salaryRule
    ) {

        // for FB-1,FB-2
        if (in_array($salaryRule->code, SalaryRule::getOnlyFestivalBonusCodes())) {
            $religionId = optional($employee->religion)->id;
            if (is_null($religionId)) {
                return null;
            }
            //for islam religion
            if (($religionId == EmployeeReligion::getIslamReligionId())
                &&
                ($salaryRule->code == SalaryRule::getOnlyFestivalBonusCodes()[0])
            ) {
                return $this->actionRepository
                    ->getRuleByCodes([SalaryRule::getOnlyFestivalBonusCodes()[0]])
                    ->first();
            }
            // for other religion
            if ($religionId != EmployeeReligion::getIslamReligionId()
                &&
                ($salaryRule->code == SalaryRule::getOnlyFestivalBonusCodes()[1])
            ) {
                return $this->actionRepository
                    ->getRuleByCodes([SalaryRule::getOnlyFestivalBonusCodes()[1]])
                    ->first();
            }
        } else {
            // For FB-3
            return $salaryRule;
        }
    }

    public function getRulesByCodes(array $codes)
    {
        return $this->actionRepository->getRuleByCodes($codes);

    }

}
