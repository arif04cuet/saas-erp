<?php

namespace Modules\Accounts\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\Accounts\Entities\EconomyHead;
use Modules\Accounts\Http\Requests\CreateEconomyHeadRequest;
use Modules\Accounts\Http\Requests\UpdateEconomyHeadRequest;
use Modules\Accounts\Services\EconomyHeadService;

class EconomyHeadController extends Controller
{

    private $economyHeadService;

    public function __construct(EconomyHeadService $economyHeadService)
    {
        $this->economyHeadService = $economyHeadService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $economyHeads = $this->economyHeadService->findAll();
        return view('accounts::economy-head.index', compact('economyHeads'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $economyHeadOptions = $this->economyHeadService->getEconomyHeadsForDropdown(null, null, true);
        return view('accounts::economy-head.create', compact('economyHeadOptions'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(CreateEconomyHeadRequest $request)
    {
        $this->economyHeadService->save($request->all());
        Session::flash('success', trans('labels.save_success'));

        return redirect()->route('economy-head.index');
    }

    /**
     * Show the specified resource.
     * @param EconomyHead $economyHead
     * @return Response
     */
    public function show(EconomyHead $economyHead)
    {
        return view('accounts::economy-head.show', compact('economyHead'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param EconomyHead $economyHead
     * @return Response
     */
    public function edit(EconomyHead $economyHead)
    {
        $economyHeadOptions = $this->economyHeadService->getEconomyHeadsForDropdown(null, null, true);
        return view('accounts::economy-head.edit', compact('economyHead', 'economyHeadOptions'));
    }

    /**
     * Update the specified resource in storage.
     * @param EconomyHead $economyHead
     * @param  Request $request
     * @return Response
     */
    public function update(EconomyHead $economyHead, UpdateEconomyHeadRequest $request)
    {
        $this->economyHeadService->update($economyHead, $request->all());
        Session::flash('success', trans('labels.update_success'));

        return redirect()->route('economy-head.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param EconomyHead $economyHead
     * @return Response
     * @throws \Exception
     */
    public function destroy(EconomyHead $economyHead)
    {
        $this->economyHeadService->delete($economyHead->id);
        Session::flash('success', trans('labels.delete_success'));
        return redirect()->back();
    }
}
