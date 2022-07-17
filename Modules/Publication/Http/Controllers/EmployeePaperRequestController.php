<?php

namespace Modules\Publication\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Publication\Services\EmployeePaperRequestService;
use Modules\Publication\Services\ResearchPaperFreeRequestService;
use Modules\Publication\Http\Requests\EmployeePaperRequestRequest;
use Modules\Publication\Services\PublicationInventoryService;
use Modules\Publication\Services\PublishedResearchPaperService;


use Illuminate\Support\Facades\Auth;

class EmployeePaperRequestController extends Controller
{
    private $publishedResearchPaperService;
    private $employeePaperRequestService;
    /**
     * @var EmployeeService
     */


    public function __construct(
        EmployeePaperRequestService $employeePaperRequestService,
        PublicationInventoryService $publicationInventoryService,
        ResearchPaperFreeRequestService $researchPaperFreeRequestService,
        PublishedResearchPaperService $publishedResearchPaperService

    ) {
        $this->employeePaperRequestService = $employeePaperRequestService;
        $this->publicationInventoryService = $publicationInventoryService;
        $this->researchPaperFreeRequestService = $researchPaperFreeRequestService;
        $this->publishedResearchPaperService = $publishedResearchPaperService;
    }


    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $researchPaperRequests = $this->researchPaperFreeRequestService->getRequestedPaper();
        return view('publication::employee-paper-request.index', compact('researchPaperRequests'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $researches = $this->publishedResearchPaperService->getAllCompleted();
        $page = "create";
        return view('publication::employee-paper-request.create', compact('page', 'researches'));
    }

    /**
     * Store a newly created resource in storage.
     * @param EmployeePaperRequestRequest $request
     * @return Response
     */
    public function store(EmployeePaperRequestRequest $request)
    {
        $this->employeePaperRequestService->storeInResearchPaperFreeRequest($request->all());
        return redirect()->route('employee-paper-requests.index')->with('success', __('labels.save_success'));
    }

    public function acceptRequest($id)
    {
        $itemDetails = $this->researchPaperFreeRequestService->findOrFail($id);
        $publishedResearchPaperId  = $itemDetails['published_research_paper_id'];

        $publishedResearchPaper =  $this->publicationInventoryService->getInventoryByPublishedPaperId($publishedResearchPaperId);
        $availableAmount = $publishedResearchPaper['available_amount'];

        $requestedPublication =  $this->employeePaperRequestService->approveRequestedPublicationByEmployee($id, $availableAmount);
        if ($requestedPublication) {
            return redirect()->route('employee-paper-requests.index')->with('success', __('labels.save_success'));
        } else {
            return redirect()->route('employee-paper-requests.index')->with('error', __('labels.approval_failed_for_amount'));
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('publication::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $page = "edit";
        $researches = $this->publishedResearchPaperService->getAllCompleted();
        $employeePaperRequest =  $this->employeePaperRequestService->findOrFail($id);
        return view('publication::employee-paper-request.create', compact('employeePaperRequest', 'page', 'researches'));
    }

    /**
     * Update the specified resource in storage.
     * @param EmployeePaperRequestRequest $request
     * @param int $id
     * @return Response
     */
    public function update(EmployeePaperRequestRequest $request, $id)
    {
        $this->employeePaperRequestService->findOrFail($id)->update($request->all());
        $researchPaperFreeRequest['id'] = $id;
        $this->employeePaperRequestService->sendNotificationForEmployeePaperRequest($researchPaperFreeRequest);
        return redirect()->route('employee-paper-requests.index')->with('success', __('labels.update_success'));
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
