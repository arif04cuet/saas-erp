<?php

namespace Modules\Accounts\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\Accounts\Http\Requests\CreateMonthlyPensionRequest;
use Modules\Accounts\Services\MonthlyPensionService;
use Modules\HRM\Services\EmployeeService;
use Nwidart\Modules\Json;

class MonthlyPensionController extends Controller
{
    /**
     * @var MonthlyPensionService
     */
    private $monthlyPensionService;
    /**
     * @var EmployeeService
     */
    private $employeeService;

    /**
     * MonthlyPensionController constructor.
     * @param MonthlyPensionService $monthlyPensionService
     * @param EmployeeService $employeeService
     */
    public function __construct(
        MonthlyPensionService $monthlyPensionService,
        EmployeeService $employeeService
    ) {
        $this->monthlyPensionService = $monthlyPensionService;
        $this->employeeService = $employeeService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $monthlyPensions = $this->monthlyPensionService->getMonthlyPensions();
        return view('accounts::monthly-pension.index', compact('monthlyPensions'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $occasionalRules = $this->monthlyPensionService->getOccasionalPensionRules();
        $page = 'create';
        return view('accounts::monthly-pension.create', compact('occasionalRules', 'page'));
    }

    /**
     * Store a newly created resource in storage.
     * @param CreateMonthlyPensionRequest $request
     * @return Response
     */
    public function store(CreateMonthlyPensionRequest $request)
    {
        $this->monthlyPensionService->createMonthlyPension($request->all());
        return redirect(route('monthly-pensions.index'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $monthlyPension = $this->monthlyPensionService->findOne($id);
        $pensions = $monthlyPension->employeeAllPensions ?? [];
        $latestMonthData = $pensions[$pensions->count() - 1];
        return view('accounts::monthly-pension.show', compact('monthlyPension', 'pensions', 'latestMonthData'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('accounts::edit');
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
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->monthlyPensionService->delete($id);
        return redirect()->route('monthly-pensions.index')->with('success', trans('labels.save_success'));
    }

    /**
     * Changes item status to 'disbursed'
     * @param $monthlyPensionId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function disburse($monthlyPensionId)
    {
        $item = $this->monthlyPensionService->findOrFail($monthlyPensionId);
        if ($item->status == 'draft') {
            $this->monthlyPensionService->update(
                $item,
                ['disburse_date' => Carbon::now(), 'status' => 'disbursed']
            );
        } else {
            Session::flash('error', __('labels.update_fail'));
        }
        return redirect()->back();
    }

    /**
     * @param $month
     * @param $bonuses
     * @param bool $onlyBonus
     * @return Json
     */
    public function fetchPensionEmployees($month, $bonuses, $onlyBonus = false)
    {
        return json_encode($this->monthlyPensionService->fetchEmployeesWithPensions(
            [$month, json_decode($bonuses)],
            [],
            $onlyBonus
        ));
    }

    public function report(Request $request)
    {
        $month = $request->month ?? null;
        $reportData = $month ? $this->monthlyPensionService->prepareReport($month) : null;

        return view('accounts::monthly-pension.report.report', compact('month', 'reportData'));
    }

    public function getBill($employeeId)
    {
        $bill = $this->monthlyPensionService->generateBillDocument($employeeId);
        if (!$bill) {
            return redirect()->back();
        }
    }
}
