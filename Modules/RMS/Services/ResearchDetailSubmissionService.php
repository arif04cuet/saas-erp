<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 03/04/19
 * Time: 16:40
 */

namespace Modules\RMS\Services;


use App\Constants\DesignationShortName;
use App\Constants\NotificationType;
use App\Constants\WorkflowStatus;
use App\Entities\workflow\WorkflowMaster;
use App\Events\NotificationGeneration;
use App\Models\NotificationInfo;
use App\Services\Notification\ReviewUrlGenerator;
use App\Services\Sharing\ShareConversationService;
use App\Services\UserService;
use App\Services\workflow\FeatureService;
use App\Services\workflow\WorkflowMasterService;
use App\Services\workflow\WorkflowService;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Chumper\Zipper\Facades\Zipper;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Modules\HRM\Repositories\DesignationRepository;
use Modules\HRM\Repositories\EmployeeRepository;
use Modules\RMS\Entities\ResearchDetailSubmission;
use Modules\RMS\Entities\ResearchDetailSubmissionAttachment;
use Modules\RMS\Repositories\ResearchDetailSubmissionRepository;
use Prophecy\Doubler\Generator\TypeHintReference;

class ResearchDetailSubmissionService
{
    use CrudTrait;
    use FileTrait;
    /**
     * @var ResearchDetailSubmissionRepository
     */
    private $researchDetailSubmissionRepository;

    /*
     * @var featureService;
     */
    private $featureService;
    private $workflowService;
    private $userService;
    private $workflowMasterService;
    private $shareConversationService;

    /**
     * ResearchDetailSubmissionService constructor.
     * @param ResearchDetailSubmissionRepository $researchDetailSubmissionRepository
     */
    /**
     * @var ReviewUrlGenerator
     */
    private $reviewUrlGenerator;
    private $employeeRepository;
    private $designationRepository;

    public function __construct(
        ResearchDetailSubmissionRepository $researchDetailSubmissionRepository,
        FeatureService $featureService,
        WorkflowService $workflowService,
        UserService $userService,
        WorkflowMasterService $workflowMasterService,
        ShareConversationService $shareConversationService,
        ReviewUrlGenerator $reviewUrlGenerator,
        EmployeeRepository $employeeRepository,
        DesignationRepository $designationRepository
    ) {
        $this->researchDetailSubmissionRepository = $researchDetailSubmissionRepository;
        $this->featureService = $featureService;
        $this->workflowService = $workflowService;
        $this->userService = $userService;
        $this->workflowMasterService = $workflowMasterService;
        $this->shareConversationService = $shareConversationService;
        $this->reviewUrlGenerator = $reviewUrlGenerator;
        $this->employeeRepository = $employeeRepository;
        $this->designationRepository = $designationRepository;
        $this->setActionRepository($this->researchDetailSubmissionRepository);
    }

    public function storeResearchDetails($data, $divisionalDirector)
    {
        return DB::transaction(function () use ($data, $divisionalDirector) {
            $data['status'] = 'PENDING';
            $data['auth_user_id'] = Auth::user()->id;

            $researchDetailSubmission = $this->save($data);

            foreach ($data['attachments'] as $file) {
                $fileName = $file->getClientOriginalName();
                $path = $this->upload($file, 'research-detail-submissions');

                $file = new ResearchDetailSubmissionAttachment([
                    'attachments' => $path,
                    'research_detail_invitation_id' => $researchDetailSubmission->id,
                    'file_name' => $fileName
                ]);
                $researchDetailSubmission->researchDetailSubmissionAttachment()->save($file);
            }


            //            //Save workflow

            $featureName = config('rms.research_proposal_detail_feature');
            $feature = $this->featureService->findBy(['name' => $featureName])->first();

            $workflowData = [
                'feature_id' => $feature->id,
                'rule_master_id' => $feature->workflowRuleMaster->id,
                'ref_table_id' => $researchDetailSubmission->id,
                'message' => $data['message'],
                'designationTo' => [1 => $divisionalDirector->designation_id],
                'department_id' => $divisionalDirector->department_id
            ];

            //if ($this->isProposalSubmitFromResearchDept()) {
                $workflowData['skipped'] = [1];
            //}

            $this->workflowService->createWorkflow($workflowData);

            //            Research Proposal Brief Notification
            $this->generateRMSNotification(
                [
                    'ref_table_id' => $researchDetailSubmission->id,
                    'status' => 'SUBMITTED',
                    'item_title' => $researchDetailSubmission->title,
                    'designation_id' => $workflowData['designationTo']['1'],
                    'department_id' => $workflowData['department_id']
                ],
                'research_proposal_submission',
                $this->reviewUrlGenerator->getRDetailReviewUrl(
                    'research-proposal-detail-review',
                    $feature,
                    $researchDetailSubmission
                )
            );

            return $researchDetailSubmission;
        });
    }

