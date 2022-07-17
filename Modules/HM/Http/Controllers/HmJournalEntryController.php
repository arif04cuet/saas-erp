<?php

namespace Modules\HM\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Modules\Accounts\Services\FiscalYearService;
use Modules\HM\Entities\HmJournalEntry;
use Modules\HM\Services\HmJournalEntryService;
use Modules\HM\Services\HostelBudgetSectionService;
use Modules\HM\Services\HostelBudgetService;
use Modules\HM\Services\HostelBudgetTitleService;

class HmJournalEntryController extends Controller
{
    /**
     * @var HostelBudgetSectionService
     */
    private $hostelBudgetSectionService;
    /**
     * @var HostelBudgetService
     */
    private $hostelBudgetService;
    /**
     * @var HmJournalEntryService
     */
    private $hmJournalEntryService;
    /**
     * @var HostelBudgetTitleService
     */
    private $hostelBudgetTitleService;


    public function __construct(
        HmJournalEntryService $hmJournalEntryService,
        HostelBudgetService $hostelBudgetService,
        HostelBudgetTitleService $hostelBudgetTitleService,
        HostelBudgetSectionService $hostelBudgetSectionService
    ) {
        $this->hostelBudgetSectionService = $hostelBudgetSectionService;
        $this->hostelBudgetService = $hostelBudgetService;
        $this->hostelBudgetTitleService = $hostelBudgetTitleService;
        $this->hmJournalEntryService = $hmJournalEntryService;
    }

    /**
     * Display a listing of the resource.
     * @return Factory|Application|View
     */
    public function index()
    {
        $hmJournalEntries = $this->hmJournalEntryService->findAll(null, null, [
            'direction' => 'desc',
            'column' => 'created_at'
        ]);
        return view('hm::accounts.journal-entry.index', compact('hmJournalEntries'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Factory|Application|View
     */
    public function create()
    {
        $hostelBudgetSections = $this->hostelBudgetSectionService->getHostelBudgetSectionsForDropdown();
        $transactionTypes = $this->hmJournalEntryService->getTransactionTypes();
        $paymentTypes = $this->hmJournalEntryService->getPaymentTypes();
        $fiscalYears = $this->hostelBudgetTitleService->getHostelBudgetTitleForDropdown(null, true);
        // dd($fiscalYears);
        // $fiscalYears = $this->hostelBudgetTitleService->getHostelBudgetTitles(true);
        $maxBudgetValues = $this->hostelBudgetService->getBudgetMaxValuesForAllBudget();
        // dd($maxBudgetValues);
        session(['_old_input.hm_journal_entries' => collect()]);
        return view('hm::accounts.journal-entry.create', compact(
            'transactionTypes',
            'fiscalYears',
            'paymentTypes',
            'maxBudgetValues',
            'hostelBudgetSections'
        ));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        if ($this->hmJournalEntryService->store($request->all())) {
            return redirect(route('hm.accounts.journal-entries.index'))
                ->with('success', trans('labels.save_success'));
        } else {
            if (Session::has('budget-exceed')) {
                $errorMessage = Session::get('budget-exceed');
            } else {
                $errorMessage = trans('labels.save_fail');
            }
            return redirect(route('hm.accounts.journal-entries.create'))
                ->with('error', $errorMessage)
                ->with('_old_input.hm_journal_entries', session()->getOldInput());
        }
    }

    /**
     * Show the specified resource.
     * @param HmJournalEntry $hmJournalEntry
     * @return Factory|Application|View
     */
    public function show(HmJournalEntry $hmJournalEntry)
    {
        return view('hm::accounts.journal-entry.show', compact('hmJournalEntry'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('hm::edit');
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
