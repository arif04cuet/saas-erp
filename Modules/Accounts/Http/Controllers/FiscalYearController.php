<?php

namespace Modules\Accounts\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\Accounts\Entities\FiscalYear;
use Modules\Accounts\Services\FiscalYearService;

class FiscalYearController extends Controller
{

    protected $fiscalYearService;

    /**
     * FiscalYearController constructor.
     * @param FiscalYearService $fiscalYearService
     */
    public function __construct(FiscalYearService $fiscalYearService)
    {
        $this->fiscalYearService = $fiscalYearService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $fiscalYears = $this->fiscalYearService->findAll();
        return view('accounts::fiscal-year.index', compact('fiscalYears'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('accounts::fiscal-year.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->fiscalYearService->store($request->all());
        Session::flash('success', trans('labels.save_success'));

        return redirect()->route('fiscal-year.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @param FiscalYear $fiscalYear
     * @return Response
     */
    public function edit(FiscalYear $fiscalYear)
    {
        return view('accounts::fiscal-year.edit', compact('fiscalYear'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @param FiscalYear $fiscalYear
     * @return Response
     */
    public function update(FiscalYear $fiscalYear, Request $request)
    {
        $this->fiscalYearService->updateFiscalYear($fiscalYear, $request->all());
        Session::flash('success', trans('labels.save_success'));

        return redirect()->route('fiscal-year.index');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(FiscalYear $fiscalYear)
    {
        $this->fiscalYearService->delete($fiscalYear->id);
        Session::flash('warning', trans('labels.delete_success'));
        return redirect()->back();
    }
}
