<?php

namespace Modules\Accounts\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Accounts\Http\Requests\CreateAccountLedgerPostRequest;
use Modules\Accounts\Http\Requests\UpdateAccountLedgerPostRequest;
use Modules\Accounts\Services\AccountHeadService;
use Modules\Accounts\Services\AccountLedgerService;
use Modules\Accounts\Services\AccountService;


class AccountLedgerController extends Controller
{
    private $accountService;
    private $accountHeadService;
    private $accountLedgerService;

    /**
     * AccountLedgerController constructor.
     * @param AccountHeadService $accountLedgerServices
     */
    public function __construct(AccountService $accountService, AccountHeadService $accountHeadService, AccountLedgerService $accountLedgerService)
    {
        $this->accountService = $accountService;
        $this->accountHeadService = $accountHeadService;
        $this->accountLedgerService = $accountLedgerService;
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $accountsHeads = $this->accountService->getAllHeadsOptionList();

        return view('accounts::account-ledger.create', compact('accountsHeads'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(CreateAccountLedgerPostRequest $request)
    {
        $this->accountLedgerService->store($request->all());
        return redirect()->route('chart-of-account')->with('success', 'Account Ledger stored successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $ledger = $this->accountLedgerService->getLedger($id);
        $accountsHeads = $this->accountService->getAllHeadsOptionList($ledger->account_head_id);

        return view('accounts::account-ledger.edit', compact('ledger', 'accountsHeads'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(UpdateAccountLedgerPostRequest $request, $id)
    {
        $this->accountLedgerService->update($id, $request->all());
        return redirect()->route('chart-of-account')->with('success', 'Account Ledger updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $this->accountLedgerService->delete($id);
        return redirect()->route('chart-of-account')->with('warning', 'Account Ledger deleted successfully!');
    }
}
