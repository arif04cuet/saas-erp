<?php

namespace Modules\Accounts\Http\Controllers;

use App\Exports\GpfStatementExport;
use Carbon\Carbon;
use Modules\Accounts\Repositories\GpfLoanRepository;
use Modules\Accounts\Services\GpfLoanService;
use function GuzzleHttp\Psr7\str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Accounts\Entities\GpfLoan;
use Modules\Accounts\Http\Requests\CreateGpfRequest;
use Modules\Accounts\Http\Requests\UpdateGpfRequest;
use Modules\Accounts\Services\GpfConfigurationService;
use Modules\Accounts\Services\GpfService;
use Modules\HRM\Services\EmployeeService;
use PhpOffice\PhpWord\Reader\Word2007;

class GpfController extends Controller
{
    private $gpfService;
    private $employeeService;
    /**
     * @var GpfConfigurationService
     */
    private $gpfConfigurationService;
    /**
     * @var GpfLoanService
     */
    private $gpfLoanService;

    /**
     * GpfController constructor.
     * @param GpfService $gpfService
     * @param EmployeeService $employeeService
     * @param GpfConfigurationService $gpfConfigurationService
     * @param GpfLoanService $gpfLoanService
     */
    public function __construct(
        GpfService $gpfService,
        EmployeeService $employeeService,
        GpfConfigurationService $gpfConfigurationService,
        GpfLoanService $gpfLoanService
    ) {
        $this->gpfService = $gpfService;
        $this->employeeService = $employeeService;
        $this->gpfConfigurationService = $gpfConfigurationService;
        $this->gpfLoanService = $gpfLoanService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $records = $this->gpfService->findAll();
        return view('accounts::gpf.index', compact('records'));
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
            null,
            true
        );
        $configuration = $this->gpfConfigurationService->getActiveConfiguration();
        if (!$configuration) {
            return redirect()->back()->with('error', __('accounts::gpf.configuration.not_set'));
        }
        $page = 'create';
        return view('accounts::gpf.create', compact('employees', 'configuration', 'page'));
    }

    /**
     * Store a newly created resource in storage.
     * @param CreateGpfRequest $request
     * @return Response
     */
    public function store(CreateGpfRequest $request)
    {
        $this->gpfService->saveData($request->all());
        return redirect(route('gpf.index'))->with('success', __('labels.save_success'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $gpf = $this->gpfService->findOne($id);
        if ($gpf) {
            $employee = $gpf->employee;
            $gpfRecords = $gpf->histories? : [];
        } else {
            return redirect()->back()->with('error', 'Item Not Found');
        }
        return view('accounts::gpf.show', compact('gpf', 'employee', 'gpfRecords'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $gpf = $this->gpfService->findOne($id);
        $employees = $this->employeeService->getEmployeesForDropdown(
            null,
            null,
            ['id' => $gpf->employee->id],
            false
        );
        $configuration = $this->gpfConfigurationService->getActiveConfiguration();
        if (!$configuration) {
            return redirect()->back()->with('error', __('accounts::gpf.configuration.not_set'));
        }
        $page = 'edit';

        return view('accounts::gpf.create', compact('gpf','employees', 'configuration', 'page'));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateGpfRequest $request
     * @param int $id
     * @return Response
     */
    public function update(UpdateGpfRequest $request, $id)
    {
        $gpf = $this->gpfService->findOrFail($id);
        $this->gpfService->updateData($request->all(), $gpf);
        return redirect(route('gpf.show', $id))->with('success', __('labels.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        Session::flash('error', 'Deleting is not allowed right now!');
        return redirect()->back();
    }

    public function personalLedger(Request $request, $employeeId)
    {
        //$saveTest = $this->gpfService->saveGpfMonthlyRecord(55);
        $yearFrom = $request->from;
        $yearTo = $request->to;

        $gpf = $this->gpfService->findBy(['employee_id' => $employeeId])->first();
        if ($gpf) {
            $employee = $gpf->employee;
        }
        if (is_null($yearFrom) && is_null($yearTo)) {
            $currentMonthValue = date('n');
            $yearFrom = ($currentMonthValue > 6)? date('Y') : date('Y')-1;
            $yearTo = $yearFrom;
        }
        $loans = $this->gpfLoanService->getLoans($employeeId);
//        $loans = GpfLoan::where('employee_id', $employeeId)
//            ->orderBy('sanction_date', 'desc')
//            ->pluck('amount', 'sanction_date')->keyBy(function ($item, $key) {
//                return date('Y-n', strtotime($key));
//            })->toArray();
        //$loans = $lo
        $fiscalYearsLedger = $this->gpfService->getPersonalLedger($employeeId, $yearFrom, $yearTo);
        return view('accounts::gpf.personal-ledger', compact(
            'gpf',
            'employee',
            'yearFrom',
            'yearTo',
            'loans',
            'fiscalYearsLedger'
        ));
    }

    public function statement(Request $request, $id)
    {
        $year = $request->year;
        $gpf = $this->gpfService->findOne($id);
        $employee = ($gpf)? $gpf->employee : null;
        $statementData = $this->gpfService->generateStatement($employee->id, $year);
        if ($request->has('export')) {
            $fileName = storage_path().'/files/temps/'.$employee->employee_id.'_gpf_statement.docx';
            $this->gpfService->generateDoc([$gpf, $employee, $year]);
            return \response()->download($fileName, $employee->getName().'_gpf_statement.docx')
                ->deleteFileAfterSend(true);
        }
        return view('accounts::gpf.statement', compact('employee', 'gpf', 'statementData', 'year'));
    }

    public function settlement($id, $settlementDate = null)
    {
        $gpf = $this->gpfService->findOne($id);
        if ($gpf) {
            $month = date('n', strtotime($settlementDate));
            $year = date('Y', strtotime($settlementDate));
            $year = ($month < 7)? $year-1 : $year;
            $dateRange = $this->gpfService->generateFiscalFromAndToDate($year, $year);
            $from = Carbon::parse($dateRange['from'])->addMonth(-1)->format('Y-m-d');
            $to = $dateRange['to'];
            $employee = $gpf->employee ?? null;
            $loans = $gpf->loans ?? null;
            $records = $this->gpfService->fetchMonthlyRecords($employee->id, $from, $to);
        }
        return view('accounts::gpf.settlement', compact(
            'gpf',
            'employee',
            'loans',
            'records',
            'settlementDate'
        ));
    }

    public function storeSettlement(Request $request, $id)
    {
        $this->gpfService->confirmSettlement($request->all(), $id);
        return redirect(route('gpf.show', $id))->with('success', __('labels.save_success'));
    }

    public function getGpfPercentageByEmployeeId($employeeId)
    {
        return $this->gpfService->getGpfPercentage($employeeId);
    }
}
