<?php
/**
 * Created by PhpStorm.
 * User: artisan33
 * Date: 1/24/19
 * Time: 6:36 PM
 */

namespace Modules\RMS\Services;

use App\Constants\NotificationType;
use App\Entities\User;
use App\Events\NotificationGeneration;
use App\Models\NotificationInfo;
use App\Services\Notification\ReviewUrlGenerator;
use App\Services\TaskService;
use App\Services\UserService;
use App\Services\workflow\FeatureService;
use App\Services\workflow\WorkflowService;
use App\Traits\CrudTrait;

use Illuminate\Http\Response;

use App\Traits\FileTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Modules\RMS\Repositories\ResearchPublicationRepository;
use Modules\RMS\Repositories\ResearchRepository;


class ResearchService
{

    use CrudTrait;
    use FileTrait;
    /**
     * @var ResearchRepository
     */
    private $researchRepository;
    private $researchPublicationRepository;
    /**
     * @var TaskService
     */
    private $taskService;
    /**
     * @var $featureService ;
     */
    private $featureService;
    /**
     * @var $workflowService
     */
    private $workflowService;

    private $researchPublicationAttachmentRepository;

    private $userService;

    private $researchDetailSubmissionService;
    private $reviewUrlGenerator;

    /**
     * ResearchService constructor.
     * @param ResearchRepository $researchRepository
     * @param FeatureService $featureService
     * @param WorkflowService $workflowService
     * @param ResearchPublicationRepository $researchPublicationRepository
     */

    public function __construct(ResearchRepository $researchRepository, FeatureService $featureService, WorkflowService $workflowService,
                                ResearchPublicationRepository $researchPublicationRepository, UserService $userService,
                                ResearchDetailSubmissionService $researchDetailSubmissionService, ReviewUrlGenerator $reviewUrlGenerator)

    {
        $this->researchRepository = $researchRepository;
        $this->researchPublicationRepository = $researchPublicationRepository;
        $this->setActionRepository($researchRepository);
        $this->featureService = $featureService;
        $this->workflowService = $workflowService;
        $this->userService = $userService;
        $this->researchDetailSubmissionService = $researchDetailSubmissionService;
        $this->reviewUrlGenerator = $reviewUrlGenerator;
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {

            $research = $this->researchRepository->save($data);
            $this->researchDetailSubmissionService->update($this->researchDetailSubmissionService->findOrFail($data['research_detail_submission_id']), ['research_id' => $research->id]);

            return $research;
        });
    }

    public function getAll()
    {
        return $this->researchRepository->findAll();
    }

    public function savePublication($data, $researchId)
    {
       DB::transaction(function () use ($data, $researchId) {
        $publicationData = ['research_id' => $researchId, 'description' => $data['description']];
        $publication = $this->researchPublicationRepository->save($publicationData);
        $research = $this->findOne($researchId);
        if (array_key_exists('attachments', $data)) $this->savePublicationAttachments($publication->id, $data);

        //Save workflow
        $featureName = Config::get('rms.research_feature_name');
        $feature = $this->featureService->findBy(['name' => $featureName])->first();
        $workflowRuleMaster = $feature->workflowRuleMaster;
        $workflowData = [
            'feature_id' => $feature->id,
            'rule_master_id' => $workflowRuleMaster->id,
            'ref_table_id' => $researchId,
            'message' => $data['message'],
            'designationTo' => [1 => $workflowRuleMaster->ruleDetails[0]->designation_id],
            'department_id' => 1 // research department
        ];

        $this->workflowService->createWorkflow($workflowData);

        // Research Publication Notification
        $featureName = Config::get('rms.research_feature_name');
        $feature = $this->featureService->findBy(['name' => $featureName])->first();
        $workflowRuleMaster = $feature->workflowRuleMaster;
        $this->generatePublicationNotification(
            [
                'ref_table_id' => $publication->id,
                'status' => 'SUBMITTED',
                'item_title' => $research->title,
                'designation_id' => $workflowRuleMaster->ruleDetails[0]->designation_id,
                'department_id' => 1 // research department
            ],
            null,
            $this->reviewUrlGenerator->getResearchReviewUrl(
                'research-publication.review',
                $feature,
                $research
            )
        );

       });

       return true;
    }

    public function updatePublicationForReInitialize($data, $publicationId)
    {

        $publicationData = ['research_id' => $data['research_id'], 'description' => $data['description']];
        $publication = $this->researchPublicationRepository->findOne($publicationId);
        $status = $publication->update($publicationData);

        if (isset($data['fileRepeater'])) {
            $this->deleteOldAttachment($data, $publication);
            $this->storeNewAttachment($data, $publication);
        } else {
            $publication->attachments()->whereResearchPublicationId($publicationId)->delete();
        }
        return true;
    }

    public function deleteOldAttachment($data, $publication)
    {

        $oldFiles = array_column($data['fileRepeater'], 'oldFiles');
        if (count($oldFiles) > 0) {
            foreach ($publication->attachments as $attachment) {
                if (in_array($attachment->id, $oldFiles)) {
                    continue;
                } else {
                    $attachment->delete();
                }
            }
            return true;
        } else {
            $publication->attachments()->whereResearchPublicationId($publication->id)->delete();
        }

    }

    public function storeNewAttachment($data, $publication)
    {
        $files = array_column($data['fileRepeater'], 'file');
        foreach ($files as $file) {
            $ext = $file->getClientOriginalExtension();
            $filePath = $this->upload($file, 'research_publications');
            $publication->attachments()->create([
                'path' => $filePath,
                'name' => $file->getClientOriginalName(),
                'ext' => $ext,
            ]);
        }
    }

    public function updateReInitiate(array $data, $researchId)
    {
        $featureName = Config::get('rms.research_feature_name');
        $feature = $this->featureService->findBy(['name' => $featureName])->first();

        $reInitializeData = [
            'feature_id' => $feature->id,
            'ref_table_id' => $researchId,
            'message' => $data['message'],
        ];

        $this->workflowService->reinitializeWorkflow($reInitializeData);
        return new Response(trans('rms::research_proposal.re_initiate_success'));

    }

    public function closeWorkflow($workflowMasterId)
    {
        $this->workflowService->closeWorkflow($workflowMasterId);
        return Response(trans('labels.research_closed'));
    }

    private function savePublicationAttachments($publicationId, $data)
    {

        $publication = $this->researchPublicationRepository->findOne($publicationId);
        foreach ($data['attachments'] as $file) {
            $ext = $file->getClientOriginalExtension();
            $filePath = $this->upload($file, 'research_publications');
            $publication->attachments()->create([
                'path' => $filePath,
                'name' => $file->getClientOriginalName(),
                'ext' => $ext,
            ]);
        }
    }



