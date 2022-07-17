<?php

namespace Modules\HM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\HM\Entities\HostelBudgetSection;
use Modules\HM\Http\Requests\StoreHostelBudgetSectionRequest;
use Modules\HM\Services\HostelBudgetSectionService;

class HostelBudgetSectionController extends Controller
{
    private $hostelBudgetSectionService;

    public function __construct(HostelBudgetSectionService $hostelBudgetSectionService)
    {
        $this->hostelBudgetSectionService = $hostelBudgetSectionService;
    }

    public function index()
    {
        $sections = $this->hostelBudgetSectionService->getHostelBudgetSectionLists();
        return view('hm::hostel-budget-section.index', compact('sections'));
    }


    public function create()
    {
        $reportShowOptions = HostelBudgetSection::getReportShowOptions();
        return view('hm::hostel-budget-section.create', compact('reportShowOptions'));
    }


    public function store(StoreHostelBudgetSectionRequest $request)
    {
        $section = $this->hostelBudgetSectionService->storeHostelBudgetSection($request->all());
        Session::flash('message', $section->getContent());
        return redirect(route('hostel-budget-section.index'));
    }

    public function edit($id)
    {
        $section = $this->hostelBudgetSectionService->findOrFail($id);
        $reportShowOptions = HostelBudgetSection::getReportShowOptions();
        return view('hm::hostel-budget-section.edit', compact('section', 'reportShowOptions'));
    }

    public function update(StoreHostelBudgetSectionRequest $request, $id)
    {
        $section = $this->hostelBudgetSectionService->updateBudgetSection($request->all(), $id);
        Session::flash('success', $section->getContent());
        return redirect(route('hostel-budget-section.index'));
    }


}
