<?php

namespace Modules\RMS\Services;

use App\Constants\NotificationType;
use App\Entities\User;
use App\Events\NotificationGeneration;
use App\Models\NotificationInfo;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Carbon\Carbon;
use Chumper\Zipper\Facades\Zipper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Modules\RMS\Entities\ResearchRequest;
use Modules\RMS\Entities\ResearchRequestAttachment;
use Modules\RMS\Entities\ResearchRequestReceiver;
use Modules\RMS\Repositories\ResearchRequestRepository;
use App\Events\InvitationSent;
use App\Models\ProposalInvitation;

class ResearchRequestService
{
    use CrudTrait;
    use FileTrait;

    private $researchRequestRepository;


    public function __construct(ResearchRequestRepository $researchRequestRepository)
    {
        $this->researchRequestRepository = $researchRequestRepository;
        $this->setActionRepository($researchRequestRepository);
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            $data['end_date'] = Carbon::createFromFormat("j F, Y", $data['end_date']);
            $data['status'] = 'pending';

            $researchRequest = $this->save($data);

            foreach ($data['attachment'] as $file) {
                $fileName = $file->getClientOriginalName();
                $path = $this->upload($file, 'research-requests');

                $file = new ResearchRequestAttachment([
                    'attachments' => $path,
                    'research_request_id' => $researchRequest->id,
                    'file_name' => $fileName
                ]);

                $researchRequest->researchRequestAttachments()->save($file);
            }

            foreach ($data['to'] as $receiver) {
                $receiver = new ResearchRequestReceiver([
                    'to' => $receiver,
                    'research_request_id' => $researchRequest->id
                ]);

                $researchRequest->researchRequestReceivers()->save($receiver);
            }

            //Send Notifications
            $message = 'You have been invited to submit your proposal by ' . Auth::user()->name;
            $proposalInvitation = new ProposalInvitation(
                $data['to'],
                $researchRequest,
                $message,
                route('research-request.show', $researchRequest->id),
                1 // wow, this must be changed by the notification type for Research
            );
            event(new InvitationSent($proposalInvitation));
            return $researchRequest;
        });
    }

    public function getAll()
    {
        return $this->researchRequestRepository->findAll();
    }

    public function updateResearchRequest(array $data, ResearchRequest $researchRequest)
    {
        return DB::transaction(function () use ($data, $researchRequest) {
            $data['end_date'] = Carbon::createFromFormat("j F, Y", $data['end_date']);
            $data['status'] = 'PENDING';
            $request = $this->update($researchRequest, $data);
            foreach ($researchRequest->researchRequestAttachments as $attachment) {
                ResearchRequestAttachment::destroy($attachment->id);
                Storage::disk('internal')->delete($attachment->attachments);
            }

            foreach ($data['attachment'] as $file) {
                $fileName = $file->getClientOriginalName();
                $path = $this->upload($file, 'research-requests');

                $file = new ResearchRequestAttachment([
                    'attachments' => $path,
                    'research_request_id' => $researchRequest->id,
                    'file_name' => $fileName
                ]);

                $researchRequest->researchRequestAttachments()->save($file);

            }
            return $request;
        });

    }

    public function getZipFilePath($researchId)
    {
        $researchRequest = $this->findOne($researchId);

        $filePaths = $researchRequest->researchRequestAttachments->map(function ($attachment) {
            return Storage::disk('internal')->path($attachment->attachments);
        })->toArray();

        $fileName = time() . '.zip';

        $zipFilePath = Storage::disk('internal')->getAdapter()->getPathPrefix() . $fileName;

        Zipper::make($zipFilePath)->add($filePaths)->close();

        return $zipFilePath;
    }

    public function getResearchInvitationByDeadline()
    {
        return ResearchRequest::orderBy('end_date', 'DESC')
            ->where('end_date', '>=', Carbon::today())
            ->limit(5)
            ->get()
            ->filter(function ($researchRequest) {
                return ((in_array(auth()->user()->id,
                            $researchRequest->researchRequestReceivers->pluck('to')->toArray())
                        || auth()->user()->employee->employeeDepartment->department_code == "RMS")
                    && !$researchRequest->proposalsSubmittedByInvitedUserUnderReviewOrApproved->count());
            });
    }

    public function getInvitationsReceivedByUser()
    {
        return $this->researchRequestRepository->findAll()
            ->filter(function ($researchRequest) {
                return ((in_array(auth()->user()->id,
                            $researchRequest->researchRequestReceivers->pluck('to')->toArray())
                        || auth()->user()->employee->employeeDepartment->department_code == "RMS")
                    && !$researchRequest->proposalsSubmittedByInvitedUserUnderReviewOrApproved->count()
                    && Carbon::today()->lessThanOrEqualTo(Carbon::parse($researchRequest->end_date->format('Y-m-d'))));
            });
    }

    public function generateRMSNotification($notificationData, $event, $url): void
    {
        $researchProposal = $this->findOne($notificationData['ref_table_id']);
        $activityBy = (array_key_exists('activity_by',
            $notificationData)) ? $notificationData['activity_by'] : $this->userService->getDesignation(Auth::user()->username);
        $dynamicValues['notificationData'] = [
            'ref_table_id' => $notificationData['ref_table_id'],
            'from_user_id' => Auth::user()->id,
            'message' => $researchProposal->title . ' has been ' . $notificationData['status'] . ' by ' . $activityBy,
            'is_read' => 0,
            'url' => $url,
            'item_title' => $notificationData['item_title'],
        ];
        if (array_key_exists('designation_id', $notificationData)) {
            $dynamicValues['notificationData']['designation_id'] = $notificationData['designation_id'];
        }
        if (array_key_exists('workflow_master_id', $notificationData)) {
            $dynamicValues['notificationData']['workflow_master_id'] = $notificationData['workflow_master_id'];
        }
        $dynamicValues['event'] = $event;
        event(new NotificationGeneration(new NotificationInfo(NotificationType::RESEARCH_PROPOSAL_SUBMISSION,
            $dynamicValues)));
    }
}
