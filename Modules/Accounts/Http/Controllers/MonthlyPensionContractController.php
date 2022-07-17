<?php

namespace Modules\Accounts\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;
use Modules\Accounts\Http\Requests\MonthlyPensionContractRequest;
use Modules\Accounts\Services\MonthlyPensionContractService;
use Modules\Accounts\Services\PensionNomineeService;
use Modules\HRM\Services\EmployeeService;

class MonthlyPensionContractController extends Controller
{
    /**
     * @var MonthlyPensionContractService
     */
    private $monthlyPensionContractService;
    /**
     * @var EmployeeService
     */
    private $employeeService;
    /**
     * @var PensionNomineeService
     */
    private $pensionNomineeService;

    /**
     * MonthlyPensionContractController constructor.
     * @param MonthlyPensionContractService $monthlyPensionContractService
     * @param EmployeeService $employeeService
     * @param PensionNomineeService $pensionNomineeService
     */
    public function __construct(
        MonthlyPensionContractService $monthlyPensionContractService,
        EmployeeService $employeeService,
        PensionNomineeService $pensionNomineeService
    ) {
        $this->monthlyPensionContractService = $monthlyPensionContractService;
        $this->employeeService = $employeeService;
        $this->pensionNomineeService = $pensionNomineeService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $pensionContracts = $this->monthlyPensionContractService->findAll();
        return view('accounts::monthly-pension.contract.index', compact('pensionContracts'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $employees = $this->employeeService->getEmployeesForDropdown(
            null,
            null,
            ['is_retired' => 1], 
            true
        );
        $page = 'create';
        return view('accounts::monthly-pension.contract.create', compact('employees', 'page'));
    }

    /**
     * Store a newly created resource in storage.
     * @param MonthlyPensionContractRequest $request
     * @return Response
     */
    public function store(MonthlyPensionContractRequest $request)
    {
        $this->monthlyPensionContractService->saveData($request->all());
        return redirect(route('monthly-pension-contracts.index'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $pensionContract = $this->monthlyPensionContractService->findOne($id);
        return view('accounts::monthly-pension.contract.show', compact('pensionContract'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $pensionContract = $this->monthlyPensionContractService->findOne($id);
        $pensionNominees = $this->pensionNomineeService->findAll()->each(function ($item) {
            return $item->titel = App::getLocale() == 'bn' ? $item->bangla_name : $item->name;
        })->pluck('title', 'id');
        $employees = $this->employeeService->getEmployeesForDropdown(
            null,
            null,
            ['id' => $pensionContract->employee_id],
            false
        );
        $page = 'edit';
        return view('accounts::monthly-pension.contract.create', compact(
            'pensionContract',
            'employees',
            'page'
        ));
    }

    /**
     * Update the specified resource in storage.
     * @param MonthlyPensionContractRequest $request
     * @param int $id
     * @return Response
     */
    public function update(MonthlyPensionContractRequest $request, $id)
    {
        $this->monthlyPensionContractService->updateData($request->all(), $id);
        return redirect(route('monthly-pension-contracts.show', $id));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        $this->monthlyPensionContractService->delete($id);
        return redirect(route('monthly-pension-contracts.index'))
            ->with('success', __('labels.delete_success'));
    }

    public function activate($id)
    {
        $this->monthlyPensionContractService->toggleActivation($id);
        return redirect()->back()->with('success', __('labels.update_success'));
    }

    public function getInitialBasic($employeeId, $hasIncrement = false)
    {
        return $this->monthlyPensionContractService->getInitialBasic($employeeId, $hasIncrement);
    }
}
