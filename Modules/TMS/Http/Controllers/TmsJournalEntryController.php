<?php

namespace Modules\TMS\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Modules\Accounts\Entities\Journal;
use Modules\Accounts\Services\FiscalYearService;
use Modules\HRM\Services\EmployeeService;
use Modules\TMS\Entities\TmsJournalEntry;
use Modules\TMS\Entities\Training;
use Modules\TMS\Http\Requests\TmsJournalEntryRequest;
use Modules\TMS\Services\TmsBudgetService;
use Modules\TMS\Services\TmsJournalEntryService;
use Modules\TMS\Services\TmsSubSectorService;
use Modules\TMS\Services\TrainingsService;
use Illuminate\Support\Facades\Session;

class TmsJournalEntryController extends Controller
{
    /**
     * @var TmsSubSectorService
     */
    private $tmsSubSectorService;
    /**
     * @var TrainingsService
     */
    private $trainingService;
    /**
     * @var TmsJournalEntryService
     */
    private $tmsJournalEntryService;
    /**
     * @var TmsBudgetService
     */
    private $tmsBudgetService;
    /**
     * @var EmployeeService
     */
    private $employeeService;
    /**
     * @var FiscalYearService
     */
    private $fiscalYearService;

    /**
     * TmsJournalEntryController constructor.
     * @param TmsSubSectorService $tmsSubSectorService
     * @param TrainingsService $trainingService
     * @param TmsBudgetService $tmsBudgetService
     * @param EmployeeService $employeeService
     * @param FiscalYearService $fiscalYearService
     * @param TmsJournalEntryService $tmsJournalEntryService
     */
    public function __construct(
        TmsSubSectorService $tmsSubSectorService,
        TrainingsService $trainingService,
        TmsBudgetService $tmsBudgetService,
        EmployeeService $employeeService,
        FiscalYearService $fiscalYearService,
        TmsJournalEntryService $tmsJournalEntryService
    ) {
        $this->tmsSubSectorService = $tmsSubSectorService;
        $this->trainingService = $trainingService;
        $this->tmsBudgetService = $tmsBudgetService;
        $this->employeeService = $employeeService;
        $this->fiscalYearService = $fiscalYearService;
        $this->tmsJournalEntryService = $tmsJournalEntryService;
    }

