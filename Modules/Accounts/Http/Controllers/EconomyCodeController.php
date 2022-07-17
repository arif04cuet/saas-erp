<?php

namespace Modules\Accounts\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\Accounts\Entities\EconomyCode;
use Modules\Accounts\Http\Requests\CreateEconomyCodeRequest;
use Modules\Accounts\Http\Requests\UpdateEconomyCodeRequest;
use Modules\Accounts\Services\EconomyCodeService;
use Modules\Accounts\Services\EconomyHeadService;

class EconomyCodeController extends Controller
{

    private $economyCodeService;
    private $economyHeadService;

    public function __construct(EconomyHeadService $economyHeadService, EconomyCodeService $economyCodeService)
    {
        $this->economyHeadService = $economyHeadService;
        $this->economyCodeService = $economyCodeService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $economyCodes = $this->economyCodeService->findAll();
        return view('accounts::economy-code.index', compact('economyCodes'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $implementedKey = function ($economyCode) {
            return $economyCode->code;
        };
        $economyHeadOptions = $this->economyHeadService->getEconomyHeadsForDropdown(
            null,
            $implementedKey,
            true);
        return view('accounts::economy-code.create', compact('economyHeadOptions'));
    }

    /**
     * Store a newly created resource in storage.
     * @param CreateEconomyCodeRequest $request
     * @return Response
     */
    public function store(CreateEconomyCodeRequest $request)
    {
        $this->economyCodeService->save($request->all());
        Session::flash('success', trans('labels.save_success'));

        return redirect()->route('economy-code.index');
    }

    /**
     * Show the specified resource.
     * @param EconomyCode $economyCode
     * @return Response
     */
    public function show(EconomyCode $economyCode)
    {
        return view('accounts::economy-code.show', compact('economyCode'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param EconomyCode $economyCode
     * @return Response
     */
    public function edit(EconomyCode $economyCode)
    {
        $implementedKey = function ($economyCode) {
            return $economyCode->code;
        };
        $economyHeadOptions = $this->economyHeadService->getEconomyHeadsForDropdown(
            null, $implementedKey,
            true);
        return view('accounts::economy-code.edit', compact('economyCode', 'economyHeadOptions'));
    }

    /**
     * Update the specified resource in storage.
     * @param EconomyCode $economyCode
     * @param UpdateEconomyCodeRequest $request
     * @return Response
     */
    public function update(EconomyCode $economyCode, UpdateEconomyCodeRequest $request)
    {
        $this->economyCodeService->update($economyCode, $request->all());
        Session::flash('success', trans('labels.update_success'));

        return redirect()->route('economy-code.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param EconomyCode $economyCode
     * @return Response
     * @throws \Exception
     */
    public function destroy(EconomyCode $economyCode)
    {
        $this->economyCodeService->delete($economyCode->id);
        Session::flash('success', trans('labels.delete_success'));
        return redirect()->back();
    }
}
