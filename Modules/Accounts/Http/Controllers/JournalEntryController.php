<?php

namespace Modules\Accounts\Http\Controllers;

use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Modules\Accounts\Entities\JournalEntry;
use Modules\Accounts\Http\Requests\StoreJournalEntry;
use Modules\Accounts\Services\AccountBalanceService;
use Modules\Accounts\Services\AccountTransactionHistoryService;
use Modules\Accounts\Services\CashBookEntryService;
use Modules\Accounts\Services\EconomyCodeService;
use Modules\Accounts\Services\EconomySectorService;
use Modules\Accounts\Services\FiscalYearService;
use Modules\Accounts\Services\JournalEntryDetailService;
use Modules\Accounts\Services\JournalEntryService;
use Modules\Accounts\Services\JournalService;
use Modules\Accounts\Services\JournalTypeService;
use Modules\HRM\Services\DepartmentService;
use Modules\HRM\Services\EmployeeService;

class JournalEntryController extends Controller
{
    /**
     * @var JournalService
     */
    private $journalService;
    /**
     * @var JournalEntryService
     */
    private $journalEntryService;
    /**
     * @var FiscalYearService
     */
    private $fiscalYearService;
    /**
     * @var EconomySectorService
     */
    private $economySectorService;
    /**
     * @var EmployeeService
     */
    private $employeeService;

    /**
     * JournalEntryController constructor.
     * @param EconomySectorService $economySectorService
     * @param JournalService $journalService
     * @param JournalEntryService $journalEntryService
     * @param EmployeeService $employeeService
     * @param FiscalYearService $fiscalYearService
     */
    public function __construct(
        EconomySectorService $economySectorService,
        JournalService $journalService,
        JournalEntryService $journalEntryService,
        EmployeeService $employeeService,
        FiscalYearService $fiscalYearService
    ) {
        $this->economySectorService = $economySectorService;
        $this->journalService = $journalService;
        $this->journalEntryService = $journalEntryService;
        $this->employeeService = $employeeService;
        $this->fiscalYearService = $fiscalYearService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $journalEntries = $this->journalEntryService->findAll(null, null,
            ['column' => 'created_at', 'direction' => 'desc']);
        $journals = $this->journalService->findAll();
        return view('accounts::journal-entry.index', compact('journalEntries', 'journals'));
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        $economyCodes = ['' => __('labels.select')] + $this->economySectorService->getEconomyCodeWithSectorsForDropdown(true);
        $journals = $this->journalService->getjournalsForDropdown();
        $fiscalYears = $this->fiscalYearService->getFiscalYearsForDropdown();
        $employees = $this->employeeService->getEmployeesForDropdown();
        $accountTransactionTypes = JournalEntry::getTransactionTypes();
        $accountTransactionSources = JournalEntry::getTransactionSources();
        $paymentTypes = JournalEntry::getPaymentTypes();
        return view('accounts::journal-entry.create', compact(
            'economyCodes',
            'journals',
            'fiscalYears',
            'employees',
            'accountTransactionSources',
            'accountTransactionTypes',
            'paymentTypes'
        ));
    }

    /**
     * Store all Journal Entry
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $this->journalEntryService->createJournalEntry($request->all());
            DB::commit();
            Session::flash('success', trans('labels.save_success'));
            return redirect()->route('journal.entry.index');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage() . " " . $e->getTraceAsString());
            Session::flash('error', $e->getMessage());
            return redirect()->route('journal.entry.create');
        }
    }

    /**
     * Show the specified resource.
     *
     * @param int $id
     *
     * @return Factory|View
     */
    public function show($id)
    {
        $journalEntry = $this->journalEntryService->findOne($id);
        $economySectors = $this->journalEntryService->getEconomySectorsFromJournalEntry($journalEntry);
        return view('accounts::journal-entry.show', compact('journalEntry', 'economySectors'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return Factory|View
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

    public function expenseLimit($economyCode, $fiscalYearId = 0, $date = null)
    {
        if (!$fiscalYearId) {
            $date = Carbon::parse($date)->format('Y-m-d');
            $fiscalYearId = $this->fiscalYearService->getFiscalYearByDate($date)->id;
        }
        return $this->journalEntryService->calculateAvailableBudgetByCode($economyCode, $fiscalYearId);
    }

    public function changeStatus($id, $status)
    {
        $model = $this->journalEntryService->findOne($id);
        if ($this->journalEntryService->changeStatus($model, $status)) {
            return redirect()->route('journal.entry.index')
                ->with('success', trans('labels.save_success'));
        } else {
            return redirect()->route('journal.entry.index')
                ->with('success', trans('labels.save_success'));
        }
    }
}

