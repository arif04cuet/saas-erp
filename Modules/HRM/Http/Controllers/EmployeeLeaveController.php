<?php

namespace Modules\HRM\Http\Controllers;

use App\Utilities\EnToBnNumberConverter;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Modules\HRM\Constants\LeaveTypes;
use Modules\HRM\Http\Requests\EmployeeLeaveCreateRequest;
use Modules\HRM\Entities\LeaveRequest;
use Modules\HRM\Services\EmployeeService;
use Modules\HRM\Services\LeaveCalculationService;
use Modules\HRM\Services\LeaveRequestService;
use Modules\HRM\Services\LeaveTypeService;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;
use App\Imports\LeaveImport;
use function foo\func;


class EmployeeLeaveController extends Controller
{
    private $leaveTypeService;
    private $leaveRequestService;
    /**
     * @var LeaveCalculationService
     */
    private $leaveCalculationService;

    /**
     * @var EmployeeService
     */
    private $employeeService;

    /**
     * EmployeeLeaveController constructor.
     * @param LeaveTypeService $leaveTypeService
     * @param LeaveRequestService $leaveRequestService
     * @param LeaveCalculationService $leaveCalculationService
     * @param EmployeeService $employeeService
     */
    public function __construct(
        LeaveTypeService $leaveTypeService,
        LeaveRequestService $leaveRequestService,
        LeaveCalculationService $leaveCalculationService,
        EmployeeService $employeeService
    ) {
        $this->leaveTypeService = $leaveTypeService;
        $this->leaveRequestService = $leaveRequestService;
        $this->leaveCalculationService = $leaveCalculationService;
        $this->employeeService = $employeeService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $leaveRequests = $this->leaveRequestService->findAll(
            null,
            null,
            ['column' => 'id', 'direction' => 'desc']
        )->filter($this->isRequesterOrRecipient())->all();
        return view('hrm::leave.index', compact('leaveRequests'));
    }

    /**
     * Show the form for creating a new resource.
     * @return RedirectResponse
     */
    public function create()
    {
        $user = Auth::user();

        if (!$this->leaveRequestService->canUserApplyForLeave()) {
            return redirect()->back()->with('error', trans('error.employee_active_leave'));
        }

        $employeeJoiningDate = Arr::get($user, 'employee.employeePersonalInfo.job_joining_date');

        if (is_null($employeeJoiningDate)) {
            abort(500, trans('error.employee_null_joining_date'));
        }

        $preCalculatedLeaves = $this->leaveTypeService->getLeaveTypes()
            ->map(function ($type) {
                if ($type->name == LeaveTypes::PostRetirementLeave) {
                    $type->pre_calculated = true;
                    $type->pre_calculated_leaves = $this->leaveRequestService->availablePRLLeave();
                } else {
                    $type->pre_calculated = false;
                }

                return [
                    'id' => $type->id,
                    'pre_calculated' => $type->pre_calculated,
                    'pre_calculated_leaves' => $type->pre_calculated_leaves,
                ];
            })->values();
        $restAndRecreationalLeave = $this->leaveTypeService->getRestAndRecreationalLeave() ?? null;
        $leaveTypeOptions = $this->leaveTypeService->getLeaveTypeOptions();

        return view(
            'hrm::leave.create',
            compact(
                'user',
                'restAndRecreationalLeave',
                'leaveTypeOptions',
                'preCalculatedLeaves'
            )
        );
    }

    /**
     * @param EmployeeLeaveCreateRequest $employeeLeaveCreateRequest
     * @return RedirectResponse
     */
    public function store(EmployeeLeaveCreateRequest $employeeLeaveCreateRequest)
    {
        if (!$this->leaveRequestService->canUserApplyForLeave()) {
            return redirect()->route('leaves.index')->with('error', trans('error.employee_active_leave'));
        }

        $divisionalDirector = $this->employeeService->getDivisionalDirectorByDepartmentId(Auth::user()->employee->department_id);
        if (is_null($divisionalDirector)) {
            Session::flash('error', trans('labels.no_divisional_director'));
            return redirect()->route('leaves.index');
        }

        if ($this->leaveRequestService->store($employeeLeaveCreateRequest->all())) {
            if (Session::has('success')) {
                $message = Session::get('success');
            }
            Session::flash('success', $message);
        } else {
            Session::flash('error', trans('labels.save_fail'));
        }

        return redirect()->route('leaves.index');
    }

    public function show(LeaveRequest $leaveRequest)
    {
        return view('hrm::leave.show', compact('leaveRequest'));
    }

