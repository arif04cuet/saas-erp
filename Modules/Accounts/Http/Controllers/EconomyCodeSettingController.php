<?php

namespace Modules\Accounts\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Accounts\Services\EconomyCodeSettingService;

class EconomyCodeSettingController extends Controller
{
    /**
     * @var EconomyCodeSettingService
     */
    private $economyCodeSettingService;

    /**
     * EconomyCodeSettingController constructor.
     * @param EconomyCodeSettingService $economyCodeSettingService
     */
    public function __construct(EconomyCodeSettingService $economyCodeSettingService)
    {
        $this->economyCodeSettingService = $economyCodeSettingService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $economyCodes = $this->economyCodeSettingService->getEconomyCodesForDropdown();
        $temporaryEconomyCodes = $this->economyCodeSettingService->getCodesFromSettings('temporary')
            ->pluck('economy_code');
        $receiptEconomyCodes = $this->economyCodeSettingService->getCodesFromSettings('receipt')
            ->pluck('economy_code');
        return view('accounts::economy-code.setting.index',
            compact('economyCodes', 'temporaryEconomyCodes', 'receiptEconomyCodes'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->economyCodeSettingService->saveCodeSettings($request->all());
        return redirect()->back();
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('accounts::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('accounts::edit');
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
