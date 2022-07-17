<?php

namespace Modules\Publication\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Accounts\Entities\JournalEntry;
use Modules\Accounts\Services\JournalService;
use Modules\Accounts\Services\FiscalYearService;
use Modules\Accounts\Services\EconomySectorService;
use Modules\Accounts\Services\JournalEntryService;
use Modules\Publication\Http\Requests\PublicationIncomeExpenseEntryRequest;
use Modules\Publication\Services\PublicationIncomeExpenseEntryService;

class PublicationIncomeExpenseEntryController extends Controller
{
    /**
     * @var EconomySectorService
     * @var JournalService
     * @var FiscalYearService
     * @var JournalEntryService
     * @var PublicationIncomeExpenseEntryService
     */

    private $economySectorService;
    private $journalService;
    private $fiscalYearService;
    private $jounalEntryService;
    private $publicationIncomeExpenseEntryService;

    /**
     * @param EconomySectorService $economySectorService
     * @param JournalService $journalService
     * @param FiscalYearService $fiscalYearService
     * @param JournalEntryService $jounalEntryService
     * @param PublicationIncomeExpenseEntryService $publicationIncomeExpenseEntryService
     */

    public function __construct(
        EconomySectorService $economySectorService,
        JournalService $journalService,
        FiscalYearService $fiscalYearService,
        JournalEntryService $journalEntryService,
        PublicationIncomeExpenseEntryService $publicationIncomeExpenseEntryService
    ) {
        $this->economySectorService = $economySectorService;
        $this->journalService = $journalService;
        $this->fiscalYearService = $fiscalYearService;
        $this->journalEntryService = $journalEntryService;
        $this->publicationIncomeExpenseEntryService = $publicationIncomeExpenseEntryService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $journalEntryData = $this->publicationIncomeExpenseEntryService->findAll(
            null,
            null,
            ['column' => 'id', 'direction' => 'DESC']
        );
        return view('publication::income-expense-entry.index', compact('journalEntryData'));
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
        return view('publication::income-expense-entry.create', compact(
            'economyCodes',
            'journals',
            'fiscalYears',
            'accountTransactionTypes',
            'paymentTypes'
        ));
    }

    /**
     * Store a newly created resource in storage.
     * @param PublicationIncomeExpenseEntryRequest $request
     * @return Response
     */
    public function store(PublicationIncomeExpenseEntryRequest $request)
    {
        $this->publicationIncomeExpenseEntryService->store($request->all());

        return redirect()->route('publication-income-expense-entries.index')
            ->with('success', __('labels.save_success'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $publicationJournal = $this->publicationIncomeExpenseEntryService->findOrFail($id);
        $economySectors = $this->journalEntryService->getEconomySectorsFromJournalEntry($publicationJournal->journalEntry);

        return view('publication::income-expense-entry.show', compact('publicationJournal', 'economySectors'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('publication::edit');
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