    public function edit(LeaveRequest $leaveRequest)
    {
        return view('hrm::leave.edit', compact('leaveRequest'));
    }

    public function update(Request $request, LeaveRequest $leaveRequest)
    {
        $lasValidDate = Carbon::createFromFormat('d/m/Y', $request->input('start_date'))
            ->addDays(839);

        $request->validate([
            'start_date' => 'required|date_format:d/m/Y|after_or_equal:' . date('d/m/Y'),
            'end_date' => 'required|date_format:d/m/Y|after_or_equal:start_date|before_or_equal:' . $lasValidDate->format('d/m/Y'),
        ]);

        if ($this->leaveRequestService->updateLeaveRequest($leaveRequest, $request->all())) {
            Session::flash('success', trans('labels.update_success'));
        } else {
            Session::flash('error', trans('labels.update_fail'));
        }

        return redirect()->route('hrm-leave-request.workflow.show', $leaveRequest->id);
    }

    /**
     * @return Closure
     */
    private function isRequesterOrRecipient(): Closure
    {
        return function ($leaveRequest) {
            return ($leaveRequest->requester_id == Auth::id() || $leaveRequest->isRecipient());
        };
    }

    public function checkLeaveByDate($startDate, $endDate)
    {
        return $this->leaveRequestService->checkLeaveApplication(Auth::user()->id, $startDate, $endDate);
    }

    /**
     * @param $leaveTypeId
     * @return array
     */
    public function checkLeaveBalance($leaveTypeId)
    {

        $leaveType = $this->leaveTypeService->findOne($leaveTypeId);
        $leaveType = $this->leaveCalculationService->updateYearAndMaxDaysOfLeave($leaveType);
        $balance = $this->leaveCalculationService->getLeaveBalanceByType($leaveTypeId);

        //For Hospital Leave and Special Disability Leave
        $multiLeaveTypeId = $this->leaveRequestService->checkMultipleEarnedLeaveOrNot($leaveType);
        if ($multiLeaveTypeId) {
            $multiLeaveBalance = $this->leaveCalculationService->getLeaveBalanceByType($multiLeaveTypeId);
            $balance[1] = $leaveType->maximum_allowed_days - $multiLeaveBalance[0] - $balance[0];
        }

        $calculateExtraLeave = $this->leaveRequestService->getEmployeeExtraLeaveByType($leaveTypeId);
        $leavePurposeMaxAllowedDays = $this->leaveCalculationService->getLeavePurposeMaxDays($leaveType);

        // sum extra leave and available leave
        $balance[1] = $balance[1] + $calculateExtraLeave;

        $earnedLeaveBalance = null;
        if ($leaveType->mother_type_id) {
            $motherTypeId = $leaveType->mother_type_id;
            $earnedLeaveBalance =  $this->leaveCalculationService->getBalanceForEarnedLeaves($motherTypeId);
        }

        // push purpose leave data
        array_push($balance, $leaveType->maximum_allowed_days);
        array_push($balance, $leavePurposeMaxAllowedDays);
        array_push($balance, $earnedLeaveBalance);


        return $balance;
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function cancel($id)
    {
        if ($this->leaveRequestService->cancel($id)) {
            return redirect()->back()->with('success', __('labels.update_success'));
        } else {
            return redirect()->back()->with('error', __('labels.update_fail'));
        }
    }

    /**
     * @param $id
     */
    public function editEmployeeLeave($id)
    {
        $leaveTypeOptions = $this->leaveTypeService->getLeaveTypeOptions();
        $employeeId = $id;

        return view('hrm::leave.balance.create', compact('leaveTypeOptions', 'employeeId'));
    }

    public function updateEmployeeLeave(Request $request): RedirectResponse
    {
        $data = $request->all();

        $this->leaveRequestService->updateEmployeeLeave($data);

        return redirect()->route('leave-balances.index')->with('success',  __('labels.update_success'));
    }


    public function importConsumedLeave()
    {

        return view('hrm::leave.import_leave');
    }

    public function importConsumedLeaveStore(Request $request)
    {
        try {
            Excel::import(new LeaveImport(), request()->file('attachment'));
            Session::flash('success', 'Imported Successfully');
            return redirect()->back();
        } catch (\Exception $e) {
            Log::error('Consumed Leave Import Error ' . $e->getMessage() . "  " . $e->getTraceAsString());
            Session::flash('error', 'Import failed');
            return redirect()->back();
        }
    }
}