//    private function updatePublicationAttachments($publicationId, $attachments)
//    {
//        $publication = $this->researchPublicationRepository->findOne($publicationId);
//
//    }

    public function getResearchesForUser(User $user)
    {
        if ($this->userService->isDirectorGeneral()) {
            return $this->researchRepository->findAll();

        } else if ($this->userService->isResearchDivisionUser($user)) {
            return $this->researchRepository->findAll();

        } else {
            return $this->researchRepository->findBy(['submitted_by' => $user->id]);
        }
    }

    // Methods for triggering notifications
    public function generatePublicationNotification($notificationData, $event = null, $url): void
    {
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
        $dynamicValues['notificationData'] = [
            'ref_table_id' => $notificationData['ref_table_id'],
            'from_user_id' => Auth::user()->id,
            'message' => $notificationData['item_title'] . ' has been ' . $status . ' by ' . $activityBy,
            'is_read' => 0,
            'item_url' => $url,
            'item_title' => $notificationData['item_title']
        ];
        if (array_key_exists('designation_id', $notificationData)) $dynamicValues['notificationData']['designation_id'] = $notificationData['designation_id'];
        if (array_key_exists('department_id', $notificationData)) $dynamicValues['notificationData']['department_id'] = $notificationData['department_id'];
        if (array_key_exists('workflow_master_id', $notificationData)) $dynamicValues['notificationData']['workflow_master_id'] = $notificationData['workflow_master_id'];
        if (array_key_exists('to_users', $notificationData)) $dynamicValues['notificationData']['to_users'] = $notificationData['to_users'];
        $dynamicValues['event'] = $event;
    //    dd($dynamicValues);
        event(new NotificationGeneration(new NotificationInfo(NotificationType::RESEARCH_PROPOSAL_SUBMISSION, $dynamicValues)));
    }
}
