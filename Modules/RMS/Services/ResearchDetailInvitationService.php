<?php
/**
 * Created by PhpStorm.
 * User: yousha
 * Date: 4/5/19
 * Time: 2:11 AM
 */

namespace Modules\RMS\Services;


use App\Events\InvitationSent;
use App\Models\ProposalInvitation;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Carbon\Carbon;
use Chumper\Zipper\Facades\Zipper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Modules\RMS\Entities\ResearchDetailInvitation;
use Modules\RMS\Entities\ResearchDetailInvitationAttachment;
use Modules\RMS\Repositories\ResearchDetailInvitationRepository;

class ResearchDetailInvitationService
{
    use CrudTrait;
    use FileTrait;

    private $researchDetailInvitationRepository;
    private $researchProposalSubmissionService;

    /**
     * ResearchDetailInvitationService constructor.
     * @param ResearchProposalSubmissionService $researchProposalSubmissionService
     * @param ResearchDetailInvitationRepository $researchDetailInvitationRepository
     */
    public function __construct(
        ResearchProposalSubmissionService $researchProposalSubmissionService,
        ResearchDetailInvitationRepository $researchDetailInvitationRepository
    )
    {
        $this->researchDetailInvitationRepository = $researchDetailInvitationRepository;
        $this->setActionRepository($this->researchDetailInvitationRepository);
        $this->researchProposalSubmissionService = $researchProposalSubmissionService;
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {

            $data['end_date'] = Carbon::createFromFormat('j F, Y', $data['end_date']);
            $data['status'] = "pending";

            $researchDetailInvitationRequest = $this->save($data);

            foreach($data['attachments'] as $file)
            {
                $fileName = $file->getClientOriginalName();
                $path = $this->upload($file, 'research-detail-invitations');

                $attachment = new ResearchDetailInvitationAttachment([
                    'attachments' => $path,
                    'research_detail_invitation_id' => $researchDetailInvitationRequest->id,
                    'file_name' => $fileName,
                ]);

                $researchDetailInvitationRequest->researchDetailInvitationAttachments()->save($attachment);

            }

            // Send Notification
            $researchProposalSubmission = $this->researchProposalSubmissionService->findOne($data['research_proposal_submission_id']);

            $message = "You have been invited to submit details of your proposal by " . Auth::user()->name;
            $url = route('research-proposal-details.invitation.show', $researchDetailInvitationRequest->id);

            $proposalInvitation = new ProposalInvitation(
                $researchProposalSubmission->submittedBy->id,
                $researchDetailInvitationRequest,
                $message,
                $url,
                1
            );

            event(new InvitationSent($proposalInvitation));

            return $researchDetailInvitationRequest;

        });
    }

    public function getAll()
    {
        return $this->researchDetailInvitationRepository->findAll();
    }

    public function updateResearchDetailInvitationRequest(array $data, ResearchDetailInvitation $researchDetailInvitation)
    {
        return DB::transaction(function() use ($data, $researchDetailInvitation) {

            $data['end_date'] = Carbon::createFromFormat('j F, Y', $data['end_date']);
            $data['status'] = "pending";

            $researchDetailInvitationRequest = $this->update($researchDetailInvitation, $data);

            foreach ($researchDetailInvitation->researchDetailInvitationAttachments as $attachment){
                ResearchDetailInvitationAttachment::destroy($attachment->id);
                Storage::disk('internal')->delete($attachment->attachments);
            }

            foreach ($data['attachments'] as $file) {
                $fileName = $file->getClientOriginalName();
                $path = $this->upload($file, 'research-detail-invitations');

                $attachment = new ResearchDetailInvitationAttachment([
                    'attachments' => $path,
                    'research_detail_invitation_id' => $researchDetailInvitation->id,
                    'file_name' => $fileName
                ]);

                $researchDetailInvitation->researchDetailInvitationAttachments()->save($attachment);

            }

            return $researchDetailInvitationRequest;

        });
    }

    public function getZipFilePath(ResearchDetailInvitation $researchDetailInvitation)
    {
        $filePaths = $researchDetailInvitation->researchDetailInvitationAttachments->map(function($attachment) {
            return Storage::disk('internal')->path($attachment->attachments);
        })->toArray();

        $fileName = time() . '.zip';

        $zipFilePath = Storage::disk('internal')->getAdapter()->getPathPrefix() . $fileName;

        Zipper::make($zipFilePath)->add($filePaths)->close();

        return $zipFilePath;
    }

    public function getResearchDetailInvitationByDeadline()
    {
        return ResearchDetailInvitation::orderBy('end_date', 'desc')->limit()->get();
    }

    public function getDetailInvitationReceivedByUser()
    {
        return $this->researchDetailInvitationRepository->findAll()
            ->filter(function ($researchDetailInvitaion) {
               return ((auth()->user()->id == $researchDetailInvitaion->researchApprovedProposal->auth_user_id
                       || auth()->user()->employee->employeeDepartment->department_code == "RMS")
                   && !$researchDetailInvitaion->proposalsUnderReviewOrApproved->count()
                   && Carbon::today()->lessThanOrEqualTo(Carbon::parse($researchDetailInvitaion->end_date->format('Y-m-d'))));
            });
    }
}