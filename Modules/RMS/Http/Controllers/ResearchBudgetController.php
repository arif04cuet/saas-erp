<?php

namespace Modules\RMS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\RMS\Entities\Research;
use Modules\RMS\Http\Requests\CreateResearchBudgetRequest;
use Modules\RMS\Http\Requests\UpdateResearchBudgetRequest;
use Modules\RMS\Services\ResearchBudgetService;

class ResearchBudgetController extends Controller
{
    private $researchBudgetService;

    public function __construct(ResearchBudgetService $researchBudgetService)
    {
        $this->researchBudgetService = $researchBudgetService;
    }

    /**
     * Display a listing of the resource.
     * @param Research $research
     * @return Response
     */
    public function index(Research $research)
    {
        return view('rms::research.budget.index', compact('research'));
    }

    /**
     * Show the form for creating a new resource.
     * @param Research $research
     * @return Response
     */
    public function create(Research $research)
    {
        return view('rms::research.budget.create', compact('research'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @param Research $research
     * @return Response
     */
    public function store(CreateResearchBudgetRequest $request, Research $research)
    {
        $this->researchBudgetService->store($research, $request->all());
        Session::flash('success', trans('labels.save_success'));
        return redirect()->route('research-budget.index', $research->id);
    }

    /**
     * Show the form for editing the specified resource.
     * @param Research $research
     * @return Response
     */
    public function edit(Research $research)
    {
        return view('rms::research.budget.edit', compact('research'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @param Research $research
     * @return array
     */
    public function update(UpdateResearchBudgetRequest $request, Research $research)
    {
        $this->researchBudgetService->updateBudget($research, $request->all());

        Session::flash('success', trans('labels.save_success'));
        return redirect()->route('research-budget.index', $research->id);
    }
}
