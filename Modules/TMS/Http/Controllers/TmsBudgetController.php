<?php

namespace Modules\TMS\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\TMS\Entities\TmsBudget;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Session;
use Modules\TMS\Services\TmsBudgetService;
use Modules\TMS\Services\TmsSectorService;
use Modules\TMS\Services\TrainingsService;

class TmsBudgetController extends Controller
{
    /**
     * @var TmsBudgetService
     */
    private $tmsBudgetService;
    /**
     * @var TrainingsService
     */
    private $trainingsService;
    /**
     * @var TmsSectorService
     */
    private $tmsSectorService;

    /**
     * TmsBudgetController constructor.
     * @param TmsBudgetService $tmsBudgetService
     * @param TrainingsService $trainingsService
     * @param TmsSectorService $tmsSectorService
     */
    public function __construct(
        TmsBudgetService $tmsBudgetService,
        TrainingsService $trainingsService,
        TmsSectorService $tmsSectorService
    ) {
        $this->tmsBudgetService = $tmsBudgetService;
        $this->trainingsService = $trainingsService;
        $this->tmsSectorService = $tmsSectorService;
    }

    /**
     * Display a listing of the resource.
     * @return Factory|View
     */
    public function index()
    {
        $budgets = $this->tmsBudgetService->findAll();
        return view('tms::budget.index', compact('budgets'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Factory|View
     */
    public function create()
    {
        $trainings = $this->trainingsService->findAll()->pluck('title', 'id');
        $sectors = $this->tmsSectorService->findAll();
        $page = 'create';

        return view('tms::budget.create', compact('trainings', 'sectors', 'page'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        if ($this->tmsBudgetService->store($request->all())) {
            return redirect()->route('tms-budgets.index')->with('success', trans('labels.save_success'));
        } else {
            return redirect()->route('tms-budgets.index')->with(
                'error',
                trans('labels.save_fail')
            );
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Factory|View
     */
    public function show($id)
    {
        $budget = $this->tmsBudgetService->findOne($id);
        return view('tms::budget.show', compact('budget'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Factory|View
     */
    public function edit($id)
    {
        // $budget = $this->tmsBudgetService->findOne($id);
        $budget = $this->tmsBudgetService->findOrFail($id);
        return view('tms::budget.edit', compact('budget'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        if ($this->tmsBudgetService->updateBudget($id, $request->all())) {
            return redirect()->route('tms-budgets.index')->with('success', trans('labels.save_success'));
        } else {
            return redirect()->route('tms-budgets.index')->with(
                'error',
                trans('labels.update_fail')
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $response = $this->tmsBudgetService->destroy($id);
        Session::flash('message', $response->getContent());
        return redirect()->route('tms-budgets.index');
    }

    public function print(TmsBudget $tmsBudget, $type = null)
    {
        return view('tms::budget.print.printable', compact('tmsBudget', 'type'));
    }
}
