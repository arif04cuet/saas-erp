<?php

namespace Modules\Accounts\Services;

use App\Traits\CrudTrait;
use App\Utilities\EnToBnNumberConverter;
use App\Utilities\MonthNameConverter;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Modules\Accounts\Repositories\EmployeeMonthlyPensionRepository;
use Modules\Accounts\Repositories\PensionRuleRepository;
use Modules\HRM\Services\EmployeeService;
use PhpOffice\PhpWord\TemplateProcessor;

class MonthlyPensionService
{
    use CrudTrait;
    /**
     * @var EmployeeMonthlyPensionRepository
     */
    private $employeeMonthlyPensionRepository;
    /**
     * @var MonthlyPensionContractService
     */
    private $monthlyPensionContractService;
    /**
     * @var EmployeeService
     */
    private $employeeService;
    /**
     * @var PensionConfigurationService
     */
    private $pensionConfigurationService;
    /**
     * @var PensionRuleRepository
     */
    private $pensionRuleRepository;

    /**
     * MonthlyPensionService constructor.
     * @param EmployeeMonthlyPensionRepository $employeeMonthlyPensionRepository
     * @param MonthlyPensionContractService $monthlyPensionContractService
     * @param EmployeeService $employeeService
     * @param PensionConfigurationService $pensionConfigurationService
     * @param PensionRuleRepository $pensionRuleRepository
     */
    public function __construct(
        EmployeeMonthlyPensionRepository $employeeMonthlyPensionRepository,
        MonthlyPensionContractService $monthlyPensionContractService,
        EmployeeService $employeeService,
        PensionConfigurationService $pensionConfigurationService,
        PensionRuleRepository $pensionRuleRepository
    ) {
        $this->employeeMonthlyPensionRepository = $employeeMonthlyPensionRepository;
        $this->setActionRepository($employeeMonthlyPensionRepository);
        $this->monthlyPensionContractService = $monthlyPensionContractService;
        $this->employeeService = $employeeService;
        $this->pensionConfigurationService = $pensionConfigurationService;
        $this->pensionRuleRepository = $pensionRuleRepository;
    }

