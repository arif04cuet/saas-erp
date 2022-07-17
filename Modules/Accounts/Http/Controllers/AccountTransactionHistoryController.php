<?php

namespace Modules\Accounts\Http\Controllers;

use App\Utilities\EnToBnNumberConverter;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Accounts\Entities\AccountTransactionHistory;
use Modules\Accounts\Services\AccountTransactionHistoryService;
use Modules\Accounts\Services\EconomyCodeService;
use Modules\Accounts\Services\FiscalYearService;

class AccountTransactionHistoryController extends Controller
{
    private $service;
    private $fiscalYearService;
    private $economyCodeService;

    public function __construct(
        AccountTransactionHistoryService $accountTransactionHistoryService,
        FiscalYearService $fiscalYearService,
        EconomyCodeService $economyCodeService
    )
    {
        $this->service = $accountTransactionHistoryService;
        $this->fiscalYearService = $fiscalYearService;
        $this->economyCodeService = $economyCodeService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $accountTransactionHistories = [];
        $fiscalYears = $this->fiscalYearService->getFiscalYearsForDropdown();
        $economyCodes = $this->economyCodeService->getEconomyCodesForDropdown(null, function ($code) {
            return $code->code;
        }, null, false);
        return view('accounts::account-transaction-history.index',
            compact(
                'accountTransactionHistories',
                'fiscalYears',
                'economyCodes'
            ));
    }

    public function filterAsJson(Request $request)
    {
        $data = [
            'economy_code' => $request->economy_code,
            'fiscal_year_id' => $request->fiscal_year_id,
            'source' => $request->source
        ];
        $filtered = $this->service->filter($data);
        $number = 1;
        return $filtered->each(function ($obj) use (&$number) {
            $obj->index = EnToBnNumberConverter::en2bn($number, false);
            $obj->fiscal_year_name = EnToBnNumberConverter::en2bn($obj->fiscalYear->name, false);
            if (app()->isLocale('en')) {
                $obj->code = $obj->economyCode->english_name . ' - ' . EnToBnNumberConverter::en2bn($obj->economyCode->code, false);
            } else {
                $obj->code = $obj->economyCode->bangla_name . ' - ' . EnToBnNumberConverter::en2bn($obj->economyCode->code, false);
            }
            $obj->journal_entry_id = $obj->journalEntryDetail->journalEntry->id;
            $obj->previous_balance = EnToBnNumberConverter::en2bn($obj->previous_balance);
            $obj->updated_balance = EnToBnNumberConverter::en2bn($obj->updated_balance);;
            $number = $number + 1;
        });
    }
}
