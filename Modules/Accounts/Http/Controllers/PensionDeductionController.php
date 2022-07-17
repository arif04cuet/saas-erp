<?php

namespace Modules\Accounts\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Modules\Accounts\Services\PensionDeductionService;

class PensionDeductionController extends Controller
{
    private $service;

    public function __construct(PensionDeductionService $pensionDeductionService)
    {
        $this->service = $pensionDeductionService;
    }


    /**
     * Display a listing of the resource.
     * @return Factory|View
     */
    public function index()
    {
        $pensionDeductions = $this->service->findAll();
        return view('accounts::deduction.index', compact('pensionDeductions'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $action = "create";
        return view('accounts::deduction.create', compact('action'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        if ($this->service->save($request->all())) {
            return redirect()->route('pension.deduction.index')
                ->with('success', trans('labels.save_success'));
        } else {
            return redirect()->route('pension.deduction.create')
                ->with('error', trans('labels.save_fail'));
        }
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
        $action = "edit";
        $pensionDeduction = $this->service->findOne($id);
        return view('accounts::deduction.create', compact('action', 'pensionDeduction'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $pensionDeduction = $this->service->findOne($id);
        if ($this->service->update($pensionDeduction, $request->all())) {
            return redirect()->route('pension.deduction.index')
                ->with('success', trans('labels.save_success'));
        } else {
            return redirect()->route('pension.deduction.index')
                ->with('error', trans('labels.save_fail'));
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        if ($this->service->delete($id)) {
            return redirect()->route('pension.deduction.index')
                ->with('success', trans('labels.delete_success'));
        } else {
            return redirect()->route('pension.deduction.index')
                ->with('error', trans('labels.delete_fail'));
        }
    }
}
