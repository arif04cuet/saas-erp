<?php

namespace Modules\Accounts\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Modules\Accounts\Services\EmployeePromotionControllerService;
use test\Mockery\Stubs\Animal;

class EmployeePromotionController extends Controller
{
    /**
     * @var EmployeePromotionControllerService
     */
    private $employeePromotionService;

    /**
     * EmployeePromotionController constructor.
     * @param EmployeePromotionControllerService $employeePromotionControllerService
     */
    public function __construct(EmployeePromotionControllerService $employeePromotionControllerService)
    {
        $this->employeePromotionService = $employeePromotionControllerService;
    }

    /**
     * Display a listing of the resource.
     * @return Factory|Application|Response|View
     */
    public function index()
    {
        $employees = $this->employeePromotionService->getEmployees();
        $salaryGrades = $this->employeePromotionService->getSalaryGrades();
        return view('accounts::promotion.index', compact('employees', 'salaryGrades'));
    }

    public function update(Request $request)
    {
        if ($this->employeePromotionService->updateData($request->all())) {
            Session::flash('success', trans('labels.update_success'));
            return redirect()->route('accounts.promotion.index');
        } else {
            Session::flash('error', trans('labels.update_fail'));
            return redirect()->route('accounts.promotion.index');
        }
    }

}
