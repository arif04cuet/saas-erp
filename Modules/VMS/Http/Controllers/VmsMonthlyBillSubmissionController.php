<?php

namespace Modules\VMS\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Modules\VMS\Services\VmsMonthlyBillSubmissionService;

class VmsMonthlyBillSubmissionController extends Controller
{
    /**
     * @var VmsMonthlyBillSubmissionService
     */
    private $vmsMonthlyBillSubmissionService;


    public function __construct(VmsMonthlyBillSubmissionService $vmsMonthlyBillSubmissionService)
    {
        $this->vmsMonthlyBillSubmissionService = $vmsMonthlyBillSubmissionService;
    }


    /**
     * Show the form for creating a new resource.
     * @return Factory|Application|Response|View
     */
    public function create()
    {
        $method = 'get';
        return view('vms::bill-sector.submission.create', compact('method'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Factory|Application|Response|View
     */
    public function store(Request $request)
    {
        // read this thread https://github.com/briannesbitt/Carbon/issues/249
        $date = Carbon::parse('01'.$request['date']);
        $method = $request->getMethod();
        $employees = $this->vmsMonthlyBillSubmissionService->getEmployees();
        $employees = $this->vmsMonthlyBillSubmissionService->calculateEmployeeBills($employees, $date);
        return view('vms::bill-sector.submission.create', compact('method', 'employees', 'date'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function submit(Request $request)
    {
        if ($this->vmsMonthlyBillSubmissionService->submitBill($request->all())) {
            return redirect()->route('vms.monthly-bill.create')->with('success', trans('labels.save_success'));
        } else {
            $errorMsg = trans('labels.generic_error_message');
            if (Session::has('error')) {
                $errorMsg = Session::get('error');
            }
            return redirect()->route('vms.monthly-bill.create')->with('error', $errorMsg);
        }

    }

}
