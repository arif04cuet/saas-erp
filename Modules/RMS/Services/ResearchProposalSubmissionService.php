<?php

namespace Modules\RMS\Services;

use App\Constants\DesignationShortName;
use App\Constants\NotificationType;
use App\Constants\WorkflowStatus;
use App\Entities\User;
use App\Events\NotificationGeneration;
use App\Models\NotificationInfo;
use App\Services\Notification\ReviewUrlGenerator;
use App\Services\Sharing\ShareConversationService;
use App\Services\UserService;
use App\Services\workflow\FeatureService;
use App\Services\workflow\WorkFlowConversationService;
use App\Services\workflow\WorkflowMasterService;
use App\Services\workflow\WorkflowService;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Chumper\Zipper\Facades\Zipper;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Modules\HRM\Entities\Designation;
use Modules\HRM\Repositories\DesignationRepository;
use Modules\HRM\Repositories\EmployeeRepository;
use Modules\RMS\Entities\ResearchProposalSubmission;
use Modules\RMS\Entities\ResearchProposalSubmissionAttachment;
use Modules\RMS\Repositories\ResearchProposalSubmissionRepository;


class ResearchProposalSubmissionService
{
    use CrudTrait;
    use FileTrait;

    private $researchProposalSubmissionRepository;
    private $workflowService;
    private $featureService;
    private $userService;
    /**
     * @var WorkflowMasterService
     */
    private $workflowMasterService;
    /**
     * @var WorkFlowConversationService
     */
    private $workFlowConversationService;
    /**
     * @var ReviewUrlGenerator
     */
    private $reviewUrlGenerator;
    /*
     * @var $
     */
    private $employeeRepository;

    private $shareConversationService;
    private $designationRepository;

    /**
     * ResearchProposalSubmissionService constructor.
     * @param ResearchProposalSubmissionRepository $researchProposalSubmissionRepository
     * @param WorkflowService $workflowService
     * @param FeatureService $featureService
     * @param UserService $userService
     * @param ReviewUrlGenerator $reviewUrlGenerator
     */
    public function __construct(
        ResearchProposalSubmissionRepository $researchProposalSubmissionRepository,
        WorkflowService $workflowService,
        FeatureService $featureService,
        UserService $userService,
        ReviewUrlGenerator $reviewUrlGenerator,
        EmployeeRepository $employeeRepository,
        WorkflowMasterService $workflowMasterService,
        ShareConversationService $shareConversationService,
        DesignationRepository $designationRepository
    ) {
        $this->researchProposalSubmissionRepository = $researchProposalSubmissionRepository;
        $this->workflowService = $workflowService;
        $this->featureService = $featureService;
        $this->userService = $userService;
        $this->setActionRepository($researchProposalSubmissionRepository);
        $this->reviewUrlGenerator = $reviewUrlGenerator;
        $this->employeeRepository = $employeeRepository;
        $this->workflowMasterService = $workflowMasterService;
        $this->shareConversationService = $shareConversationService;
        $this->designationRepository = $designationRepository;
    }

