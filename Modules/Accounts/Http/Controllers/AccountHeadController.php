<?php

namespace Modules\Accounts\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Accounts\Http\Requests\CreateAccountHeadPostRequest;
use Modules\Accounts\Http\Requests\UpdateAccountHeadPostRequest;
use Modules\Accounts\Services\AccountService;
use Modules\Accounts\Services\AccountHeadService;

class AccountHeadController extends Controller
{
    private $accountService;
    private $accountHeadService;

    /**
     * AccountHeadController constructor.
     * @param AccountService $accountService
     * @param AccountHeadService $accountHeadService
     */
    public function __construct(AccountService $accountService ,AccountHeadService $accountHeadService)
    {
        $this->accountService = $accountService;
        $this->accountHeadService = $accountHeadService;
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $accountsHeads = $this->accountService->getAllHeadsOptionList();

        return view('accounts::account-head.create', compact('accountsHeads'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(CreateAccountHeadPostRequest $request)
    {
        $response = $this->accountHeadService->store($request->all());

        return redirect()->route('chart-of-account')->with('message', $response->getContent());
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $head = $this->accountHeadService->getHead($id);

        $accountsHeads = $this->accountService->getAllHeadsOptionList($head->parent_id);

        return view('accounts::account-head.edit', compact('head', 'accountsHeads'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(UpdateAccountHeadPostRequest $request, $id)
    {
        $response = $this->accountHeadService->update($id, $request->all());

        return redirect()->route('chart-of-account')->with('message', $response->getContent());
    }

    /**
     * Remove the specified resource from storage.
     * @param $id
     * @return Response
     */
    public function destroy($id)
    {
        $response = $this->accountHeadService->delete($id);

        return redirect()->route('chart-of-account')->with('message', $response->getContent());
    }
}
