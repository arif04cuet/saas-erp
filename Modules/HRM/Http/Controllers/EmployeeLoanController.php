<?php

namespace Modules\HRM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Modules\HRM\Services\EmployeeLoanCircularService;
use Modules\HRM\Services\EmployeeLoanService;

class EmployeeLoanController extends Controller
{
    /**
     * @var EmployeeLoanService
     */
    private $employeeLoanService;
    /**
     * @var EmployeeLoanCircularService
     */
    private $circularService;

    /**
     * EmployeeLoanController constructor.
     * @param EmployeeLoanService $employeeLoanService
     * @param EmployeeLoanCircularService $circularService
     */
    public function __construct(EmployeeLoanService $employeeLoanService, EmployeeLoanCircularService $circularService)
    {
        $this->employeeLoanService = $employeeLoanService;
        $this->circularService = $circularService;
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if ($approvalPermission = Auth::user()->can('hrm-user-access')) {
            $loans = $this->employeeLoanService->findAll(null, ['employee'], ['column' => 'id', 'direction' => 'desc']);
        } elseif ($employee = Auth::user()->employee) {
            $loans = $this->employeeLoanService->findBy(['employee_id' => $employee->id]);
        } else {
            $loans = [];
        }
        return view('hrm::loan.index', compact('loans', 'approvalPermission'));
    }

    /**
     * Display the list of employee wise approved loans
     * @return \Illuminate\View\View
     */
    public function loans()
    {
        $loans = $this->employeeLoanService->employeesWithApprovedLoan();
        return view('hrm::loan.list', compact('loans'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function create()
    {
        $circulars = $this->circularService->getCircularsForDropdown();
        if (count($circulars) < 2) {
            return redirect()->back()->with('error', __('hrm::employee.loan.circular.warning'));
        }
        $employees = $this->employeeLoanService->employeeListForDropdown();
        return view('hrm::loan.create', compact('employees', 'circulars'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        if ($this->employeeLoanService->store($request->all())) {
            return redirect()->route('employee-loans.index')->with('success', __('labels.save_success'));
        } else {
            return redirect()->back();
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $loan = $this->employeeLoanService->findOne($id);
        return view('hrm::loan.show', compact('loan'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('hrm::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     */
    public function approve($id)
    {
        $loan = $this->employeeLoanService->findOne($id);
        $employee = $loan->employee;
        return view('hrm::loan.approve', compact('loan', 'employee'));
    }

    public function approval(Request $request, $id)
    {
        if ($this->employeeLoanService->approval($request->all(), $id)) {
            return redirect()->route('employee-loans.index')->with('success', __('labels.update_success'));
        } else {
            return redirect()->back();
        }
    }

    public function attachment($id)
    {
        $loan = $this->employeeLoanService->findOne($id);
        $basePath = Storage::disk('internal')->path($loan->attachment);
        return response()->download($basePath);

    }
}
