<?php

namespace Modules\Accounts\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\Accounts\Http\Requests\CreateGpfLoanRequest;
use Modules\Accounts\Services\GpfConfigurationService;
use Modules\Accounts\Services\GpfLoanService;
use Modules\HRM\Services\EmployeeService;

class GpfLoanController extends Controller
{
    private $gpfLoanService;
    private $employeeService;
    /**
     * @var GpfConfigurationService
     */
    private $gpfConfigurationService;

    /**
     * GpfLoanController constructor.
     * @param GpfLoanService $gpfLoanService
     * @param EmployeeService $employeeService
     * @param GpfConfigurationService $gpfConfigurationService
     */
    public function __construct(
        GpfLoanService $gpfLoanService,
        EmployeeService $employeeService,
        GpfConfigurationService $gpfConfigurationService
    ) {
        $this->gpfLoanService = $gpfLoanService;
        $this->employeeService = $employeeService;
        $this->gpfConfigurationService = $gpfConfigurationService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $loans = $this->gpfLoanService->getEmployeesWithLoan();
        return view('accounts::gpf.loan.index', compact('loans'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $employees = $this->employeeService->getEmployeesForDropdown();
        $activeConfiguration = $this->gpfConfigurationService->getActiveConfiguration();
        if (!$activeConfiguration) {
            return redirect()->back()->with('error', __('accounts::gpf.configuration.not_set'));
        }
        $maxInstallment = $activeConfiguration->max_loan_installment;
        $page = 'create';

        return view('accounts::gpf.loan.create', compact('employees', 'maxInstallment', 'page'));
    }

    /**
     * Store a newly created resource in storage.
     * @param CreateGpfLoanRequest $request
     * @return Response
     */
    public function store(CreateGpfLoanRequest $request)
    {
        $save = $this->gpfLoanService->saveData($request->all());
        return redirect(route('gpf-loans.index'))->with('success', __('labels.save_success'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $loan = $this->gpfLoanService->findOne($id);
        $employee = $loan->employee;
        $loanPayments = $this->gpfLoanService->getGpfAdvancedFromEmployeeId($employee->id);
//        $totalPaid =collect($loanPayments)->sum(function ($item) {
//            return ($item['advance_return'] != ''? $item['advance_return'] : 0) +
//                ($item['deposit'] != ''? $item['deposit'] : 0);
//        });

        return view('accounts::gpf.loan.show', compact('loan', 'employee', 'loanPayments'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $loan = $this->gpfLoanService->findOne($id);
        $employees = $this->employeeService->getEmployeesForDropdown();
        $activeConfiguration = $this->gpfConfigurationService->getActiveConfiguration();
        if (!$activeConfiguration) {
            return redirect()->back()->with('error', __('accounts::gpf.configuration.not_set'));
        }
        $maxInstallment = $activeConfiguration->max_loan_installment;
        $loanLimit = $this->gpfLoanLimit($loan->employee_id);
        $page = 'edit';

        return view('accounts::gpf.loan.create', compact(
            'loan',
            'employees',
            'maxInstallment',
            'loanLimit',
            'page'
        ));
    }

    /**
     * Update the specified resource in storage.
     * @param CreateGpfLoanRequest $request
     * @param int $id
     * @return Response
     */
    public function update(CreateGpfLoanRequest $request, $id)
    {
        $response = $this->gpfLoanService->updateData($request->all(), $id);
        if($response)
            Session::flash('success', __('labels.update_success'));
        else
            Session::flash('error', __('labels.update_fail'));

        return redirect(route('gpf-loans.show', $id));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        $this->gpfLoanService->delete($id);
        return redirect()->back()->with('success', __('labels.delete_success'));
    }

    public function gpfLoanLimit($employeeId)
    {
        return $this->gpfLoanService->getMaxLoanLimit($employeeId);
    }
}
