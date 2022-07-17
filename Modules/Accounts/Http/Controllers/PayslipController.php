<?php

namespace Modules\Accounts\Http\Controllers;

use App\Exports\PayslipBatchExport;
use App\Exports\PayslipIndividualExport;
use http\Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Accounts\Entities\Payslip;
use Modules\Accounts\Entities\SalaryCategory;
use Modules\Accounts\Entities\SalaryRule;
use Modules\Accounts\Services\EconomyHeadService;
use Modules\Accounts\Services\EmployeeContractService;
use Modules\Accounts\Services\PayscaleService;
use Modules\Accounts\Services\PayslipDetailService;
use Modules\Accounts\Services\PayslipService;
use Modules\Accounts\Services\SalaryRuleService;
use Modules\Accounts\Services\SalaryStructureService;
use Modules\HRM\Entities\Employee;
use Modules\HRM\Services\EmployeeService;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use function foo\func;

class PayslipController extends Controller
{
    private $employeeService;
    private $economyHeadService;
    private $employeeContractService;
    private $salaryStructureService;
    private $salaryRuleService;
    private $payslipService;
    private $payslipDetailService;
    private $payscaleService;

    public function __construct(
        EmployeeService $employeeService,
        EconomyHeadService $economyHeadService,
        EmployeeContractService $employeeContractService,
        SalaryStructureService $salaryStructureService,
        SalaryRuleService $salaryRuleService,
        PayslipService $payslipService,
        PayslipDetailService $payslipDetailService,
        PayscaleService $payscaleService
    ) {
        $this->employeeService = $employeeService;
        $this->economyHeadService = $economyHeadService;
        $this->employeeContractService = $employeeContractService;
        $this->salaryStructureService = $salaryStructureService;
        $this->salaryRuleService = $salaryRuleService;
        $this->payslipService = $payslipService;
        $this->payslipDetailService = $payslipDetailService;
        $this->payscaleService = $payscaleService;
    }

    /**
     * Display a listing of the resource.
     * @return Factory|View
     */
    public function index()
    {
        $implementedValue = function ($employee) {
            return $employee->employee_id . ' - ' . $employee->getName();
        };
        $implementedKey = function ($employee) {
            return $employee->id;
        };
        $grades = $this->payscaleService->getSalaryBasicsForDropdown();
        $employees = $this->employeeService->getEmployeesForDropdown($implementedValue, $implementedKey,
            null, false);
        $salaryStructures = $this->salaryStructureService->getSalaryStructuresForDropdown(null,
            null, ['is_parent' => null], false);
        $salaryRules = $this->salaryRuleService->getRulesForDropdown();
        $types = Payslip::getTypesForDropdown();
        $payslips = [];
        return view('accounts::payroll.payslip.index', compact('payslips', 'employees',
            'grades', 'salaryStructures', 'salaryRules', 'types'
        ));
    }

    /**
     * Show the form for creating a new resource.
     * @return Factory|View
     */
    public function create()
    {
        $implementedValue = function ($employee) {
            return $employee->employee_id . ' - ' . $employee->getName();
        };
        $implementedKey = function ($employee) {
            return $employee->id;
        };
        $employees = $this->payslipService->getEmployeesForDropdown($implementedValue, $implementedKey, null, false);
        $employeeContracts = $this->employeeContractService
                ->getEmployeeContractsForDropdown()
            + ['' => ''];
        $salaryStructures = $this->salaryStructureService
                ->getSalaryStructuresForDropdown()
            + ['' => ''];
        $bonusStructures = $this->salaryStructureService->getBonusStructuresForDropdown();
        return view('accounts::payroll.payslip.create', compact(
            'employees',
            'employeeContracts',
            'salaryStructures',
            'bonusStructures'
        ));
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
        $payslip = $this->payslipService->createPayslip($request->all());
        if ($payslip) {
            return redirect()->route('payslips.show', $payslip->id);
        } else {
            return redirect()->route('payslips.create');
        }
    }

    /**
     * @param Payslip $payslip
     *
     * @return Factory|View
     */
    public function show(Payslip $payslip)
    {
        $payslipDetails = $payslip->payslipDetails;
        $deductionDetails = $this->payslipDetailService->getDeductionFromPayslipDetail($payslipDetails);
        $otherDetails = $this->payslipDetailService->getAllowanceFromPayslipDetail($payslipDetails);
        $minSalary = $payslip->employee->employeeContract->getMinSalary() ?? 0;
        $maxSalary = $payslip->employee->employeeContract->getMaxSalary() ?? 0;
        $outstandings = $this->payslipService->getAllSalaryOutstandingRulesName($payslip);
        return view('accounts::payroll.payslip.show', compact('payslip',
            'deductionDetails',
            'otherDetails',
            'payslipDetails',
            'minSalary',
            'maxSalary',
            'outstandings'
        ));
    }

    /**
     * Filter Payslips by various parameters
     * Called from ajax
     * @param Request $request
     * @return Builder[]|Collection|\Illuminate\Support\Collection
     */
    public function filter(Request $request)
    {
        $payslips = $this->payslipService->filterPayslipsByEmployees($request->all());
        if (
            (isset($request['period_from']) && !is_null($request['period_from']))
            &&
            (isset($request['period_to']) && !is_null($request['period_to']))) {
            $payslips = $this->payslipService->filterPayslipsByDateRange($payslips, $request['period_from'],
                $request['period_to']);
        }
        $payslips = $this->payslipService->filterPayslipsByTypeName($payslips, $request['type']);
        $payslips = $this->payslipService->addEmployeeNameToCollection($payslips);
        $payslips = $this->payslipService->getPayslipsSortedByDesignationAndServicePeriod($payslips);
        return $payslips;
    }

}