    // Methods for triggering notifications
    public function generateRMSNotification($notificationData, $event = null, $url): void
    {
        //dd($notificationData);
        $researchProposal = $this->findOne($notificationData['ref_table_id']);
        $activityBy = (array_key_exists('activity_by', $notificationData)) ? $notificationData['activity_by'] : $this->userService->getDesignation(Auth::user()->username);

        if ($notificationData['status'] == 'REVIEW')
            $status = 'Forwarded';
        elseif ($notificationData['status'] == 'REJECTED')
            $status = 'Forwarded';
        elseif ($notificationData['status'] == 'CLOSED_BY_REVIEWER') {
            $status = 'Rejected';
        } elseif ($notificationData['status'] == 'CLOSED_BY_OWNER') {
            $status = 'Closed';
        } else {
            $status = $notificationData['status'];
        }
        //        $status = ($notificationData['status'] == 'REVIEW') ? 'Reviewed' : $notificationData['status'];
        $dynamicValues['notificationData'] = [
            'ref_table_id' => $notificationData['ref_table_id'],
            'from_user_id' => Auth::user()->id,
            'message' => $researchProposal->title . ' has been ' . $status . ' by ' . $activityBy,
            'is_read' => 0,
            'item_url' => $url,
            'item_title' => $notificationData['item_title'],
        ];
        if (array_key_exists('designation_id', $notificationData)) $dynamicValues['notificationData']['designation_id'] = $notificationData['designation_id'];
        if (array_key_exists('department_id', $notificationData)) $dynamicValues['notificationData']['department_id'] = $notificationData['department_id'];
        if (array_key_exists('workflow_master_id', $notificationData)) $dynamicValues['notificationData']['workflow_master_id'] = $notificationData['workflow_master_id'];
        if (array_key_exists('to_users', $notificationData)) $dynamicValues['notificationData']['to_users'] = $notificationData['to_users'];
        $dynamicValues['event'] = $event;
        //        dd($dynamicValues);
        event(new NotificationGeneration(new NotificationInfo(NotificationType::RESEARCH_PROPOSAL_SUBMISSION, $dynamicValues)));
    }


