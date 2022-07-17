<?php
/**
 * Created by PhpStorm.
 * User: tuhin
 * Date: 10/18/18
 * Time: 5:18 PM
 */

namespace Modules\PMS\Services;

use App\Constants\NotificationType;
use App\Entities\User;
use App\Entities\workflow\WorkflowMaster;
use App\Events\NotificationGeneration;
use App\Models\NotificationInfo;
use App\Services\Notification\ReviewUrlGenerator;
use App\Services\Remark\RemarkService;
use App\Services\Sharing\ShareConversationService;
use App\Services\UserService;
use App\Services\workflow\DashboardWorkflowService;
use App\Services\workflow\FeatureService;
use App\Services\workflow\WorkFlowConversationService;
use App\Services\workflow\WorkflowMasterService;
use App\Services\workflow\WorkflowService;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Chumper\Zipper\Facades\Zipper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Modules\HRM\Services\EmployeeService;
use Modules\PMS\Entities\ProjectProposal;
use Modules\PMS\Entities\ProjectProposalFile;
use Modules\PMS\Repositories\ProjectProposalRepository;
use Illuminate\Support\Facades\Session;

class ProjectProposalService
{
    use CrudTrait;
    use FileTrait;
    private $projectProposalRepository;
    private $featureService;
    private $workflowService;
    private $userService;
    private $dashboardService;
    private $employeeService;
    private $shareConversationService;
    private $remarkService;
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

    /**
     * ProjectRequestService constructor.
     * @param ProjectDetailProposalRepository $projectProposalRepository
     * @param FeatureService $featureService
     * @param WorkflowService $workflowService
     * @param UserService $userService
     * @param ReviewUrlGenerator $reviewUrlGenerator
     */

    public function __construct(
        ProjectProposalRepository $projectProposalRepository,
        FeatureService $featureService,
        WorkflowService $workflowService,
        UserService $userService,
        ReviewUrlGenerator $reviewUrlGenerator,
        EmployeeService $employeeService,
        ShareConversationService $shareConversationService,
        RemarkService $remarkService,
        WorkflowMasterService $workflowMasterService
    )
    {
        $this->projectProposalRepository = $projectProposalRepository;
        $this->workflowService = $workflowService;
        $this->featureService = $featureService;
        $this->userService = $userService;
        $this->employeeService = $employeeService;
        $this->shareConversationService = $shareConversationService;
        $this->remarkService = $remarkService;
        $this->workflowMasterService = $workflowMasterService;

        $this->setActionRepository($projectProposalRepository);
        $this->reviewUrlGenerator = $reviewUrlGenerator;
    }

