<?php

namespace Modules\Accounts\Http\Controllers;

use App\Constants\NotificationType as NotificationTypeConstant;
use App\Entities\Notification\Notification;
use App\Jobs\PayrollReportExportJob;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Accounts\Entities\Payslip;
use Modules\Accounts\Exports\Payroll\PayslipBatchExport;
use Modules\Accounts\Exports\Payroll\PayslipExport;
use Modules\Accounts\Exports\Payroll\PayslipIndividualExport;
use Modules\Accounts\Services\EmployeeContractService;
use Modules\Accounts\Services\PayscaleService;
use Modules\Accounts\Services\PayslipBatchService;
use Modules\Accounts\Services\PayslipDetailService;
use Modules\Accounts\Services\PayslipReportService;
use Modules\Accounts\Services\PayslipService;
use Modules\Accounts\Services\SalaryRuleService;
use Modules\Accounts\Services\SalaryStructureService;
use Modules\HRM\Entities\Employee;
use Modules\HRM\Services\EmployeeService;
use Nexmo\Account\Config;
use PhpOffice\PhpSpreadsheet\Exception;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class PayslipReportController extends Controller
{

    const REPORT_PATH = '/files/Reports.xlsx';
    const MAX_PAYSLIP_THRESHOLD = 100;
    private $employeeService;
    private $employeeContractService;
    private $salaryStructureService;
    private $payslipDetailService;
    private $payscaleService;
    private $payslipBatchService;
    private $salaryRuleService;
    /**
     * @var PayslipReportService
     */
    private $payslipReportService;


    public function __construct(
        EmployeeService $employeeService,
        EmployeeContractService $employeeContractService,
        SalaryStructureService $salaryStructureService,
        PayslipDetailService $payslipDetailService,
        PayscaleService $payscaleService,
        PayslipBatchService $payslipBatchService,
        PayslipReportService $payslipReportService,
        SalaryRuleService $salaryRuleService
    ) {
        $this->employeeService = $employeeService;
        $this->employeeContractService = $employeeContractService;
        $this->salaryStructureService = $salaryStructureService;
        $this->payslipDetailService = $payslipDetailService;
        $this->payscaleService = $payscaleService;
        $this->payslipBatchService = $payslipBatchService;
        $this->payslipReportService = $payslipReportService;
        $this->salaryRuleService = $salaryRuleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('accounts::payroll.payslip.report.index');
    }

    /**
     * Show the form for creating a new resource.
     *
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
        $grades = $this->payscaleService->getSalaryBasicsForDropdown();
        $employees = $this->employeeService->getEmployeesForDropdown($implementedValue, $implementedKey,
            null, false);
        $salaryStructures = $this->salaryStructureService->getSalaryStructuresForDropdown(null,
            null, ['is_parent' => null], false);
        $salaryRules = $this->salaryRuleService->getRulesForDropdown();
        $types = Payslip::getTypesForDropdown();
        $payslips = [];
        return view('accounts::payroll.payslip.report.create', compact(
            'employees',
            'salaryStructures',
            'grades',
            'payslips',
            'salaryRules',
            'types'
        ));
    }

    /**
     * This methods filter payslips by various parameters
     * used by the ajax routes
     * @param Request $request
     * @return Builder[]|Collection|\Illuminate\Support\Collection
     */
    public function filter(Request $request)
    {
        return $this->payslipReportService->filter($request->all());
    }


    /**
     * Redirected from route
     * Export a single excel of payslip for an employee
     * @param Payslip $payslip
     * @return BinaryFileResponse
     */
    public function export(Payslip $payslip)
    {
        $fileName = $payslip->payslip_name . '.xlsx';
        try {
            return Excel::download(new PayslipIndividualExport(
                $payslip,
                app('Modules\Accounts\Services\PayslipService')
            ), $fileName);
        } catch (\Exception $e) {
            Session::flash('error', 'Something Went Wrong');
            Log::error($e->getMessage());
            return redirect()->route('payslips.reports.create');
        }
    }

    /**
     * @param Request $request
     *
     * @return BinaryFileResponse
     */
    public function batchExport(Request $request)
    {
        $payslips = $this->filter($request);
        $reportType = $request->report_type;
        $salaryStructures = $request->salary_structures;
        $salaryRulesId = $request->salary_rules;
        return $this->runPayslip(compact('reportType', 'payslips', 'salaryStructures', 'salaryRulesId'));
    }


    /**
     * @param $compact
     *
     * @return BinaryFileResponse
     */
    private function runPayslip($compact)
    {
        try {
            $totalPayslips = $compact['payslips']->count();
            if ($totalPayslips <= self::MAX_PAYSLIP_THRESHOLD) {
                return Excel::download(new PayslipBatchExport($compact), 'Reports.xlsx');
            }
            // https://laracasts.com/discuss/channels/laravel/url-problem-with-queued-jobs
            // beacause in Jobs, Route method cant read the base_url from the request header
            // instead it reads from the configuration
            $baseUrl = route('excel-export-download');
            $compact['baseUrl'] = $baseUrl;
            PayrollReportExportJob::dispatch(Auth::user(), $compact)->onConnection('database');
            return back()->withSuccess(trans('accounts::payroll.payslip_report.start'));
        } catch (\Exception $e) {
            Session::flash('error', trans('labels.generic_error_message'));
            Log::error($e->getMessage() . ' Trace: ' . $e->getTraceAsString());
            return redirect()->route('payslips.reports.create');
        }
    }

    public function reportDownload()
    {
        $file = public_path() . PayslipReportController::REPORT_PATH;
        return \response()->download($file, 'Reports.xlsx');
    }
}
