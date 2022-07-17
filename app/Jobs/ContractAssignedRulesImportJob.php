<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Modules\Accounts\Entities\EmployeeContractAssignedRule;
use Modules\Accounts\Services\SalaryStructureService;
use Modules\HRM\Services\EmployeeService;

class ContractAssignedRulesImportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var array
     */
    private $data;

    /**
     * Create a new job instance.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @param EmployeeService $employeeService
     * @param SalaryStructureService $salaryStructureService
     * @return void
     */
    public function handle(EmployeeService $employeeService, SalaryStructureService $salaryStructureService)
    {
        // Fetching Rules from columns of the imported file
        $data = $this->data;
        $rules = $data[1];
        unset($rules[0], $rules[1]);
        //$employeeData = $data['employee_ids'];
        foreach ($data as $key => $datum) {
            if ($key < 2) {
                continue;
            }
            $employee = $employeeService->findBy(['employee_id' => $datum[1]])->first();
            $contract = (!is_null($employee))? $employee->employeeContract : null;
            if (!is_null($employee) && !is_null($contract)) {
                // Fetching contract assigned rules from employees contract
                $contractAssignedRules = $salaryStructureService->getContractAssignedRules(
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
                        $ruleAmount = $datum[array_search($ruleCode, $rules)]?? 0;
                        if ($assignedRule['assigned_rule_id']) {
                            EmployeeContractAssignedRule::where('id', $assignedRule['assigned_rule_id'])
                                ->update(['amount'=> $ruleAmount, 'updated_at' => date('Y-m-d h:i:s')]);
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
    }
}
