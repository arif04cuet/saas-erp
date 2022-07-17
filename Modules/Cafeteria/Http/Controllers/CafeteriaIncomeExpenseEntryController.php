<?php

namespace Modules\Cafeteria\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\HRM\Services\EmployeeService;
use Modules\Accounts\Entities\JournalEntry;
use Modules\Accounts\Services\JournalService;
use Modules\Accounts\Services\FiscalYearService;
use Modules\Accounts\Services\EconomySectorService;
use Modules\Accounts\Services\JournalEntryService;
use Modules\Cafeteria\Http\Requests\CafeteriaIncomeExpenseRequest;
use Modules\Cafeteria\Services\CafeteriaIncomeExpenseEntryService;

class CafeteriaIncomeExpenseEntryController extends Controller
{

    /**
     * @var EconomySectorService
     * @var JournalService
     * @var FiscalYearService
     * @var JournalEntryService
     * @var CafeteriaIncomeExpenseEntryService
     */

    private $economySectorService;
    private $journalService;
    private $fiscalYearService;
    private $jounalEntryService;
    private $cafeteriaIncomeExpenseEntryService;

    /**
     * @param EconomySectorService $economySectorService
     * @param JournalService $journalService
     * @param FiscalYearService $fiscalYearService
     * @param JournalEntryService $jounalEntryService
     * @param CafeteriaIncomeExpenseEntryService $cafeteriaIncomeExpenseEntryService
     */

    public function __construct(
        EconomySectorService $economySectorService,
        JournalService $journalService,
        FiscalYearService $fiscalYearService,
        JournalEntryService $journalEntryService,
        CafeteriaIncomeExpenseEntryService $cafeteriaIncomeExpenseEntryService
    ) {
        $this->economySectorService = $economySectorService;
        $this->journalService = $journalService;
        $this->fiscalYearService = $fiscalYearService;
        $this->journalEntryService = $journalEntryService;
        $this->cafeteriaIncomeExpenseEntryService = $cafeteriaIncomeExpenseEntryService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $journalEntryData = $this->cafeteriaIncomeExpenseEntryService->findAll(
            null,
            null,
            ['column' => 'id', 'direction' => 'DESC']
        );

        return view('cafeteria::income-expense-entry.index', compact('journalEntryData'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $economyCodes = ['' => __('labels.select')] + $this->economySectorService->getEconomyCodeWithSectorsForDropdown(true);
        $journals = $this->journalService->getjournalsForDropdown();
        $fiscalYears = $this->fiscalYearService->getFiscalYearsForDropdown();
        $accountTransactionTypes = JournalEntry::getTransactionTypes();
        $paymentTypes = JournalEntry::getPaymentTypes();
        return view('cafeteria::income-expense-entry.create', compact(
            'economyCodes',
            'journals',
            'fiscalYears',
            'accountTransactionTypes',
            'paymentTypes'
        ));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(CafeteriaIncomeExpenseRequest $request)
    {
        $this->cafeteriaIncomeExpenseEntryService->store($request->all());

        return redirect()->route('income-expense-entries.index')
            ->with('success', __('labels.save_success'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $cafeteriaJournal = $this->cafeteriaIncomeExpenseEntryService->findOrFail($id);
        $economySectors = $this->journalEntryService->getEconomySectorsFromJournalEntry($cafeteriaJournal->journalEntry);

        return view('cafeteria::income-expense-entry.show', compact('cafeteriaJournal', 'economySectors'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('cafeteria::edit');
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
        //
    }
}