    //preparing data for notification sending
    public function sendNotification($request, $ShareConvId = null, $toUsers = null)
    {
        //        dd($ShareConvId);
        //        dd($request->all());
        $proposalId = isset($request->item_id) ? $request->item_id : $request->ref_table_id; //sometime coming item_id something ref_table_id from the form
        $proposalSubmission = $this->findOne($proposalId);

        $feature = $this->featureService->findOne($request->feature_id);
        $notificationData = [
            'ref_table_id' => $proposalId,
            'status' => $request->input('status'),
            'item_title' => $proposalSubmission->title
        ];
        $url = '#';

        if ($request->status == 'REJECTED') { // when send back from workflow
            //            if (Auth::user()->employee->designation->short_name == DesignationShortName::DIRR) { // when send back from Director research

            $activeWf = $this->workflowService->getActiveWorkflowByWFMasterId($request->workflow_master_id);
            if (!is_null($activeWf)) {
                $notificationData['workflow_master_id'] = $request->workflow_master_id;
            } else {
                $notificationData['to_users'] = [$proposalSubmission->user];
            }
            //                dd($notificationData);
            //                $url = $this->reviewUrlGenerator->getRDetailReviewUrl('research-proposal-detail-review', $feature, $proposalSubmission);
            //            } else {
            //                $notificationData['to_users'] = [$proposalSubmission->user];
            //            }

        } elseif (!is_null($toUsers)) { // when approved by DG
            $notificationData['to_users'] = $toUsers;
        } elseif (!is_null($ShareConvId)) { //when sharing

            $notificationData['designation_id'] = $request->designation_id;
            $employee = $this->employeeRepository->findBy(['designation_id' => $notificationData['designation_id']])->first();
            if ($employee->designation->short_name == DesignationShortName::DIRR) {
                $url = $this->reviewUrlGenerator->getRDetailReviewUrl('research-proposal-detail-review', $feature, $proposalSubmission);
            } else {
                $url = route('research-detail.review', [$proposalSubmission->id, $request->workflow_master_id, $ShareConvId]);
            }
            //            dd($url);
        } elseif ($request->status == 'APPROVED') { // When approve from workflow

            $notificationData['workflow_master_id'] = $request->workflow_master_id;
            $url = $this->reviewUrlGenerator->getRDetailReviewUrl('research-proposal-detail-review', $feature, $proposalSubmission);
        } else {  // review from workflow
            $notificationData['workflow_master_id'] = $request->workflow_master_id;
            $url = $request->url;
        }
        //        dd($notificationData);
        $this->generateRMSNotification($notificationData, null, $url);
    }

    public function isProposalSubmitFromResearchDept()
    {
        return $this->userService->isResearchDivisionUser(Auth::user());
    }

    public function researchDetailApproved($shareAndProposalDetailId)
    {

        //        foreach ($shareAndProposalDetailIds as $shareAndProposalId) {
        $shareConversationId = explode('-', $shareAndProposalDetailId)[0];
        $researchProposalDetailId = explode('-', $shareAndProposalDetailId)[1];
        $workflowMaster = $this->workflowMasterService->findBy(['ref_table_id' => $researchProposalDetailId])->first();
        //approving workflow
        $this->workflowService->approveWorkflow($workflowMaster->id);
        //closing share conversation
        $this->shareConversationService->updateConversation(['ref_table_id' => $researchProposalDetailId], $shareConversationId);

        //update main item
        $researchDetail = $this->researchDetailSubmissionRepository->findOne($researchProposalDetailId);
        $researchDetail->update(['status' => WorkflowStatus::APPROVED]);
        // Generating Notification
        $notificationData = $this->bulkActionNotificationData($researchDetail, "APPROVED");
        $this->generateRMSNotification($notificationData, null, "#");

        //        }
    }

    public function researchDetailReject($shareAndProposalIds)
    {
        $shareConversationId = explode('-', $shareAndProposalIds)[0];
        $researchProposalId = explode('-', $shareAndProposalIds)[1];

        //closing workflow
        $workflowMaster = $this->workflowMasterService->findBy(['ref_table_id' => $researchProposalId])->first();
        $this->workflowService->closeWorkflow($workflowMaster->id);

        //closing share conversation
        $this->shareConversationService->updateConversation(['ref_table_id' => $researchProposalId], $shareConversationId);

        //update main item
        $researchProposal = $this->researchDetailSubmissionRepository->findOne($researchProposalId);
        $researchProposal->update(['status' => WorkflowStatus::REJECTED]);
        // Generating Notification
        $notificationData = $this->bulkActionNotificationData($researchProposal, "REJECTED");
        $this->generateRMSNotification($notificationData, null, "#");
    }

