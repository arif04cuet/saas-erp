<?php

namespace Modules\Accounts\Http\Controllers;

use App\Utilities\EnToBnNumberConverter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Accounts\Entities\CashBookEntry;
use Modules\Accounts\Services\CashBookEntryService;
use Modules\Accounts\Services\JournalService;
use Modules\Accounts\Services\FiscalYearService;

class CashBookEntryController extends Controller
{
    private $cashBookEntryService;
    private $fiscalYearService;
    private $journalService;

    public function __construct(
        CashBookEntryService $cashBookEntryService,
        FiscalYearService $fiscalYearService,
        JournalService $journalService

    ) {
        $this->cashBookEntryService = $cashBookEntryService;
        $this->fiscalYearService = $fiscalYearService;
        $this->journalService = $journalService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $journals = $this->journalService->getjournalsForDropdown();
        $fiscalYears = $this->fiscalYearService->getFiscalYearsForDropdown();
        $cashBookEntries = $this->cashBookEntryService->findAll(
            null,
            null,
            ['column' => 'created_at', 'direction' => 'desc']
        );
        $cashBookEntries = $this->cashBookEntryService->formatToJsonForDataTable($cashBookEntries);
        return view('accounts::cash-book-entry.index', compact('cashBookEntries', 'fiscalYears', 'journals'));
    }

    /**
     * Filter Data With Fiscal Year and Transaction Type
     * [fiscal_year_id, account_transaction_type]
     * @param Request $request
     * @return mixed
     */
    public function filterAsJson(Request $request)
    {
        $data = [
            'fiscal_year_id' => trim($request->fiscal_year_id),
            'journal_id' => trim($request->journal_id),
            'account_transaction_type' => trim($request->account_transaction_type)
        ];
        $filtered = $this->cashBookEntryService->filter($data);
        return $this->cashBookEntryService->formatToJsonForDataTable($filtered)->values();
    }

    /**
     * @param $id
     * @param $status
     *
     * @return RedirectResponse
     */
    public function changeStatus($id, $status)
    {
        $model = $this->cashBookEntryService->findOne($id);
        if ($this->cashBookEntryService->changeStatus($model, $status)) {
            return redirect()->route('cash-book-entry.index')
                ->with('success', trans('labels.save_success'));
        } else {
            return redirect()->route('cash-book-entry.index')
                ->with('success', trans('labels.save_success'));
        }
    }
}
