<?php

namespace Modules\PMS\Http\Controllers;


use App\Services\OrganizableService;
use App\Services\OrganizationService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Modules\PMS\Http\Requests\StoreOrganization;
use Modules\PMS\Http\Requests\StoreOrganizationRequest;
use Modules\PMS\Services\ProjectProposalService;
use Prophecy\Doubler\Generator\TypeHintReference;


class ReceivedProjectProposalController extends Controller
{
    private $projectProposalService;
    private $organizationService;
    private $organizableService;


    public function __construct(ProjectProposalService $projectProposalService,
                                OrganizationService $organizationService,
                                OrganizableService $organizableService)
    {
        $this->projectProposalService = $projectProposalService;
        $this->organizationService = $organizationService;
        $this->organizableService = $organizableService;
    }

    public function index()
    {
        $proposals = $this->projectProposalService->getProposalsForUser(Auth::user());
        return view('pms::proposal-submitted.index', compact('proposals'));
    }


    public function create()
    {
        return view('pms::create');
    }


    public function show($id)
    {
        $proposal = $this->projectProposalService->findOrFail($id);
        return view('pms::proposal-submitted.show', compact('proposal'));
    }

    public function edit()
    {
        return view('pms::edit');
    }

    public function addOrganization($projectId)
    {

        $type = Config::get('constants.project');

        $organizations = $this->organizationService->getAllOrganization($projectId, $type);
        $proposal = $this->projectProposalService->getProposalById($projectId);

        return view('pms::proposal-submitted.add_organization', compact('proposal', 'organizations', 'type'));
    }

    public function storeOrganization(StoreOrganizationRequest $request, $projectId)
    {
        $response = $this->organizableService->storeData($request->all(), $projectId);
        Session::flash('message', $response->getContent());

        return redirect()->route('project-proposal-submitted.view', $projectId);
    }
}