    /**
     * @param User $user
     * @return \App\Repositories\Contracts\Collection|\Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function getProposalsForUser(User $user)
    {
        return $this->projectProposalRepository->findAll()
            ->filter(function($projectProposal) use ($user){

                return $user->employee->designation->short_name == "DG"
                    || ($user->employee->employeeDepartment->department_code == "PMS"
                        && $user->employee->designation->short_name != "FM")
                    || ($projectProposal->auth_user_id == $user->id);
            });
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            $data['status'] = 'PENDING';

            $proposalSubmission = $this->save($data);

            foreach ($data['attachments'] as $file) {
                $fileName = $file->getClientOriginalName();
                $path = $this->upload($file, 'project-submissions');

                $file = new ProjectProposalFile([
                    'proposal_id' => $proposalSubmission->id,
                    'attachments' => $path,
                    'file_name' => $fileName
                ]);

                $proposalSubmission->projectProposalFiles()->save($file);
            }

            // Initiating Workflow
            $divisionalDirector = $this->employeeService->getDivisionalDirectorByDepartmentId(Auth::user()->employee->department_id);
            if(is_null($divisionalDirector)) {
                Session::flash('success', trans('hrm::project_proposal.divisional_director_error'));
                $divisionalDirectorId = null;
            }
            else {
                $divisionalDirectorId = $divisionalDirector->designation_id;
            }

            $featureName = config('constants.project_proposal_feature_name');
            $feature = $this->featureService->findBy(['name' => $featureName])->first();
            $workflowData = [
                'feature_id' => $feature->id,
                'rule_master_id' => $feature->workflowRuleMaster->id,
                'ref_table_id' => $proposalSubmission->id,
                'message' => $data['message'],
                'designationTo' => ['1'=> $divisionalDirectorId] ,
                'department_id' => $divisionalDirector->department_id
            ];
       //     if($this->userService->isProjectDivisionUser(Auth::user()) || is_null($divisionalDirectorId)) {
                $workflowData['skipped'] = [1];
       //     }

            $this->workflowService->createWorkflow($workflowData);
            // Workflow initiate done

            //Generating Notification
            $this->generatePMSNotification(
                [
                    'ref_table_id' => $proposalSubmission->id,
                    'status' => 'SUBMITTED',
                    'item_title' => $proposalSubmission->title,
                    'designation_id' => $workflowData['designationTo']['1'],
                    'department_id' => $workflowData['department_id']
                ],
                'project_proposal_submission',
                $this->reviewUrlGenerator->getReviewUrl(
                    'project-proposal-submitted-review',
                    $feature,
                    $proposalSubmission
                )
            );
            // Notification generation done

            return $proposalSubmission;
        });
    }

    public function updateProposal(ProjectProposal $proposal, $data = [])
    {
        foreach ($data['attachments'] as $file) {
            $fileName = $file->getClientOriginalName();
            $path = $this->upload($file, 'project-submissions');

            $file = new ProjectProposalFile([
                'proposal_id' => $proposal->id,
                'attachments' => $path,
                'file_name' => $fileName
            ]);

            $proposal->projectProposalFiles()->save($file);
        }

        return $this->update($proposal, $data);
    }

    public function getProposalById($id)
    {
        $proposal = $this->findOne($id);
        if (is_null($proposal)) {
            abort(404);
        } else {
            return $proposal;
        }
    }

    public function getZipFilePath($proposalId)
    {
        $researchProposal = $this->findOne($proposalId);

        $filePaths = $researchProposal->projectProposalFiles->map(function ($attachment) {
            return Storage::disk('internal')->path($attachment->attachments);
        })->toArray();

        $fileName = time() . '.zip';

        $zipFilePath = Storage::disk('internal')->getAdapter()->getPathPrefix() . $fileName;

        Zipper::make($zipFilePath)->add($filePaths)->close();

        return $zipFilePath;
    }

    public function getProjectProposalByStatus()
    {
        $projectProposal = new ProjectProposal();
        return [
            $projectProposal->where('status', '=', 'pending')->count(),
            $projectProposal->where('status', '=', 'in progress')->count(),
            $projectProposal->where('status', '=', 'reviewed')->count()
        ];
    }

    public function getProjectProposalBySubmissionDate()
    {
        return ProjectProposal::orderBy('id', 'DESC')
            ->limit(5)
            ->get()
            ->filter(function($projectProposal) {

                return auth()->user()->employee->designation->short_name == "DG"
                    || (auth()->user()->employee->employeeDepartment->department_code == "PMS"
                        && auth()->user()->employee->designation->short_name != "FM")
                    || ($projectProposal->auth_user_id == auth()->user()->id);
            });

    }

    // Methods for triggering notifications
    public function generatePMSNotification($notificationData, $event, $url): void
    {
        $projectProposal = $this->findOne($notificationData['ref_table_id']);
        $activityBy = (array_key_exists('activity_by', $notificationData)) ? $notificationData['activity_by'] : $this->userService->getDesignation(Auth::user()->username);
        $feature = 'project_proposal_feature_name';

        $dynamicValues['notificationData'] = [
            'ref_table_id' => $notificationData['ref_table_id'],
            'from_user_id' => Auth::user()->id,
            'message' => $projectProposal->title . ' has been ' . $notificationData['status'] . ' by ' . $activityBy,
            'is_read' => 0,
            'item_url' => $url,
            'item_title' => $notificationData['item_title'],
            'feature' => $feature
        ];
        if(array_key_exists('designation_id', $notificationData)) $dynamicValues['notificationData']['designation_id'] = $notificationData['designation_id'];
        if(array_key_exists('department_id', $notificationData)) $dynamicValues['notificationData']['department_id'] = $notificationData['department_id'];
        if(array_key_exists('workflow_master_id', $notificationData)) $dynamicValues['notificationData']['workflow_master_id'] = $notificationData['workflow_master_id'];
        $dynamicValues['event'] = $event;
        event(new NotificationGeneration(new NotificationInfo(NotificationType::PROJECT_PROPOSAL_SUBMISSION, $dynamicValues)));
    }
}
