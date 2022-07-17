<?php

namespace Modules\Publication\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Publication\Services\ResearchPaperFreeRequestService;
use Modules\HRM\Services\EmployeeService;
use Modules\Publication\Services\PublicationOrganizationService;
use Modules\Publication\Services\PublicationInventoryService;
use Modules\Publication\Http\Requests\ResearchPaperFreeRequestRequest;
use Modules\Publication\Services\PublishedResearchPaperService;



class ResearchPaperFreeRequestController extends Controller
{
    private $researchPaperFreeRequestService;
    /**
     * @var EmployeeService
     */
    private $employeeService;
    private $publicationOrganizationService;
    private $publishedResearchPaperService;


    /**
     * PublicationPressContractController constructor.
     * @param EmployeeService $employeeService
     * @param PublicationOrganizationService $publicationOrganizationService
     */
    public function __construct(
        ResearchPaperFreeRequestService $researchPaperFreeRequestService,
        EmployeeService $employeeService,
        PublicationOrganizationService $publicationOrganizationService,
        PublicationInventoryService $publicationInventoryService,
        PublishedResearchPaperService $publishedResearchPaperService

    ) {
        $this->researchPaperFreeRequestService = $researchPaperFreeRequestService;
        $this->employeeService = $employeeService;
        $this->publicationOrganizationService = $publicationOrganizationService;
        $this->publicationInventoryService = $publicationInventoryService;
        $this->publishedResearchPaperService = $publishedResearchPaperService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $researchPaperRequests = $this->researchPaperFreeRequestService->getDistributedPaper();
        return view('publication::research-paper-free-request.index', compact('researchPaperRequests'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $researches = $this->publishedResearchPaperService->getAllCompleted();
        $employees = $this->employeeService->getEmployeesForDropdown(
            null,
            null,
            null,
            true
        );
        $organizations = $this->publicationOrganizationService->getOrganizationsForDropdown(
            null,
            null,
            null,
            true
        );
        $page = "create";
        return view('publication::research-paper-free-request.create', compact('page', 'employees', 'organizations', 'researches'));
    }

    /**
     * Store a newly created resource in storage.
     * @param ResearchPaperFreeRequestRequest $request
     * @return Response
     */
    public function store(ResearchPaperFreeRequestRequest $request)
    {
        $this->researchPaperFreeRequestService->storeInResearchPaperFreeRequest($request->all());
        return redirect()->route('research-paper-free-requests.index')->with('success', __('labels.save_success'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $itemDetails = $this->researchPaperFreeRequestService->findOrFail($id);
        return view('publication::research-paper-free-request.show', compact('itemDetails'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('publication::edit');
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
    public function getAvailableAmount($id)
    {
        return $this->publicationInventoryService->getInventoryByPublishedPaperId($id);
    }
}
