<?php

namespace Modules\Accounts\Http\Controllers;

use App\Utilities\EnToBnNumberConverter;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Accounts\Entities\JournalEntryDetail;
use Modules\Accounts\Services\AccountBalanceService;
use Modules\Accounts\Services\EconomyCodeService;
use Modules\Accounts\Services\FiscalYearService;

class AccountBalanceController extends Controller
{
    private $service;
    private $fiscalYearService;
    private $economyCodeService;

    public function __construct(
        AccountBalanceService $accountBalanceService,
        FiscalYearService $fiscalYearService,
        EconomyCodeService $economyCodeService
    )
    {
        $this->service = $accountBalanceService;
        $this->fiscalYearService = $fiscalYearService;
        $this->economyCodeService = $economyCodeService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $accountBalances = [];
        $fiscalYears = $this->fiscalYearService->getFiscalYearsForDropdown();
        $economyCodes = $this->economyCodeService->getEconomyCodesForDropdown(null, function ($code) {
            return $code->code;
        }, null, false);
        return view('accounts::account-balance.index', compact('accountBalances', 'fiscalYears', 'economyCodes'));
    }

    public function filterAsJson(Request $request)
    {
        $data = [
            'economy_code' => $request->economy_code,
            'fiscal_year_id' => $request->fiscal_year_id,
        ];
        $filtered = $this->service->filter($data);
        $number = 1;

        $filtered = $filtered->each(function ($obj) use (&$number) {
            $obj->index = EnToBnNumberConverter::en2bn($number, false);
            $obj->fiscal_year_name = EnToBnNumberConverter::en2bn($obj->fiscalYear->name, false);
            if (app()->isLocale('en')) {
                $obj->code = $obj->economyCode->english_name . ' - ' . EnToBnNumberConverter::en2bn($obj->economyCode->code, false);
            } else {
                $obj->code = $obj->economyCode->bangla_name . ' - ' . EnToBnNumberConverter::en2bn($obj->economyCode->code, false);
            }
            $number = $number + 1;
        });

        if ($request->source == JournalEntryDetail::getSources()[0]) {    // local
            $filtered = $filtered->each(function ($obj) {
                $obj->total_receipt = EnToBnNumberConverter::en2bn($obj->total_local_receipt, false);
                $obj->total_payment = EnToBnNumberConverter::en2bn($obj->total_local_payment, false);
            });
        } else {                                                             // revenue
            $filtered = $filtered->each(function ($obj) {
                $obj->total_receipt = EnToBnNumberConverter::en2bn($obj->total_revenue_receipt, false);
                $obj->total_payment = EnToBnNumberConverter::en2bn($obj->total_revenue_payment, false);
            });
        }
        return $filtered;
    }
}