    /**
     * Display a listing of the resource.
     * @return Factory|Application|View
     */
    public function index()
    {
        // dd('how');
        $tmsJournalEntries = $this->tmsJournalEntryService->findAll(null, null, [
            'direction' => 'desc',
            'column' => 'created_at'
        ]);
        return view('tms::accounts.journal-entry.index', compact('tmsJournalEntries'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Factory|Application|View
     */
    public function create()
    {
        $tmsSubSectors = $this->tmsSubSectorService->getTmsSubSectorsForDropdown();
        $trainings = $this->trainingService->findAll()->pluck('title', 'id');
        $transactionTypes = $this->tmsJournalEntryService->getTransactionTypes();
        $paymentTypes = $this->tmsJournalEntryService->getPaymentTypes();
        $employees = $this->employeeService->getEmployeesForDropdown();
        $fiscalYears = $this->fiscalYearService->getFiscalYearsForDropdown();
        // $maxBudgetValues = $this->tmsBudgetService->getBudgetMaxValuesForAllTraining();
        $maxBudgetValues = null;
        $activeFiscalYear = $this->fiscalYearService->getFiscalYearByDate(Carbon::now()->format('Y-m-d'));
        $journals = Journal::pluck('name', 'id');
        $this->tmsJournalEntryService->resetOldJournalEntriesFromSession();
        return view('tms::accounts.journal-entry.create', compact(
            'transactionTypes',
            'tmsSubSectors',
            'fiscalYears',
            'trainings',
            'paymentTypes',
            'maxBudgetValues',
            'employees',
            'activeFiscalYear',
            'journals'
        ));
    }

    /**
     * Store a newly created resource in storage.
     * @param TmsJournalEntryRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(TmsJournalEntryRequest $request)
    {
        if ($this->tmsJournalEntryService->store($request->all())) {
            return redirect(route('tms.journal-entries.index'))
                ->with('success', trans('labels.save_success'));
        } else {
            if (Session::has('budget-exceed')) {
                $errorMessage = Session::get('budget-exceed');
            } elseif (Session::has('code_setting_not_found')) {
                $errorMessage = Session::get('code_setting_not_found');
            } else {
                $errorMessage = trans('labels.save_fail');
            }
            return redirect(route('tms.journal-entries.create'))
                ->with('error', $errorMessage)
                ->with('old', session()->getOldInput());
        }
    }

    /**
     * Show the specified resource.
     * @param TmsJournalEntry $tmsJournalEntry
     * @return Factory|Application|View
     */
    public function show(TmsJournalEntry $tmsJournalEntry)
    {
        return view('tms::accounts.journal-entry.show', compact('tmsJournalEntry'));
    }

    /**
     * @param TmsJournalEntry $tmsJournalEntry
     * @return Factory|Application|View|TmsJournalEntry
     */
    public function edit(TmsJournalEntry $tmsJournalEntry)
    {
        $tmsSubSectors = $this->tmsSubSectorService->getTmsSubSectorsForDropdown();
        $trainings = $this->trainingService->findAll()->pluck('title', 'id');
        $transactionTypes = $this->tmsJournalEntryService->getTransactionTypes();
        $paymentTypes = $this->tmsJournalEntryService->getPaymentTypes();
        $employees = $this->employeeService->getEmployeesForDropdown();
        $fiscalYears = $this->fiscalYearService->getFiscalYearsForDropdown();
        $maxBudgetValues = $this->tmsBudgetService->getBudgetMaxValuesForAllTraining();
        $activeFiscalYear = $this->fiscalYearService->getFiscalYearByDate(Carbon::now()->format('Y-m-d'));
        $journals = Journal::pluck('name', 'id');
        $this->tmsJournalEntryService->setOldJournalEntries($tmsJournalEntry);
        return view('tms::accounts.journal-entry.edit', compact(
            'transactionTypes',
            'tmsSubSectors',
            'fiscalYears',
            'trainings',
            'paymentTypes',
            'maxBudgetValues',
            'employees',
            'activeFiscalYear',
            'journals',
            'tmsJournalEntry'
        ));
    }


    /**
     * Store a newly created resource in storage.
     * @param TmsJournalEntryRequest $request
     * @param TmsJournalEntry $tmsJournalEntry
     * @return Application|RedirectResponse|Redirector
     */
    public function update(TmsJournalEntry $tmsJournalEntry, TmsJournalEntryRequest $request)
    {
        if ($this->tmsJournalEntryService->updateData($request->all(), $tmsJournalEntry)) {
            return redirect(route('tms.journal-entries.index'))
                ->with('success', trans('labels.update_success'));
        } else {
            if (Session::has('budget-exceed')) {
                $errorMessage = Session::get('budget-exceed');
            } elseif (Session::has('code_setting_not_found')) {
                $errorMessage = Session::get('code_setting_not_found');
            } else {
                $errorMessage = trans('labels.save_fail');
            }
            return redirect(route('tms.journal-entries.create'))
                ->with('error', $errorMessage)
                ->with('old', session()->getOldInput());
        }
    }

    public function changeStatus(TmsJournalEntry $tmsJournalEntry, $status)
    {
        if ($this->tmsJournalEntryService->changeStatus($tmsJournalEntry, $status)) {
            return redirect(route('tms.journal-entries.index'))
                ->with('success', trans('labels.update_success'));
        } else {
            return redirect(route('tms.journal-entries.index'))
                ->with('error', trans('labels.update_fail'));
        }
    }
}
