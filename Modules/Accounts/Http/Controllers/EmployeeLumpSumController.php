<?php

namespace Modules\Accounts\Http\Controllers;

use App\Utilities\EnToBnNumberConverter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Modules\Accounts\Entities\EmployeeLumpSum;
use Modules\Accounts\Entities\PensionDeduction;
use Modules\Accounts\Services\EconomyCodeService;
use Modules\Accounts\Services\EmployeeLumpSumService;
use Modules\Accounts\Services\LumpSumDeductionService;
use Modules\Accounts\Services\MonthlyPensionContractService;
use Modules\Accounts\Services\PayscaleService;
use Modules\Accounts\Services\PensionConfigurationService;
use Modules\Accounts\Services\PensionDeductionService;
use Modules\Accounts\Services\PostRetirementLeaveEmployeeService;
use Modules\HRM\Services\EmployeeService;

class EmployeeLumpSumController extends Controller
{


    private $service;
    private $pensionConfigurationService;
    private $postRetirementLeaveEmployeeService;
    private $employeeService;
    private $payscaleService;
    private $economyCodeService;
    private $lumpSumDeductionService;
    private $pensionDeductionService;
    /**
     * @var MonthlyPensionContractService
     */
    private $monthlyPensionContractService;

    /**
     * EmployeeLumpSumController constructor.
     * @param EmployeeLumpSumService $employeeLumpSumService
     * @param PensionConfigurationService $pensionConfigurationService
     * @param EmployeeService $employeeService
     * @param PayscaleService $payscaleService
     * @param EconomyCodeService $economyCodeService
     * @param LumpSumDeductionService $lumpSumDeductionService
     * @param PostRetirementLeaveEmployeeService $postRetirementLeaveEmployeeService
     * @param PensionDeductionService $pensionDeductionService
     * @param MonthlyPensionContractService $monthlyPensionContractService
     */
    public function __construct(
        EmployeeLumpSumService $employeeLumpSumService,
        PensionConfigurationService $pensionConfigurationService,
        EmployeeService $employeeService,
        PayscaleService $payscaleService,
        EconomyCodeService $economyCodeService,
        LumpSumDeductionService $lumpSumDeductionService,
        PostRetirementLeaveEmployeeService $postRetirementLeaveEmployeeService,
        PensionDeductionService $pensionDeductionService,
        MonthlyPensionContractService $monthlyPensionContractService
    ) {
        $this->service = $employeeLumpSumService;
        $this->pensionConfigurationService = $pensionConfigurationService;
        $this->employeeService = $employeeService;
        $this->payscaleService = $payscaleService;
        $this->postRetirementLeaveEmployeeService = $postRetirementLeaveEmployeeService;
        $this->economyCodeService = $economyCodeService;
        $this->lumpSumDeductionService = $lumpSumDeductionService;
        $this->pensionDeductionService = $pensionDeductionService;
        $this->monthlyPensionContractService = $monthlyPensionContractService;
    }


    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $employees = $this->service->findAll(null, null, ['column' => 'created_at', 'direction' => 'asc']);
        return view('accounts::lump-sum.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $action = "create";
        $employees = optional($this->getPensionEmployees())->pluck('employee_info', 'employee_id')->toArray();
        $query = ['pension_deduction_type' => PensionDeduction::PENSION_DEDUCTION_TYPE[0]];
        $pensionDeductions = $this->pensionDeductionService->getDeductionsForDropdown(null,
            null, $query, false);
        $activePensionConfiguration = $this->pensionConfigurationService->getActiveConfiguration();
        if (is_null($activePensionConfiguration)) {
            Session::flash('error', trans('Pension Configuration Not Found'));
        }
        return view('accounts::lump-sum.create', compact('employees', 'pensionDeductions', 'action'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        try {
            // set the status flag
            if (isset($request->disbursed)) {
                unset($request['disbursed']);
                $request['status'] = EmployeeLumpSum::status[1];
            } else {
                $request['status'] = EmployeeLumpSum::status[0];
            }
            // save the data
            DB::transaction(function () use ($request) {
                $employeeLumpSum = $this->service->save($request->except('deduction'));
                if (!is_null($employeeLumpSum) && !empty($request->deduction)) {
                    foreach ($request->deduction as $data) {
                        $data['employee_id'] = $employeeLumpSum->employee_id;
                        $this->lumpSumDeductionService->save($data);
                    }
                }
            });
            return redirect()->route('lump-sum.index')
                ->with('success', trans('labels.save_success'));
        } catch (\Exception $e) {
            Log::error($e);
            return redirect()->route('lump-sum.index')
                ->with('error', trans('labels.save_fail') . $e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show(EmployeeLumpSum $employeeLumpSum)
    {
        return view('accounts::lump-sum.show', compact('employeeLumpSum'));
    }

    /**
     * Return  the specified resource in JSon.
     * @param $pensionContractId
     * @return Model
     */
    public function jsonShow($employeeId)
    {
        $pensionContract = $this->monthlyPensionContractService->findBy([
            'employee_id' => $employeeId,
            'status' => 'active'
        ])->first();
        $employee = optional($pensionContract)->employee;
        $contract = optional($employee)->employeeContract;
        $grade = optional($contract)->salary_grade ?? 0;
        $payrollIncrement = optional($contract)->increment ?? 0;
        $incrementNumber = $pensionContract->has_payroll_increment ?
            $this->payscaleService->nextApplicableIncrement($grade, $payrollIncrement) : $payrollIncrement;
        $basicSalary = $this->payscaleService->getBasicSalary($grade, $incrementNumber);
        $pensionConfiguration = $this->pensionConfigurationService->getActiveConfiguration();
        return response()->json([
            'employee' => $employee,
            'basic_salary' => $basicSalary,
            'pensionConfiguration' => $pensionConfiguration,

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit(EmployeeLumpSum $employeeLumpSum)
    {
        $action = 'edit';
        $employees = optional($this->getPensionEmployees())->pluck('employee_info', 'employee_id')->toArray();
        $query = ['pension_deduction_type' => PensionDeduction::PENSION_DEDUCTION_TYPE[0]];
        $pensionDeductions = $this->pensionDeductionService->getDeductionsForDropdown(null,
            null, $query, false);
        return view('accounts::lump-sum.edit',
            compact('employeeLumpSum', 'action', 'employees', 'pensionDeductions'
            ));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param EmployeeLumpSum $employeeLumpSum
     * @return Response
     */
    public function update(Request $request, EmployeeLumpSum $employeeLumpSum)
    {
        if (isset($request->disbursed)) {
            unset($request['disbursed']);
            $request['status'] = EmployeeLumpSum::status[1];
        } else {
            $request['status'] = EmployeeLumpSum::status[0];
        }
        // delete all the associate rowns
        DB::transaction(function () use ($request, $employeeLumpSum) {
            $this->service->update($employeeLumpSum, $request->except('deduction'));
            $employeeLumpSum->deductions()->delete();
            if (isset($request->deduction) && !is_null($request->deduction)) {
                foreach ($request->deduction as $data) {
                    $data['employee_id'] = $employeeLumpSum->employee_id;
                    $this->lumpSumDeductionService->save($data);
                }
            }
        });
        return redirect()->route('lump-sum.show', $employeeLumpSum->id)
            ->with('success', trans('labels.save_success'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function markAsDisbursed(EmployeeLumpSum $employeeLumpSum)
    {
        if ($employeeLumpSum->update(['status' => EmployeeLumpSum::status[1]])) {
            return redirect()->route('lump-sum.index')->with('success', trans('labels.update_success'));
        } else {
            return redirect()->route('lump-sum.index')->with('success', trans('labels.update_success'));
        }
    }

    public function getPensionEmployees()
    {
        return $this->monthlyPensionContractService->findBy(['status' => 'active'])->each(function ($item) {
            return $item->employee_info = optional($item->employee)->employee_id . ' - ' .
                optional($item->employee)->getName() . ' - ' . optional($item->employee)->mobile_one;
        });
    }

    public function getBill($id)
    {
        $this->service->generateDoc($id, $this->pensionConfigurationService->getActiveConfiguration());
        //$fileName = storage_path() . '/files/temps/' . $employee->employee_id . '_lump_sum_bill.docx';
        //return \response()->download($path, $path);

    }
}
