<?php

namespace Modules\PMS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Modules\PMS\Entities\ProjectProposal;
use Modules\PMS\Entities\ProjectRequestDetail;
use Modules\PMS\Entities\ProjectRequestDetailAttachment;
use Modules\PMS\Http\Requests\CreateProjectRequestDetailRequest;
use Modules\PMS\Http\Requests\UpdateProjectRequestDetailRequest;
use Modules\PMS\Services\ProjectRequestDetailService;

class ProjectRequestDetailsController extends Controller
{
    private $projectDetailsRequestService;

    /**
     * ProjectRequestDetailsController constructor.
     * @param ProjectRequestDetailService $projectDetailsRequestService
     */
    public function __construct(ProjectRequestDetailService $projectDetailsRequestService)
    {
        $this->projectDetailsRequestService = $projectDetailsRequestService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $requests = $this->projectDetailsRequestService->getInvitationReceivedByUser();
        return view('pms::project-request.details.index', compact('requests'));
    }

    /**
     * @param ProjectProposal $projectProposal
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(ProjectProposal $projectProposal)
    {
        return view('pms::project-request.details.create', compact('projectProposal'));
    }

    /**
     * @param CreateProjectRequestDetailRequest $createProjectRequestDetailRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateProjectRequestDetailRequest $createProjectRequestDetailRequest)
    {
        $this->projectDetailsRequestService->store($createProjectRequestDetailRequest->all());

        Session::flash('success', trans('labels.save_success'));

        return redirect()->route('project-request-details.index');
    }

    /**
     * @param ProjectRequestDetail $projectRequestDetail
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(ProjectRequestDetail $projectRequestDetail)
    {
        return view('pms::project-request.details.show', compact('projectRequestDetail'));
    }

    /**
     * @param ProjectRequestDetail $projectRequestDetail
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(ProjectRequestDetail $projectRequestDetail)
    {
        return view('pms::project-request.details.edit', compact('projectRequestDetail'));
    }

    /**
     * @param UpdateProjectRequestDetailRequest $updateProjectRequestDetailRequest
     * @param ProjectRequestDetail $projectRequestDetail
     */
    public function update(UpdateProjectRequestDetailRequest $updateProjectRequestDetailRequest, ProjectRequestDetail $projectRequestDetail)
    {
        $this->projectDetailsRequestService->updateProjectRequestDetail($updateProjectRequestDetailRequest->all(), $projectRequestDetail);

        Session::flash('success', trans('labels.save_success'));

        return redirect()->route('project-request-details.index');

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

    public function attachmentDownload(ProjectRequestDetail $projectRequestDetail)
    {
        return response()->download($this->projectDetailsRequestService->getZipFilePath($projectRequestDetail));
    }

    public function fileDownload($attachmentId)
    {
        $projectRequestDetailAttachment = ProjectRequestDetailAttachment::findOrFail($attachmentId);

        $basePath = Storage::disk('internal')->path($projectRequestDetailAttachment->attachments);

        return response()->download($basePath);
    }
}
