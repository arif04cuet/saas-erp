<?php
/**
 * Created by PhpStorm.
 * User: tuhin
 * Date: 10/18/18
 * Time: 5:18 PM
 */

namespace Modules\PMS\Services;

use App\Events\InvitationSent;
use App\Models\ProposalInvitation;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Carbon\Carbon;
use Chumper\Zipper\Facades\Zipper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Modules\PMS\Entities\ProjectRequestDetail;
use Modules\PMS\Entities\ProjectRequestDetailAttachment;
use Modules\PMS\Repositories\ProjectRequestDetailRepository;

class ProjectRequestDetailService
{
    use CrudTrait;
    use FileTrait;

    private $projectRequestDetailRepository;
    private $projectProposalService;

    /**
     * ProjectRequestDetailService constructor.
     * @param ProjectRequestDetailRepository $projectRequestDetailRepository
     * @param ProjectProposalService $projectProposalService
     */
    public function __construct(
        ProjectRequestDetailRepository $projectRequestDetailRepository,
        ProjectProposalService $projectProposalService
    )
    {
        $this->projectRequestDetailRepository = $projectRequestDetailRepository;
        $this->setActionRepository($this->projectRequestDetailRepository);
        $this->projectProposalService = $projectProposalService;
    }

    public function getAll()
    {
        return $this->projectRequestDetailRepository->findAll();
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {

            $data['end_date'] = Carbon::createFromFormat("j F, Y", $data['end_date']);

            $projectRequestDetail = $this->save($data);

            foreach ($data['attachments'] as $file) {
                $fileName = $file->getClientOriginalName();
                $path = $this->upload($file, 'project-request-details');

                $attachment = new ProjectRequestDetailAttachment([
                    'attachments' => $path,
                    'project_request_detail_id' => $projectRequestDetail->id,
                    'file_name' => $fileName
                ]);

                $projectRequestDetail->projectRequestDetailAttachments()->save($attachment);
            }

            $projectProposal = $this->projectProposalService->findOne($data['project_proposal_id']);
            $message = "You have been invited to submit details of your proposal by " . Auth::user()->name;

            $proposalInvitation = new ProposalInvitation(
                $projectProposal->proposalSubmittedBy->id,
                $projectRequestDetail,
                $message,
                route('project-request-details.show', $projectRequestDetail->id),
                2
            );

            event(new InvitationSent($proposalInvitation));

            return $projectRequestDetail;
        });
    }


    public function updateProjectRequestDetail(array $data, ProjectRequestDetail $projectRequestDetail)
    {
        return DB::transaction(function () use ($data, $projectRequestDetail) {

            $data['end_date'] = Carbon::createFromFormat("j F, Y", $data['end_date']);
            $request = $this->update($projectRequestDetail, $data);

            foreach ($projectRequestDetail->projectRequestDetailAttachments as $attachment) {
                ProjectRequestDetailAttachment::destroy($attachment->id);
                Storage::disk('internal')->delete($attachment->attachments);
            }

            foreach ($data['attachments'] as $file) {
                $fileName = $file->getClientOriginalName();
                $path = $this->upload($file, 'project-request-details');

                $attachment = new ProjectRequestDetailAttachment([
                    'attachments' => $path,
                    'project_request_detail_id' => $projectRequestDetail->id,
                    'file_name' => $fileName
                ]);

                $projectRequestDetail->projectRequestDetailAttachments()->save($attachment);

            }

            return $request;
        });

    }

    public function delete(ProjectRequest $projectRequest)
    {
        $projectRequest->requestForwards()->delete();

        return $this->projectRequestDetailRepository->delete($projectRequest);
    }

    public function requestApprove(ProjectRequest $projectRequest)
    {
        return $this->projectRequestDetailRepository->approveProjectProposal($projectRequest);
    }

    public function requestReject(ProjectRequest $projectRequest)
    {
        return $this->projectRequestDetailRepository->rejectProjectProposal($projectRequest);
    }

    public function storeForward($data)
    {
        return $this->projectRequestDetailRepository->forwardProjectRequestStore($data);
    }

    public function getForwardList()
    {
        return $this->projectRequestDetailRepository->findAll(null, ['requestForwards']);
    }

    public function getZipFilePath(ProjectRequestDetail $projectRequestDetail)
    {

        $filePaths = $projectRequestDetail->projectRequestDetailAttachments->map(function ($attachment) {
            return Storage::disk('internal')->path($attachment->attachments);
        })->toArray();

        $fileName = time() . '.zip';

        $zipFilePath = Storage::disk('internal')->getAdapter()->getPathPrefix() . $fileName;

        Zipper::make($zipFilePath)->add($filePaths)->close();

        return $zipFilePath;
    }

    public function getProjectInvitationByDeadline()
    {
        return ProjectRequest::orderBy('end_date', 'DESC')->limit(5)->get();
    }

    public function getInvitationReceivedByUser()
    {
        return $this->projectRequestDetailRepository->findAll()
            ->filter(function ($projectRequestDetail) {
                return ((auth()->user()->id == $projectRequestDetail->projectApprovedProposal->auth_user_id
                        || auth()->user()->employee->employeeDepartment->department_code == "PMS")
                    && !$projectRequestDetail->proposalsUnderReviewOrApproved->count()
                    && Carbon::today()->lessThanOrEqualTo(Carbon::parse($projectRequestDetail->end_date->format('Y-m-d'))));
            });
    }


}