    public function createMonthlyPension(array $data)
    {
        $employeeIds = $data['employees'];
        $monthlyPensionData = $this->fetchEmployeesWithPensions(
            [$data['month'], $data['bonus'] ?? []],
            $employeeIds,
            $data['is_bonus_only'] ?? 0
        );

        try {
            DB::transaction(function () use ($data, $monthlyPensionData) {
                foreach ($monthlyPensionData as $pensionDatum) {
                    $deductionAmount = $data['deductions'][$pensionDatum['employee_id']];
                    $prepareData = [
                        'employee_id' => $pensionDatum['employee_id'],
                        'receiver' => $pensionDatum['receiver'],
                        'month' => date('Y-m', strtotime($data['month'])),
                        'basic_pay' => $pensionDatum['basic'],
                        'medical_allowance' => $pensionDatum['medical'],
                        'bonus' => $pensionDatum['bonus'],
                        'deduction' => $deductionAmount,
                        'bonus_name' => $pensionDatum['bonus_remark'],
                        'total' => ($pensionDatum['total'] - $deductionAmount),
                    ];
                    $this->save($prepareData);
                }
            });
            Session::flash('success', __('labels.save_success'));
        } catch (\Exception $exception) {
            Session::flash('error', $exception->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Fetches all the employees having active pension contract by preparing the pension amounts. The first
     * param expects an array with month as the first element and bonuses(if any) as the second element
     * @param array $data
     * @param array $employeeIds
     * @return array
     */
    public function fetchEmployeesWithPensions(array $data, $employeeIds = [], $onlyBonus)
    {
        $pensionContracts = count($employeeIds) ? $this->monthlyPensionContractService->findIn(
            'employee_id',
            $employeeIds
        ) : $this->monthlyPensionContractService->findAll();
        $pensionContracts = $pensionContracts->reject(function ($item) {
            return $item->status == 'inactive';
        });
        $monthlyPensions = [];
        $month = date('Y-m', strtotime($data[0]));
        $bonusIds = $data[1];
        $configuration = $this->pensionConfigurationService->getActiveConfiguration();
        $minimumBasic = $configuration->minimum_pension_amount;

        foreach ($pensionContracts as $contract) {
            //$checkExist = $this->findBy(['employee_id' => $contract->employee_id, 'month' => $month]);
            $checkExist = $this->employeeMonthlyPensionRepository->getPensionsWithBasic($contract->employee_id, $month);
            if (!count($checkExist)) {
                $employee = $this->employeeService->findOne($contract->employee_id);
                $nomineeTypes = array_keys(config('constants.pension.contract.receiver_type'));
                if ($contract->receiver == $nomineeTypes[1]) {
                    $nominee = $contract->nominee;
                    $nomineeName = App::getLocale() == 'bn' ? $nominee->bangla_name ?? $nominee->name : $nominee->name;
                    $receiverDateOfBirth = $nominee ? $nominee->birth_date ?? date('Y-m-d') : date('Y-m-d');
                    $receiverAge = $this->getAgeInYears($receiverDateOfBirth);
                    if ($receiverAge > $nominee->age_limit) {
                        continue;
                    }
                } else {
                    $receiverDateOfBirth = $employee->employeePersonalInfo->date_of_birth ?? date('Y-m-d');
                    $receiverAge = $this->getAgeInYears($receiverDateOfBirth);
                }
                $basic = ($contract->current_basic < $minimumBasic) ? $minimumBasic : $contract->current_basic;
                $religion = $employee->religion->english_title ?? "";
                $bonus = $bonusIds ? $this->calculatePensionRules(
                    $bonusIds,
                    $basic,
                    $religion
                ) : [0, ''];

                if ($receiverAge < $configuration->medical_allowance_increment_age) {
                    $medicalAllowance = $configuration->initial_medical_allowance;
                } else {
                    $medicalAllowance = $configuration->medical_allowance_after_increment;
                }

                $monthlyPensions[] = [
                    'employee_name' => $employee->getName(),
                    'employee_id' => $employee->id,
                    'employee_user_id' => $employee->employee_id,
                    'receiver' => $contract->getReceiverInfo(),
                    'receiver_age' => $receiverAge,
                    'religion' => $religion == "" ? '<i class="danger">Not set</i>' : $religion,
                    'basic' => $onlyBonus ? 0 : $basic,
                    'medical' => $onlyBonus ? 0 : $medicalAllowance,
                    'bonus' => $bonus[0],
                    'bonus_remark' => $bonus[1],
                    'total' => $onlyBonus ? $bonus[0] : round($basic + $medicalAllowance + $bonus[0], 2),
                ];
            }
        }
        return $monthlyPensions;
    }

    private function isFiscalYearMonth($month = null): bool
    {
        if (is_null($month)) {
            $month = date('Y-m');
        }
        return date('m', strtotime($month . '-01')) == '07';
    }

    public function getAgeInYears($birthDate): int
    {
        return Carbon::parse($birthDate)->age;
    }

    /**
     * @param array $ruleIds
     * @param $pensionBasic
     * @param $religion
     * @return array
     */
    public function calculatePensionRules(array $ruleIds, $pensionBasic, $religion)
    {
        $rules = $this->pensionRuleRepository->findIn('id', $ruleIds);
        $total = 0;
        $remark = "";
        foreach ($rules as $rule) {
            $amount = 0;

            if ($rule->type == 'bonus_islamic' && strtolower($religion) != 'islam') {
                continue;
            }
            if ($rule->type == 'bonus_other_religion' && (strtolower($religion) == 'islam' || $religion == "")) {
                continue;
            }
            if ($rule->amount_type == "percentage_amount") {
                $amount = ($pensionBasic * $rule->percentage_amount) / 100;
            } elseif ($rule->amount_type == "fixed_amount") {
                $amount = $rule->fixed_amount;
            }
            $total += $amount;
            $remark .= $rule->name . ": " . $amount . "<br>";
        }
        return [round($total, 2), $remark];
    }

    /**
     * Method to get all the active configuration rules with condition 'occasional'
     * @return array
     */
    public function getOccasionalPensionRules()
    {
        $activeConfiguration = $this->pensionConfigurationService->getActiveConfiguration();
        return $activeConfiguration ? $activeConfiguration->rules->filter(function ($query) {
            return $query->condition == 'occasional';
        })->pluck('name', 'id') : [];
    }

    public function getPensionEmployeeListForDropDown()
    {
        $employeeIds = $this->monthlyPensionContractService->findAll()->pluck('employee_id')->toArray();
        return $this->employeeService->findIn('id', $employeeIds)->map(function ($employee) {
            return [
                'id' => $employee->id,
                'employee' => $employee->employee_id . ' - ' . $employee->getName() . ' - ' . $employee->mobile_one
            ];
        })->pluck('employee', 'id');
    }

    public function prepareReport($month)
    {
        $pensionContracts = $this->monthlyPensionContractService->getActiveContracts();
        $reportData = [];
        foreach ($pensionContracts as $contract) {
            //$monthParsed = Carbon::parse($month)->format('Y-m');
            //$monthlyPensions = $this->employeeMonthlyPensionRepository->findBy(['month' => $monthParsed]);
            if ($contract->disbursement_type != 'bank') {
                continue;
            }
            $employee = $contract->employee;
            $reportData[] = [
                'name' => $employee->getName(),
                'ppo_number' => $contract->ppo_number,
                'bank_account' => $contract->bank_account_information,
                'total_amount' => $this->getTotalDraftAmount($employee->id)
            ];
        }

        return $reportData;
    }

    private function getTotalDraftAmount($employeeId)
    {
        return $this->employeeMonthlyPensionRepository->getDraftPensionsByMonths($employeeId, [])->sum('total');
    }

    public function generateBillDocument($employeeId, $months = [])
    {
        $pensions = $this->employeeMonthlyPensionRepository->getDraftPensionsByMonths($employeeId, $months);
        if (!count($pensions)) {
            Session::flash('error', __('accounts::pension.monthly.no_bill'));
            return false;
        }
        $pensionContract = $pensions[0]->contract;
        $employee = $this->employeeService->findOne($employeeId);
        $template = storage_path() . '/files/templates/pension-bill-template.docx';
        $templateProcessor = new TemplateProcessor($template);
        $templateData = $this->prepareBillData($employee, $pensionContract, $pensions);
//        dd($templateData);
        foreach ($templateData as $key => $templateDatum) {
            $templateProcessor->setValue($key, $templateDatum);
        }
        $fileName = $employee->employee_id . '_pension_bill.docx';
        $filePath = storage_path() . '/files/temps/' . $fileName;
        $templateProcessor->saveAs($filePath);
        header("Content-disposition: attachment;filename=" . $fileName . " ; charset=iso-8859-1");
        echo file_get_contents($filePath);
    }

    private function prepareBillData($employee, $pensionContract, $pensions)
    {
        $monthlyPension = 0;
        $monthlyPensionTotal = 0;
        $medicalAllowance = 0;
        $medicalAllowanceTotal = 0;
        $bonus = 0;
        $bonusTotal = 0;
        $deductions = [];
        $totalDeduction = 0;
        $bonusMonth = "";
        $startMonth = MonthNameConverter::convertMonthToBn($pensions[0]->month, true);
        $month = $startMonth;
        foreach ($pensions as $pension) {
            $thisMonth = MonthNameConverter::convertMonthToBn($pension->month, true);
            if ($thisMonth != $startMonth) {
                $month = $startMonth . ' - ' . $thisMonth;
            }
            $monthlyPension = $pension->basic_pay;
            $monthlyPensionTotal += $monthlyPension;
            $medicalAllowance = $pension->medical_allowance;
            $medicalAllowanceTotal += $medicalAllowance;
            if ($pension->bonus) {
                $bonusMonth .= $thisMonth . ' ';
                $bonus = $pension->bonus;
                $bonusTotal += $bonus;
            }
            if ($pension->deduction) {
                $deductions[] = ['month' => $thisMonth, 'deduction' => $pension->deduction];
                $totalDeduction += $pension->deduction;
            }
        }
        $totalClaim = $monthlyPensionTotal + $medicalAllowanceTotal + $bonusTotal;
        $templateValues = [
            'name' => $employee->getName(),
            'fatherName' => $employee->employeePersnalInfo->father_name ?? " ",
            'postOffice' => " ",
            'ps' => " ",
            'village' => " ",
            'district' => " ",
            'ppoNo' => EnToBnNumberConverter::en2bn($pensionContract->ppo_number, false),
            'month' => $month,
            'pension' => EnToBnNumberConverter::en2bn($monthlyPension, true, 2),
            'totalPension' => EnToBnNumberConverter::en2bn($monthlyPensionTotal, true, 2),
            'medical' => EnToBnNumberConverter::en2bn($medicalAllowance),
            'totalMedical' => EnToBnNumberConverter::en2bn($medicalAllowanceTotal, true, 2),
            'bonusMonth' => $bonusMonth,
            'bonus' => EnToBnNumberConverter::en2bn($bonus, true, 2),
            'totalBonus' => EnToBnNumberConverter::en2bn($bonusTotal, true, 2),
            'totalClaim' => EnToBnNumberConverter::en2bn($totalClaim, true, 2),
        ];
        /**
         * Fetching and calculating deduction which will be adjusted with total pension amount
         */
        for ($i = 0; $i <= 3; $i++) {
            $templateValues['month' . $i] = "";
            $templateValues['deduction' . $i] = "";
        }
        foreach ($deductions as $key => $deduction) {
            $templateValues['month' . $key] = $deduction['month'];
            $templateValues['deduction' . $key] = EnToBnNumberConverter::en2bn($deduction['deduction']);
        }
        $templateValues['totalDeduct'] = EnToBnNumberConverter::en2bn($totalDeduction, true, 2);
        $templateValues['nitAmount'] = EnToBnNumberConverter::en2bn($totalClaim - $totalDeduction, true, 2);
        $templateValues['nitAmountInWord'] =
            EnToBnNumberConverter::numberToBanglaWords($totalClaim - $totalDeduction);

        return $templateValues;
    }

    public function getMonthlyPensions()
    {
        $pensions = $this->findAll()->unique('employee_id');
        $pensioners = [];
        foreach ($pensions as $pension) {
            $employee = $pension->employee ?? null;
            $contract = $pension->contract ?? null;

            $pensioners[] = [
                'pension_id' => $pension->id,
                'employee_id' => $pension->employee_id,
                'ppo_number' => $contract ? $contract->ppo_number : "-",
                'employee_name' => ($employee)->getName(),
                'receiver' => $contract ? $contract->getReceiverInfo() : " - ",
                'receivable_amount' => $this->getTotalDraftAmount($pension->employee_id),
            ];
        }
        return $pensioners;
    }

}