    public function updateReInitiate(array $data, $researchDetailId)
    {
        return DB::transaction(function () use ($data, $researchDetailId) {
            $data['status'] = 'PENDING';
            $researchDetail = $this->researchDetailSubmissionRepository->findOne($researchDetailId);
            $proposalSubmission = $researchDetail->update($data);

            foreach ($data['attachments'] as $file) {

                $fileName = $file->getClientOriginalName();
                $path = $this->upload($file, 'research-submissions');

                $file = new ResearchDetailSubmissionAttachment([
                    'attachments' => $path,
                    'research_detail_submission_id' => $researchDetailId,
                    'file_name' => $fileName
                ]);

                $researchDetail->researchDetailSubmissionAttachment()->save($file);
            }
            $DetailFeatureName = config('rms.research_proposal_detail_feature');
            $feature = $this->featureService->findBy(['name' => $DetailFeatureName])->first();

            $reInitializeData = [
                'feature_id' => $feature->id,
                'ref_table_id' => $researchDetailId,
                'message' => $data['message'],
            ];

            $this->workflowService->reinitializeWorkflow($reInitializeData);

            //Send Notifications
            //Send Notifications
            $wfMaster = $this->workflowMasterService->findBy(['feature_id' => $feature->id, 'ref_table_id' => $researchDetailId])->first();
            $this->generateRMSNotification(
                [
                    'ref_table_id' => $researchDetail->id,
                    'status' => WorkflowStatus::REINITIATED,
                    'item_title' => $researchDetail->title,
                    'workflow_master_id' => $wfMaster->id
                ],
                null,
                $this->reviewUrlGenerator->getRDetailReviewUrl(
                    'research-proposal-detail-review',
                    $feature,
                    $researchDetail
                )
            );


            return new Response(trans('rms::research_proposal.re_initiate_success'));
        });
    }

    public function closeWorkflow($workflowMasterId, $proposal = null, $status = null)
    {
        $response = $this->workflowService->closeWorkflow($workflowMasterId);
        $this->generateRMSNotification(
            [
                'ref_table_id' => $proposal->id, 'status' => $status, 'item_title' => $proposal->title,
                'to_users' => [$proposal->user],
            ],
            null,
            '#'
        );
        return Response(trans('labels.research_closed'));
    }

    public function getZipFilePath(ResearchDetailSubmission $researchDetailSubmission)
    {
        $filePaths = $researchDetailSubmission->researchDetailSubmissionAttachment->map(function ($attachment) {
            return Storage::disk('internal')->path($attachment->attachments);
        })->toArray();

        $fileName = time() . '.zip';

        $zipFilePath = Storage::disk('internal')->getAdapter()->getPathPrefix() . $fileName;

        Zipper::make($zipFilePath)->add($filePaths)->close();

        return $zipFilePath;
    }

    public function getResearchDetailProposalForUser(User $user)
    {
        return $this->researchDetailSubmissionRepository->findAll()
            ->filter(function ($researchDetailProposal) use ($user) {

                return $user->employee->designation->short_name == "DG"
                    || ($user->employee->employeeDepartment->department_code == "RMS"
                        && $user->employee->designation->short_name != "FM")
                    || ($researchDetailProposal->auth_user_id == $user->id);
            });
    }

    public function getRemainingApprovedDetailProposal()
    {
        $this->proposals = [];

        $this->researchDetailSubmissionRepository->findAll()
            ->filter(function ($researchDetailSubmission) {
                return $researchDetailSubmission->status == 'APPROVED'
                    && $researchDetailSubmission->research_id == null
                    && $researchDetailSubmission->auth_user_id == auth()->user()->id;
            })
            ->map(function ($researchDetailSubmission) {

                $this->proposals[$researchDetailSubmission->id] = $researchDetailSubmission->title;
            });

        return $this->proposals;
    }

    public function bulkActionNotificationData($item, $status)
    {
        $notificationData['ref_table_id'] = $item->id;
        $notificationData['item_title'] = $item->title;
        $notificationData['status'] = $status;
        $toUsers = [$item->user];
        $designation = $this->designationRepository->getDesignationsByShortCode([DesignationShortName::DIRECTOR])->first();
        $dirr = $this->userService->getUserByDesignationId($designation->id)[0];
        if (!is_null($dirr)) {
            array_push($toUsers, $dirr);
        }
        $notificationData['to_users'] = $toUsers;

        return $notificationData;
    }
}
