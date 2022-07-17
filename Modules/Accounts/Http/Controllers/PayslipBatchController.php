<?php

namespace Modules\Accounts\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Modules\Accounts\Entities\Payslip;
use Modules\Accounts\Entities\PayslipBatch;
use Modules\Accounts\Services\JournalService;
use Modules\Accounts\Services\PayslipBatchService;
use Modules\Accounts\Services\SalaryStructureService;
use Modules\HRM\Services\EmployeeService;

class PayslipBatchController extends Controller
{
    private $payslipBatchService;
    private $employeeService;
    private $journalService;
    private $salaryStructureService;

    public function __construct(
        EmployeeService $employeeService,
        JournalService $journalService,
        SalaryStructureService $salaryStructureService,
        PayslipBatchService $payslipBatchService
    ) {
        $this->employeeService = $employeeService;
        $this->journalService = $journalService;
        $this->salaryStructureService = $salaryStructureService;
        $this->payslipBatchService = $payslipBatchService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $payslipBatches = $this->payslipBatchService->findAll();
        return view('accounts::payroll.payslip-batch.index', compact('payslipBatches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $employees = (Session::has('employees')) ? Session::get('employees') : [];
        $page = (Session::has('page')) ? Session::get('page') : 'create';
        $from = (Session::has('from')) ? Session::get('from') : date('Y-m-1');
        $to = (Session::has('to')) ? Session::get('to') : date('Y-m-t');
        $journals = $this->journalService->findAll()->pluck('name', 'id');
        $employees = $this->employeeService->ignoreMasterRollEmployees(collect($employees));
        $bonusStructures = $this->salaryStructureService->getBonusStructuresForDropdown();
        $bonus = (Session::has('bonus')) ? Session::get('bonus') : false;
        $bonusStructureId = (Session::has('bonus_structure_id')) ? Session::get('bonus_structure_id') : null;
        return view('accounts::payroll.payslip-batch.create',
            compact(
                'employees',
                'journals',
                'page',
                'from',
                'to',
                'bonus',
                'bonusStructures',
                'bonusStructureId'
            )
        );
    }

    public function postCreate(Request $request)
    {
        $page = 'store';
        $type = Payslip::getTypes()[0];
        $bonus = false;
        $bonusStructureId = $request->bonus_structure_id;
        if (isset($request->bonus)) {
            $bonus = true;
            $type = Payslip::getTypes()[1];
        }
        $employees = $this->payslipBatchService->getEmployeesWithoutPayslip(
            $request->period_from,
            $request->period_to,
            $type,
            $bonusStructureId
        );
        return redirect()->route('payslip-batches.create')
            ->with('employees', $employees)
            ->with('page', $page)
            ->with('bonus', $bonus)
            ->with('bonus_structure_id', $bonusStructureId)
            ->with('from', $request->period_from)
            ->with('to', $request->period_to);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        if (!isset($request->employees)) {
            return redirect()->back()->with('error', trans('accounts::payroll.flash_messages.select_at_least_one'));
        }
        $this->payslipBatchService->saveBatch($request->all());
        return redirect()->route('payslip-batches.index')->with('success', __('labels.save_success'));
    }

    /**
     * Show the specified resource.
     *
     * @param PayslipBatch $payslipBatch
     *
     * @return View
     */
    public function show(PayslipBatch $payslipBatch)
    {
        return view('accounts::payroll.payslip-batch.show', compact('payslipBatch'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        return view('accounts::edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     *
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
