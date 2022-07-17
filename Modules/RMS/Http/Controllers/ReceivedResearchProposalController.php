<?php

namespace Modules\RMS\Http\Controllers;

use App\Services\OrganizableService;
use App\Services\OrganizationService;
use function GuzzleHttp\Promise\all;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Modules\PMS\Http\Requests\StoreOrganizationRequest;
use Modules\RMS\Services\ResearchProposalSubmissionService;

class ReceivedResearchProposalController extends Controller
{
    /**
     * @var ResearchProposalSubmissionService
     */
    private $researchProposalSubmissionService;
    private $organizationService;
    private $organizableService;

    public function __construct(ResearchProposalSubmissionService $researchProposalSubmissionService,
    OrganizableService $organizableService, OrganizationService $organizationService)
    {
        /** @var ResearchProposalSubmissionService $researchProposalSubmissionService */
        $this->researchProposalSubmissionService = $researchProposalSubmissionService;
        $this->organizationService = $organizationService;
        $this->organizableService = $organizableService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $proposals = $this->researchProposalSubmissionService->getAll();
        return view('rms::proposal.received.index', compact('proposals'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('rms::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('rms::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('rms::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }

    public function addOrganization($researchId)
    {

        $type = Config::get('constants.research');
        $organizations = $this->organizationService->getAllOrganization($researchId, $type);
        $research = $this->researchProposalSubmissionService->findOne($researchId);


        return view('rms::organization.add_organization', compact('research', 'organizations', 'type'));

    }

    public function storeOrganization(StoreOrganizationRequest $request, $researchId)
    {
        $response = $this->organizableService->storeData($request->all(), $researchId);
        Session::flash('message', $response->getContent());
        return redirect()->route('organization.add-research-organization', $researchId);
    }
}
