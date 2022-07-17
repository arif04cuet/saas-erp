<?php

namespace Modules\Accounts\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Modules\Accounts\Entities\EmployeeSalaryOutstanding;
use Modules\Accounts\Http\Requests\CreateEmployeeContractRequest;
use Modules\Accounts\Services\EmployeeContractService;
use Modules\Accounts\Services\EmployeeSalaryOutstandingService;
use Modules\Accounts\Services\GpfService;
use Modules\Accounts\Services\PayscaleService;
use Modules\Accounts\Services\SalaryRuleService;
use Modules\Accounts\Services\SalaryStructureService;
use Modules\HRM\Services\EmployeeService;

class EmployeeContractController extends Controller
{
    private $employeeService;
    private $payscaleService;
    private $salaryStructureService;
    private $salaryRuleService;
    private $employeeContractService;
    /**
     * @var GpfService
     */
    private $gpfService;
    private $employeeSalaryOutstandingService;

    /**
     * EmployeeContractController constructor.
     * @param EmployeeService $employeeService
     * @param PayscaleService $payscaleService
     * @param SalaryStructureService $salaryStructureService
     * @param SalaryRuleService $salaryRuleService
     * @param EmployeeSalaryOutstandingService $employeeSalaryOutstandingService
     * @param EmployeeContractService $employeeContractService
     * @param GpfService $gpfService
     */
    public function __construct(
        EmployeeService $employeeService,
        PayscaleService $payscaleService,
        SalaryStructureService $salaryStructureService,
        SalaryRuleService $salaryRuleService,
        EmployeeSalaryOutstandingService $employeeSalaryOutstandingService,
        EmployeeContractService $employeeContractService,
        GpfService $gpfService
    ) {
        $this->employeeService = $employeeService;
        $this->payscaleService = $payscaleService;
        $this->salaryStructureService = $salaryStructureService;
        $this->salaryRuleService = $salaryRuleService;
        $this->employeeContractService = $employeeContractService;
        $this->employeeSalaryOutstandingService = $employeeSalaryOutstandingService;
        $this->gpfService = $gpfService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $contracts = $this->employeeContractService->findAll();
        return view('accounts::payroll.employee-contract.index', compact('contracts'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $employees = ['' => __('labels.select')] +
            $this->employeeContractService->getEmployeesWithoutContract()->toArray();
        $structures = ['' => __('labels.select')] +
            $this->salaryStructureService->getStructureForDropdown()->toArray();
        $rules = $this->salaryRuleService->getRulesForDropdown();
        //$baseStructureRules = $this->salaryStructureService->getBaseStructure()->rules;
        $gpfRule = $this->salaryRuleService->getGpfcRule();
        $grades = [__('labels.select')];
        for ($count = 1; $count <= 20; $count++) {
            array_push($grades, "Grade " . $count);
        }
        $page = 'create';

        return view('accounts::payroll.employee-contract.create', compact('employees', 'structures',
            'gpfRule', 'grades', 'page', 'rules'));
    }

    /**
     * Store a newly created resource in storage.
     * @param CreateEmployeeContractRequest $request
     * @return Response
     */
    public function store(CreateEmployeeContractRequest $request)
    {
        $this->employeeContractService->saveData($request->all());
        return redirect(route('employee-contracts.index'))->with('success', __('labels.save_success'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Factory|View
     */
    public function show($id)
    {
        $contract = $this->employeeContractService->findOne($id);
        $basicSalary = $this->getBasicSalary($contract->salary_grade, $contract->increment);
        $gpfRecords = $this->employeeContractService->getGpfHistories($contract->employee_id);
        $outstandings = $contract->employee->salaryOutstandings;
        $assignedRules = $this->employeeContractService->prepareAssignedRulesData($contract);
        $gpfRule = $this->salaryRuleService->getGpfcRule();
        $gpfPercentage = $this->gpfService->getGpfPercentage($contract->employee_id);
        return view('accounts::payroll.employee-contract.show', compact('contract', 'basicSalary',
            'gpfRecords', 'outstandings', 'assignedRules', 'gpfRule', 'gpfPercentage'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $employeeContract = $this->employeeContractService->findOne($id);
        $employees = ['' => __('labels.select')] +
            $this->employeeContractService->getEmployeesWithoutContract($employeeContract->employee_id)->toArray();
        $structures = ['' => __('labels.select')] +
            $this->salaryStructureService->getStructureForDropdown()->toArray();
        //$baseStructureRules = $this->salaryStructureService->getBaseStructure()->rules;
        $gpfRule = $this->salaryRuleService->getGpfcRule();
        $grades = [__('labels.select')];
        for ($count = 1; $count <= 20; $count++) {
            array_push($grades, "Grade " . $count);
        }
        //$rules = $this->employeeContractService->getContractAssignRules($employeeContract);
        $assignedRules = $this->employeeContractService->prepareAssignedRulesData($employeeContract);
        $basicSalary = $this->getBasicSalary($employeeContract->salary_grade, $employeeContract->increment);
        $maxIncrement = $this->payscaleService->salaryMaxIncrement($employeeContract->salary_grade);
        // outstanding data
        // pass only active outstanding of this user
        $outstandings = $this->employeeSalaryOutstandingService->findBy([
            'employee_id' => $employeeContract->employee->id,
            'status' => EmployeeSalaryOutstanding::STATUS[1]
        ])->map(function ($data) {
            return [
                'employee_id' => $data->employee_id,
                'salary_rule_id' => $data->salary_rule_id,
                'month' => $data->month,
                'amount' => $data->amount,
                'remark' => $data->remark,
            ];
        });
        $rules = $this->salaryRuleService->getRulesForDropdown();
        $gpfPercentage = $this->gpfService->getGpfPercentage($employeeContract->employee_id);
        $page = 'edit';

        return view('accounts::payroll.employee-contract.create', compact('employeeContract', 'gpfRule',
            'employees', 'structures', 'grades', 'assignedRules', 'basicSalary',
            'maxIncrement', 'page', 'outstandings', 'rules', 'gpfPercentage'));
    }

    /**
     * @param CreateEmployeeContractRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(CreateEmployeeContractRequest $request, $id)
    {
        $this->employeeContractService->updateData($request->all(), $id);
        return redirect(route('employee-contracts.show', $id))->with('success', __('labels.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */

    public function destroy($id)
    {
        $this->employeeContractService->delete($id);
        return redirect(route('employee-contracts.index'))->with('success', __('labels.delete_success'));
    }

    public function generateSample()
    {
        $this->employeeContractService->generateCSV();
        $file = public_path() . "/files/contract_assign_rules_data_import_sample.xls";

        return \response()->download($file, 'contract_assign_rules_data_import_sample.xls');
    }

    /**
     * Receives file that need to be imported and store imported data after validation
     * @param Request $request
     * @return Factory|View
     */
    public function import(Request $request)
    {
        $file_mimes = array(
            'application/octet-stream',
            'application/vnd.ms-excel',
            'application/x-csv',
            'text/x-csv',
            'text/csv',
            'application/csv',
            'application/excel',
            'application/vnd.msexcel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        );
        $contractData = [];
        $file = null;
        $errorList = array();
        if ($request->hasFile(['import_file']) && in_array($_FILES['import_file']['type'], $file_mimes)) {
            $contractData = $this->employeeContractService->importCSV($request);
            //dd($contractData);
            $errorList = $this->employeeContractService->validateImportedContractRulesData($contractData);
            if (sizeof($contractData) && !sizeof($errorList)) {
                $this->employeeContractService->storeImported($contractData);
            }
        }

        return view('accounts::payroll.employee-contract.import', compact('contractData', 'errorList'));
    }

    /**
     * Method written previously to receive request of form data fetched from the imported file
     * @param Request $request
     * @return RedirectResponse
     */
    public function storeImported(Request $request)
    {
        $this->employeeContractService->saveImported($request->all());
        if (!Session::has('error')) {
            Session::flash('success', __('labels.save_success'));
        }
        return redirect()->back();
    }

    public function getBasicSalary($grade = 0, $increment = 0)
    {
        return $this->payscaleService->getBasicSalary($grade, $increment);
    }

    public function getSalaryMaxIncrement($grade = 0)
    {
        return $this->payscaleService->salaryMaxIncrement($grade);
    }
}
