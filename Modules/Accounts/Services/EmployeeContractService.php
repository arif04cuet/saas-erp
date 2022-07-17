<?php

namespace Modules\Accounts\Services;

use App\Jobs\ContractAssignedRulesImportJob;
use App\Traits\CrudTrait;
use App\Utilities\DropDownDataFormatter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Modules\Accounts\Entities\EmployeeContract;
use Modules\Accounts\Entities\EmployeeContractAssignedRule;
use Modules\Accounts\Entities\GpfHistory;
use Modules\Accounts\Exports\Helper\GroupReportDesignHelper;
use Modules\Accounts\Repositories\EmployeeContractAssignedRuleRepository;
use Modules\Accounts\Repositories\EmployeeContractRepository;
use Modules\Accounts\Repositories\SalaryRuleRepository;
use Modules\HRM\Services\EmployeeService;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class EmployeeContractService
{
    use CrudTrait;

    private $salaryStructureService;
    private $employeeContractRepository;
    private $employeeService;
    private $salaryRuleRepository;
    private $payscaleService;
    private $gpfService;
    private $employeeOutstandingService;
    /**
     * @var EmployeeContractAssignedRuleRepository
     */
    private $employeeContractAssignedRuleRepository;

    /**
     * EmployeeContractService constructor.
     * @param SalaryStructureService $salaryStructureService
     * @param EmployeeContractRepository $employeeContractRepository
     * @param EmployeeContractAssignedRuleRepository $employeeContractAssignedRuleRepository
     * @param EmployeeService $employeeService
     * @param SalaryRuleRepository $salaryRuleRepository
     * @param PayscaleService $payscaleService
     * @param GpfService $gpfService
     * @param EmployeeSalaryOutstandingService $employeeOutstandingService
     */
    public function __construct(
        SalaryStructureService $salaryStructureService,
        EmployeeContractRepository $employeeContractRepository,
        EmployeeContractAssignedRuleRepository $employeeContractAssignedRuleRepository,
        EmployeeService $employeeService,
        SalaryRuleRepository $salaryRuleRepository,
        PayscaleService $payscaleService,
        GpfService $gpfService,
        EmployeeSalaryOutstandingService $employeeOutstandingService
    ) {
        $this->setActionRepository($employeeContractRepository);
        $this->salaryStructureService = $salaryStructureService;
        $this->employeeContractRepository = $employeeContractRepository;
        $this->employeeService = $employeeService;
        $this->salaryRuleRepository = $salaryRuleRepository;
        $this->payscaleService = $payscaleService;
        $this->gpfService = $gpfService;
        $this->employeeContractAssignedRuleRepository = $employeeContractAssignedRuleRepository;
        $this->employeeOutstandingService = $employeeOutstandingService;
    }

    /**
     * @param $data
     * @return Model
     */
    public function saveData($data)
    {
        // Converting date formats
        $formattedDates = $this->prepareDateFormatForDB([
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'probation_end' => $data['probation_end'],
        ]);
        $data = array_replace($data, $formattedDates);
        $savedData = $this->save($data);

        // Saving Contract Assigned Salary Rules...
        foreach ($data['assigning_rules'] as $key => $rule) {
            $deduction = new EmployeeContractAssignedRule;
            $deduction->employee_contract_id = $savedData->id;
            $deduction->salary_rule_id = $rule;
            $deduction->amount = $data['contract_assigns'][$key];
            $deduction->remark = $data['remarks'][$key];

            $deduction->save();
        }

        // Saving GPF History...
        if (isset($data['gpf_percentage'])) {
            $this->gpfService
                ->saveGpfHistory($savedData->employee_id, $data['gpf_percentage']);
        }

        // save salary-outstanding data
        if (isset($data['outstanding']) && !is_null($data['outstanding'])) {
            $this->employeeOutstandingService->saveData($data['outstanding'], $data['employee_id']);
        }
        return $savedData;
    }

    public function updateData($data, $id)
    {
        $formattedDates = $this->prepareDateFormatForDB([
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'probation_end' => $data['probation_end'],
        ]);
        $data = array_replace($data, $formattedDates);
        $contract = $this->findOrFail($id);
        $data['house_allotment'] = (isset($data['house_allotment'])) ? 1 : 0;
        $contract->update($data);

        // Updating Contract Assigned Salary Rules
        foreach ($data['assigning_rules'] as $key => $rule) {
            $amount = $data['contract_assigns'][$key];
            $remark = $data['remarks'][$key];
            $checkExist = EmployeeContractAssignedRule::where('employee_contract_id', $id)
                ->where('salary_rule_id', $rule)
                ->first();
            if ($checkExist) {
                EmployeeContractAssignedRule::where('employee_contract_id', $id)
                    ->where('salary_rule_id', $rule)
                    ->update(['amount' => $amount, 'remark' => $remark]);
            } else {
                $deduction = new EmployeeContractAssignedRule;
                $deduction->employee_contract_id = $id;
                $deduction->salary_rule_id = $rule;
                $deduction->amount = $amount;
                $deduction->remark = $remark;

                $deduction->save();
            }
        }
        if (isset($data['gpf_percentage'])) {
            $this->gpfService
                ->saveGpfHistory($contract->employee_id, $data['gpf_percentage']);
        }
        // update salary-outstanding data
        $this->employeeOutstandingService->updateData($data, $contract->employee);
    }

    public function prepareDateFormatForDB($data)
    {
        $formattedDates = [];
        foreach ($data as $key => $datum) {
            $formattedDates[$key] = ($datum) ? date('Y-m-d', strtotime($datum)) : null;
        }
        return $formattedDates;
    }

    /**
     * Method to store data from the FORM that was filled by the fetched data from the imported file
     * @param array $data
     */
    public function saveImported(array $data)
    {
        try {
            // Fetching Rules from columns of the imported file
            $rules = explode(',', $data['rules']);
            unset($rules[0], $rules[1]);
            $employeeData = $data['employee_ids'];
            foreach ($employeeData as $key => $datum) {
                $employee = $this->employeeService->findBy(['employee_id' => $datum])->first();
                $contract = (!is_null($employee)) ? $employee->employeeContract : null;
                if (!is_null($employee) && !is_null($contract)) {
                    // Fetching contract assigned rules from employees contract
                    $contractAssignedRules = $this->salaryStructureService->getContractAssignedRules(
                        $contract->salary_structure_id,
                        $contract->id
                    );
                    foreach ($contractAssignedRules as $assignedRule) {
                        if ($assignedRule['code'] == 'GPFC') {
                            continue;
                        }
                        /*
                        Checking if the rule exists in the imported rule. Rule
                        not assigned in employee's contract will be omitted
                        */
                        if (in_array($assignedRule['code'], $rules)) {
                            $ruleAmount = $data[$assignedRule['code']][$key] ?? 0;
                            if ($assignedRule['assigned_rule_id']) {
                                EmployeeContractAssignedRule::where('id', $assignedRule['assigned_rule_id'])
                                    ->update(['amount' => $ruleAmount, 'updated_at' => date('Y-m-d h:i:s')]);
                            } else {
                                $contractRule = new EmployeeContractAssignedRule;
                                $contractRule->employee_contract_id = $contract->id;
                                $contractRule->salary_rule_id = $assignedRule['rule_id'];
                                $contractRule->amount = $ruleAmount;
                                $contractRule->remark = '';

                                $contractRule->save();
                            }
                        } // End checking
                    } // End inner loop
                } // End checking of employee and contract existence
            } // End checking of outer loop
        } catch (\Exception $exception) {
            Session::flash('error', $exception->getMessage() . '. Process failed');
        }
    }

    /**
     * Method to store imported data directly from the imported file
     * @param array $data
     */
    public function storeImported(array $data)
    {
        try {
            // Fetching Rules from columns of the imported file
            $rules = $data[1];
            unset($rules[0], $rules[1]);
            //$employeeData = $data['employee_ids'];
            if (count($data) > 250) {
                ContractAssignedRulesImportJob::dispatch($data)->onConnection('database');
                Session::flash('success', __('accounts::employee-contract.import_to_batch'));
                return;
            }
            foreach ($data as $key => $datum) {
                if ($key < 2) {
                    continue;
                }
                $employee = $this->employeeService->findBy(['employee_id' => $datum[1]])->first();
                $contract = (!is_null($employee)) ? $employee->employeeContract : null;
                if (!is_null($employee) && !is_null($contract)) {
                    // Fetching contract assigned rules from employees contract
                    $contractAssignedRules = $this->salaryStructureService->getContractAssignedRules(
                        $contract->salary_structure_id,
                        $contract->id);
                    foreach ($contractAssignedRules as $assignedRule) {
                        if ($assignedRule['code'] == 'GPFC') {
                            continue;
                        }
                        /*
                        Checking if the rule exists in the imported rule. Rule
                        not assigned in employee's contract will be omitted
                        */
                        $ruleCode = $assignedRule['code'];
                        if (in_array($ruleCode, $rules)) {
                            $ruleAmount = $datum[array_search($ruleCode, $rules)] ?? 0;
                            if ($assignedRule['assigned_rule_id']) {
                                EmployeeContractAssignedRule::where('id', $assignedRule['assigned_rule_id'])
                                    ->update(['amount' => $ruleAmount, 'updated_at' => date('Y-m-d h:i:s')]);
                            } else {
                                $contractRule = new EmployeeContractAssignedRule;
                                $contractRule->employee_contract_id = $contract->id;
                                $contractRule->salary_rule_id = $assignedRule['rule_id'];
                                $contractRule->amount = $ruleAmount;
                                $contractRule->remark = '';

                                $contractRule->save();
                            }
                        } // End checking
                    } // End inner loop
                } // End checking of employee and contract existence
                Session::flash('success', __('accounts::employee-contract.import_success'));
            } // End checking of outer loop
        } catch (\Exception $exception) {
            Session::flash('error', $exception->getMessage() . '. Process failed');
        }
    }

    /**
     * Preparing data of rules that are already assigned in Employee Contract
     * @param EmployeeContract $employeeContract
     * @return array
     */
    public function prepareAssignedRulesData(EmployeeContract $employeeContract)
    {
        $assignedRules = $employeeContract->assignedRules;
        $data = [];
        foreach ($assignedRules as $rule) {
            $salaryRule = $rule->salaryRule;
            $data[$rule->salary_rule_id] = [
                'rule_id' => $salaryRule->id,
                'name' => App::getLocale() == 'bn' ? $salaryRule->bangla_name : $salaryRule->name,
                'amount' => $rule->amount,
                'remark' => $rule->remark,
                'category' => $salaryRule->salaryCategory->name,
                'amount_type' => $salaryRule->amount_type,
                'salary_rule_code' => $salaryRule->code
            ];
        }

        return $data;
    }

    /**
     * Get rules that are set to be assign in Employee Contract
     * @param EmployeeContract $employeeContract
     * @return array
     */
    public function getContractAssignRules(EmployeeContract $employeeContract)
    {
        $rules = $employeeContract->salaryStructure->rules;
        $baseRules = $employeeContract->salaryStructure->parent->rules;
        $data = [];
        $allRules = $rules->merge($baseRules);
        foreach ($allRules as $rule) {
            if ($rule->amount_type != 3) {
                continue;
            }
            $data[$rule->id] = [
                'rule_id' => $rule->id,
                'name' => App::getLocale() == 'bn' ? $rule->bangla_name : $rule->name,
                'category' => $rule->salaryCategory->name
            ];
        }

        return $data;
    }

    public function getGpfHistories($employeeId)
    {
        return GpfHistory::where('employee_id', $employeeId)->orderBy('created_at', 'desc')->get();
    }

    public function getDeductionList()
    {
        return $this->salaryStructureService->findBy(['reference' => 'Base'])->first()->rules();
    }

    public function getEmployeesWithoutContract($assignedEmployeeId = null)
    {
        $employeeIdsWithContract = $this->findAll()->where('employee_id', '!=', $assignedEmployeeId)
            ->pluck('employee_id');
        return $this->employeeService->findAll()
            ->whereNotIn('id', $employeeIdsWithContract)
            ->map(function ($data) {
                $data->name = $data->first_name . ' ' . $data->last_name . ' - ' . $data->employee_id . ' - ' . $data->mobile_one;
                return $data;
            })
            ->pluck('name', 'id');
    }

    /**
     * @param Closure|null $implementedValue
     * @param Closure|null $implementedKey
     * @param array|null $query
     * @param bool $isEmptyOption
     * @return array
     */
    public function getEmployeeContractsForDropdown(
        Closure $implementedValue = null,
        Closure $implementedKey = null,
        array $query = null,
        $isEmptyOption = false
    ) {
        $employeeContracts = $query ? $this->employeeContractRepository->findBy($query) : $this->employeeContractRepository->findAll();

        return DropDownDataFormatter::getFormattedDataForDropdown(
            $employeeContracts,
            $implementedKey,
            $implementedValue ?: function ($employeeContract) {
                return $employeeContract->reference;
            },
            $isEmptyOption
        );
    }

    public function importCSV(Request $data)
    {
        $extension = $data->file('import_file')->getClientOriginalExtension();

        if ('csv' == $extension) {
            $reader = new Csv();
        } else {
            $reader = new Xls();
        }
        $spreadsheet = $reader->load($data->file('import_file')->getPathname());
        $sheet = $spreadsheet->getActiveSheet();
        $highestRowAndColumn = $sheet->getHighestRowAndColumn();
        $sheetData = $sheet->rangeToArray(
            'A1:' . $highestRowAndColumn['column'] . $highestRowAndColumn['row'], null,
            false, false, false
        );
        return $sheetData;
    }

    public function generateCSV()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        // Setting headers for the file
        $contractAssignedRules = $this->salaryRuleRepository->findBy(['amount_type' => 3]);
        $sheet->setCellValue('A1', 'Employee Name');
        $sheet->setCellValue('B1', 'Employee ID');
        $columnCells = [];
        $key = 0;
        foreach ($contractAssignedRules as $contractAssignedRule) {
            if ($key > 50) {
                break;
            }
            if ($contractAssignedRule->code == 'GPFC') {
                continue;
            }
            $column = ($key < 24) ? chr(67 + $key) : chr(65) . chr(41 + $key);
            $sheet->setCellValue($column . '1', $contractAssignedRule->name);
            $sheet->setCellValue($column . '2', $contractAssignedRule->code);
            $columnCells[$contractAssignedRule->id] = $column;
            $key++;
        }
        $employees = $this->employeeService->findAll()->filter(function ($e) {
            return $e->employeeContract;
        });
        $employees = $this->employeeService->getEmployeesSortedByDesignationAndServicePeriod($employees);
        foreach ($employees as $key => $employee) {
            $contract = $employee->employeeContract;
            $employeeName = $employee ? $employee->first_name . ' ' . $employee->last_name : " ";
            $employeeName = mb_convert_encoding($employeeName, "UTF-8");
            $assignedRules = $contract->assignedRules;
            $sheet->setCellValue('A' . ($key + 3), $employeeName);
            $sheet->setCellValue('B' . ($key + 3), $employee->employee_id);
            foreach ($assignedRules as $assignedRule) {
                if (in_array($assignedRule->salary_rule_id, array_keys($columnCells))) {
                    $sheet->setCellValue(
                        $columnCells[$assignedRule->salary_rule_id] . ($key + 3),
                        $assignedRule->amount
                    );
                }
            }
        }
        try {
            $this->designExcelFile($sheet);
            $this->colorMostFrequentCode($sheet);
        } catch (Exception $e) {
            Log::error($e->getMessage() . ' ' . $e->getTraceAsString());
        }
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xls($spreadsheet);
        $path = public_path() . '/files/contract_assign_rules_data_import_sample.xls';
        $writer->save($path);
    }

    public function validateImportedContractRulesData(
        $data
    ) {
        $errList = [];
        $salaryRuleCodes = $this->salaryRuleRepository->findBy(['amount_type' => 3])->pluck('code')->toArray();
        $importedRuleCodes = $data[1];
        unset($importedRuleCodes[0]);
        unset($importedRuleCodes[1]);
        foreach ($importedRuleCodes as $key => $importedRuleCode) {
            if (!in_array($importedRuleCode, $salaryRuleCodes)) {
                $errList[1][$key] = __('accounts::employee-contract.wrong_rule_code');
            }
        }
        foreach ($data as $key => $datum) {
            if ($key < 2) {
                continue;
            }
            $employee = $this->employeeService->findBy(['employee_id' => $datum[1]])->first();
            if (!is_null($employee)) {
                $contract = $employee->employeeContract;
                if (is_null($contract)) {
                    $errList[$key][1] = __('accounts::employee-contract.no_contract');
                }
            } else {
                $errList[$key][1] = __('accounts::employee-contract.wrong_employee_id');
            }
            //if(!is_numeric($datum[3])) $errList[$key][3] = __('accounts::employee-contract.invalid_amount');
        }
        return $errList;
    }

    /**
     * @param Worksheet $sheet
     * @throws Exception
     */
    private function designExcelFile(Worksheet $sheet)
    {
        $highestRowAndColumn = $sheet->getHighestRowAndColumn();

        // increase width
        for ($column = 'A'; $column != $highestRowAndColumn['column']; $column++) {
            $sheet->getColumnDimension($column)->setWidth(20);
        }
        // increase height
        for ($row = '0'; $row <= $highestRowAndColumn['row']; $row++) {
            $sheet->getRowDimension($row)->setRowHeight(22);
        }
        $allCellRange = 'A1:' . $highestRowAndColumn['column'] . $highestRowAndColumn['row'];
        // Wrap Text
        $sheet->getStyle($allCellRange)->getAlignment()->setWrapText(true);
        // align vertical and horizonal
        $sheet->getStyle($allCellRange)
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle($allCellRange)
            ->getAlignment()
            ->setVertical(Alignment::VERTICAL_CENTER);
    }

    /**
     * Get the cell value
     * @param $sheet
     * @param $column
     * @param $row
     * @return mixed
     */
    private function getCellValue($sheet, $column, $row)
    {
        $cell = null;
        if ($sheet->cellExists($column . $row)) {
            $cell = $sheet->getCell($column . $row);
        }
        return $cell->getValue();
    }

    /**
     * @param Worksheet $sheet
     * @throws Exception
     */
    private function colorMostFrequentCode(Worksheet $sheet): void
    {
        $highestRowAndColumn = $sheet->getHighestRowAndColumn();
        $frequentlyUsedSalaryCode = ['WEE', 'TRANS', 'MISC'];
        for ($column = 'A'; $column != $highestRowAndColumn['column']; $column++) {
            $value = $this->getCellValue($sheet, $column, 2);
            if (in_array($value, $frequentlyUsedSalaryCode)) {
                //dd($value, $frequentlyUsedSalaryCode);
                $sheet->getStyle($column . '2:' . $column . $highestRowAndColumn['row'])
                    ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);
            }
        }
    }
}

