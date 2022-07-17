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
use Modules\PMS\Repositories\ProjectActivityRepository;
use Modules\PMS\Repositories\ProjectProposalRepository;
use Illuminate\Support\Facades\Session;

class ProjectActivityDetailsService
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
     * @param ProjectActivityRepository $projectActivityRepository
     */

    public function __construct(
        ProjectActivityRepository $projectActivityRepository
    ) {
        $this->projectProposalRepository = $projectActivityRepository;
        $this->setActionRepository($projectActivityRepository);
    }

    public function store(array $data, $projectId)
    {
        $data['project_id'] = $projectId;
        return $this->save($data);;
    }

    public function updateActivity($data, $id)
    {
        $activity = $this->findOne($id);
        return $activity->update($data);
    }
}