    public function store(array $data, $divisionalDirector)
    {
        return DB::transaction(function () use ($data, $divisionalDirector) {
            $data['status'] = 'PENDING';

            $proposalSubmission = $this->save($data);

            foreach ($data['attachments'] as $file) {
                $fileName = $file->getClientOriginalName();
                $path = $this->upload($file, 'research-submissions');

                $file = new ResearchProposalSubmissionAttachment([
                    'attachments' => $path,
                    'submissions_id' => $proposalSubmission->id,
                    'file_name' => $fileName
                ]);

                $proposalSubmission->researchProposalSubmissionAttachments()->save($file);
            }

            //Save workflow

            $featureName = Config::get('constants.research_proposal_feature_name');
            $feature = $this->featureService->findBy(['name' => $featureName])->first();

            $workflowData = [
                'feature_id' => $feature->id,
                'rule_master_id' => $feature->workflowRuleMaster->id,
                'ref_table_id' => $proposalSubmission->id,
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
                    'ref_table_id' => $proposalSubmission->id,
                    'status' => 'SUBMITTED',
                    'message' => $proposalSubmission->title,
                    'designation_id' => $workflowData['designationTo']['1'],
                    'department_id' =>  $workflowData['department_id'],
                ],
                'research_proposal_submission',
                $this->reviewUrlGenerator->getRmsReviewUrl(
                    'research-proposal-submission-review',
                    $feature,
                    $proposalSubmission
                )
            );
        });
    }


    public function getAll()
    {
        return $this->researchProposalSubmissionRepository->findAll();
    }

    public function updateRequest(array $data, ResearchProposalSubmission $researchProposalSubmission)
    {
        return DB::transaction(function () use ($data, $researchProposalSubmission) {
            $data['status'] = 'PENDING';
            $proposalSubmission = $this->update($researchProposalSubmission, $data);

            foreach ($data['attachments'] as $file) {
                $fileName = $file->getClientOriginalName();
                $path = $this->upload($file, 'research-submissions');

                $file = new ResearchProposalSubmissionAttachment([
                    'attachments' => $path,
                    'submissions_id' => $researchProposalSubmission->id,
                    'file_name' => $fileName
                ]);

                $researchProposalSubmission->researchProposalSubmissionAttachments()->save($file);
            }
            return $proposalSubmission;
        });
    }

    public function getZipFilePath($proposalId)
    {
        $researchProposal = $this->findOne($proposalId);

        $filePaths = $researchProposal->researchProposalSubmissionAttachments->map(function ($attachment) {
            return Storage::disk('internal')->path($attachment->attachments);
        })->toArray();

        $fileName = time() . '.zip';

        $zipFilePath = Storage::disk('internal')->getAdapter()->getPathPrefix() . $fileName;

        Zipper::make($zipFilePath)->add($filePaths)->close();

        return $zipFilePath;
    }

    public function updateReInitiate(array $data, $researchProposalId)
    {
//        dd($data);
        return DB::transaction(function () use ($data, $researchProposalId) {
            $data['status'] = 'PENDING';
            $researchProposal = $this->researchProposalSubmissionRepository->findOne($researchProposalId);
            $proposalSubmission = $researchProposal->update($data);

            foreach ($data['attachments'] as $file) {
                $fileName = $file->getClientOriginalName();
                $path = $this->upload($file, 'research-submissions');
                $file = new ResearchProposalSubmissionAttachment([
                    'attachments' => $path,
                    'submissions_id' => $researchProposalId,
                    'file_name' => $fileName
                ]);
                $researchProposal->researchProposalSubmissionAttachments()->save($file);
            }
            $featureName = Config::get('constants.research_proposal_feature_name');
            $feature = $this->featureService->findBy(['name' => $featureName])->first();

            $reInitializeData = [
                'feature_id' => $feature->id,
                'ref_table_id' => $researchProposalId,
                'message' => $data['message'],
            ];

            $this->workflowService->reinitializeWorkflow($reInitializeData);

            //Send Notifications
            $wfMaster = $this->workflowMasterService->findBy([
                'feature_id' => $feature->id,
                'ref_table_id' => $researchProposalId
            ])->first();

            $this->generateRMSNotification(
                [
                    'ref_table_id' => $researchProposal->id,
                    'status' => WorkflowStatus::REINITIATED,
                    'item_title' => $researchProposal->title,
                    'designation_id' => Designation::whereShortName(DesignationShortName::DIRECTOR)->first()->id,
                    'workflow_master_id' => $wfMaster->id
                ],
                'research_proposal_submission',
                $this->reviewUrlGenerator->getRmsReviewUrl(
                    'research-proposal-submission-review',
                    $feature,
                    $researchProposal
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
                'ref_table_id' => $proposal->id,
                'status' => $status,
                'item_title' => $proposal->title,
                'to_users' => [$proposal->submittedBy],
            ],
            null,
            '#'
        );
        return Response(trans('labels.research_closed'));
    }

    public function getResearchProposalByStatus()
    {
        $projectProposalSubmission = new ResearchProposalSubmission();
        return [
            $projectProposalSubmission->where('status', '=', 'pending')->count(),
            $projectProposalSubmission->where('status', '=', 'in progress')->count(),
            $projectProposalSubmission->where('status', '=', 'reviewed')->count()
        ];
    }

    public function getResearchProposalBySubmissionDate()
    {
        return ResearchProposalSubmission::orderBy('id', 'DESC')
            ->limit(5)
            ->get()
            ->filter(function ($researchProposal) {

                return auth()->user()->employee->designation->short_name == "DG"
                    || (auth()->user()->employee->employeeDepartment->department_code == "RMS"
                        && auth()->user()->employee->designation->short_name != "FM")
                    || ($researchProposal->auth_user_id == auth()->user()->id);
            });
    }

    // Methods for triggering notifications
    public function generateRMSNotification($notificationData, $event = null, $url): void
    {

        $researchProposal = $this->findOne($notificationData['ref_table_id']);
        $activityBy = (array_key_exists('activity_by',
            $notificationData)) ? $notificationData['activity_by'] : $this->userService->getDesignation(Auth::user()->username);

        if ($notificationData['status'] == 'REVIEW') {
            $status = 'forwarded';
        } elseif ($notificationData['status'] == 'REJECTED') {
            $status = 'forwarded';
        } elseif ($notificationData['status'] == 'CLOSED_BY_REVIEWER') {
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
        ];
        if (array_key_exists('designation_id', $notificationData)) {
            $dynamicValues['notificationData']['designation_id'] = $notificationData['designation_id'];
        }
        if (array_key_exists('department_id', $notificationData)) {
            $dynamicValues['notificationData']['department_id'] = $notificationData['department_id'];
        }
        if (array_key_exists('workflow_master_id', $notificationData)) {
            $dynamicValues['notificationData']['workflow_master_id'] = $notificationData['workflow_master_id'];
        }
        if (array_key_exists('to_users', $notificationData)) {
            $dynamicValues['notificationData']['to_users'] = $notificationData['to_users'];
        }
        $dynamicValues['event'] = $event;

        event(new NotificationGeneration(new NotificationInfo(NotificationType::RESEARCH_PROPOSAL_SUBMISSION,
            $dynamicValues)));
    }


    //preparing data for notification sending
    public function sendNotification($request, $ShareConvId = null, $toUsers = null)
    {
//        dd($request->all());
        $proposalId = isset($request->item_id) ? $request->item_id : $request->ref_table_id;//sometime coming item_id something ref_table_id from the form
        $proposalSubmission = $this->findOne($proposalId);
        $feature = $this->featureService->findOne($request->feature_id);
        $notificationData = [
            'ref_table_id' => $proposalId,
            'status' => $request->input('status'),
            'item_title' => $proposalSubmission->title
        ];
        $url = '#';
        if ($request->status == 'REJECTED') { // when send back from workflow
//            $notificationData['to_users'] = [$proposalSubmission->submittedBy];

//            if (Auth::user()->employee->designation->short_name == DesignationShortName::DIRR) { // when send back from Director research
//                $notificationData['workflow_master_id'] = $request->workflow_master_id;
//            } else {
//                $notificationData['to_users'] = [$proposalSubmission->submittedBy];
//            }
            $activeWf = $this->workflowService->getActiveWorkflowByWFMasterId($request->workflow_master_id);
            if (!is_null($activeWf)) {
                $notificationData['workflow_master_id'] = $request->workflow_master_id;
            } else {
                $notificationData['to_users'] = [$proposalSubmission->submittedBy];
            }

        } elseif (!is_null($toUsers)) { // when approved by DG
            $notificationData['to_users'] = $toUsers;
        } elseif (!is_null($ShareConvId)) { //when sharing
            $notificationData['designation_id'] = $request->designation_id;
            $employee = $this->employeeRepository->findBy(['designation_id' => $notificationData['designation_id']])->first();
            if ($employee->designation->short_name == DesignationShortName::DIRR) {
                $url = $this->reviewUrlGenerator->getRmsReviewUrl('research-proposal-submission-review', $feature,
                    $proposalSubmission);
            } else {
                $url = route('research-proposal-submission.review',
                    [$proposalSubmission->id, $request->workflow_master_id, $ShareConvId]);
            }
        } elseif ($request->status == 'APPROVED') { // When approve from workflow
            $notificationData['workflow_master_id'] = $request->workflow_master_id;
            $url = $this->reviewUrlGenerator->getRmsReviewUrl('research-proposal-submission-review', $feature,
                $proposalSubmission);
        } else {  // from workflow
            $notificationData['workflow_master_id'] = $request->workflow_master_id;
            $url = $request->url;
        }

        $this->generateRMSNotification($notificationData, null, $url);


    }

    public function getResearchProposalForUser(User $user)
    {
        return $this->researchProposalSubmissionRepository->findAll()
            ->filter(function ($researchProposal) use ($user) {

                return $user->employee->designation->short_name == "DG"
                    || ($user->employee->employeeDepartment->department_code == "RMS"
                        && $user->employee->designation->short_name != "FM")
                    || ($researchProposal->auth_user_id == $user->id);
            });
    }

    public function researchProposalApproved($shareAndProposalIds)
    {
        $shareConversationId = explode('-', $shareAndProposalIds)[0];
        $researchProposalId = explode('-', $shareAndProposalIds)[1];

        $workflowMaster = $this->workflowMasterService->findBy(['ref_table_id' => $researchProposalId])->first();
        //approving workflow
        $this->workflowService->approveWorkflow($workflowMaster->id);
        //closing share conversation
        $this->shareConversationService->updateConversation(['ref_table_id' => $researchProposalId],
            $shareConversationId);

        //update main item
        $researchProposal = $this->researchProposalSubmissionRepository->findOne($researchProposalId);
        $researchProposal->update(['status' => WorkflowStatus::APPROVED]);
        // Generating Notification
        $notificationData = $this->bulkActionNotificationData($researchProposal, "APPROVED");
        $this->generateRMSNotification($notificationData, null, "#");
    }

    public function researchProposalReject($shareAndProposalIds)
    {
        $shareConversationId = explode('-', $shareAndProposalIds)[0];
        $researchProposalId = explode('-', $shareAndProposalIds)[1];

        //closing workflow
        $workflowMaster = $this->workflowMasterService->findBy(['ref_table_id' => $researchProposalId])->first();
        $this->workflowService->closeWorkflow($workflowMaster->id);

        //closing share conversation
        $this->shareConversationService->updateConversation(['ref_table_id' => $researchProposalId],
            $shareConversationId);

        //update main item
        $researchProposal = $this->researchProposalSubmissionRepository->findOne($researchProposalId);
        $researchProposal->update(['status' => WorkflowStatus::REJECTED]);
        // Generating Notification
        $notificationData = $this->bulkActionNotificationData($researchProposal, "REJECTED");
        $this->generateRMSNotification($notificationData, null, "#");
    }

    public function isProposalSubmitFromResearchDept()
    {
        return $this->userService->isResearchDivisionUser(Auth::user());
    }

    public function bulkActionNotificationData($item, $status)
    {
        $notificationData['ref_table_id'] = $item->id;
        $notificationData['item_title'] = $item->title;
        $notificationData['status'] = $status;
        $toUsers = [$item->submittedBy];
        $designation = $this->designationRepository->getDesignationsByShortCode([DesignationShortName::DIRECTOR])->first();
        $dirr = $this->userService->getUserByDesignationId($designation->id)[0];
        if (!is_null($dirr)) {
            array_push($toUsers, $dirr);
        }
        $notificationData['to_users'] = $toUsers;

        return $notificationData;
    }
}
