<?php

namespace Modules\Accounts\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Accounts\Entities\EconomyCode;
use Modules\Accounts\Entities\EconomyHead;
use Modules\Accounts\Services\AccountService;
use Modules\Accounts\Services\EconomyCodeService;
use Modules\Accounts\Services\EconomyHeadService;

class AccountsController extends Controller
{

    private $accountService;
    private $economyCodeService;
    private $economyHeadService;

    public function __construct(
        AccountService $accountService,
        EconomyHeadService $economyHeadService,
        EconomyCodeService $economyCodeService)
    {
        $this->accountService = $accountService;
        $this->economyCodeService = $economyCodeService;
        $this->economyHeadService = $economyHeadService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('accounts::index');
    }

    public function show()
    {
        return $this->economyCodeService->getEconomyCodesForDropdown(function ($eCode) {
            return $eCode->bangla_name . ' (' . $eCode->code . ')';
        });
    }



    /**
     *      Invoice Codes Should be moved to its own controller
     */
    public function invoiceCreate()
    {
        return view('accounts::invoice.create');
    }

    /**
     *  Temporary Function for showing invoice index
     */
    public function invoiceIndex()
    {
        return view('accounts::invoice.index');
    }

    /**
     * Temporary Function
     */
    public function journalEntry()
    {
        return view('accounts::reports.journal-entry');
    }



}
