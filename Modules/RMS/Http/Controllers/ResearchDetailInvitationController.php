<?php

namespace Modules\RMS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Modules\RMS\Entities\ResearchDetailInvitation;
use Modules\RMS\Entities\ResearchDetailInvitationAttachment;
use Modules\RMS\Entities\ResearchProposalSubmission;
use Modules\RMS\Http\Requests\CreateResearchDetailInvitationRequest;
use Modules\RMS\Http\Requests\UpdateResearchDetailInvitationRequest;
use Modules\RMS\Services\ResearchDetailInvitationService;

class ResearchDetailInvitationController extends Controller
{

    private $researchDetailInvitationService;

    /**
     * ResearchDetailInvitationController constructor.
     * @param EmployeeServices $employeeServices
     */
    public function __construct(ResearchDetailInvitationService $researchDetailInvitationService)
    {

        $this->researchDetailInvitationService = $researchDetailInvitationService;
    }

    public function index()
    {
        $detailsInvitations = $this->researchDetailInvitationService->getDetailInvitationReceivedByUser();
        return view('rms::research-details.invitation.index', compact('detailsInvitations'));

    }

    /**
     * @param ResearchProposalSubmission $researchProposalSubmission
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(ResearchProposalSubmission $researchProposalSubmission)
    {

        return view('rms::research-details.invitation.create', compact('researchProposalSubmission'));
    }

    /**
     * @param CreateResearchDetailInvitationRequest $createResearchDetailInvitaionRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateResearchDetailInvitationRequest $createResearchDetailInvitaionRequest)
    {
        $this->researchDetailInvitationService->store($createResearchDetailInvitaionRequest->all());
        return redirect()->route('invitations');
    }

    /**
     * @param ResearchDetailInvitation $researchDetailInvitation
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(ResearchDetailInvitation $researchDetailInvitation)
    {
        return view('rms::research-details.invitation.show', compact('researchDetailInvitation'));
    }

    /**
     * @param ResearchDetailInvitation $researchDetailInvitation
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(ResearchDetailInvitation $researchDetailInvitation)
    {
        return view('rms::research-details.invitation.edit', compact('researchDetailInvitation'));
    }

    /**
     * @param UpdateResearchDetailInvitationRequest $updateResearchDetailInvitationRequest
     * @param ResearchDetailInvitation $researchDetailInvitation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateResearchDetailInvitationRequest $updateResearchDetailInvitationRequest, ResearchDetailInvitation $researchDetailInvitation)
    {
        $this->researchDetailInvitationService->updateResearchDetailInvitationRequest($updateResearchDetailInvitationRequest->all(), $researchDetailInvitation);
        Session::flash('success', trans('labels.success'));
        return redirect()->route('invitations');
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        //
    }

    public function attachmentDownload(ResearchDetailInvitation $researchDetailInvitation)
    {
        return response()->download($this->researchDetailInvitationService->getZipFilePath($researchDetailInvitation));
    }

    public function fileDownload($attachmentId)
    {
        $researchDetailInvitationAttachment = ResearchDetailInvitationAttachment::findOrFail($attachmentId);

        $basePath = Storage::disk('internal')->path($researchDetailInvitationAttachment->attachments);
        return response()->download($basePath);
    }
}
