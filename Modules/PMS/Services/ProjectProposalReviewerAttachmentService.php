<?php
/**
 * Created by PhpStorm.
 * User: yousha
 * Date: 4/2/19
 * Time: 1:27 PM
 */

namespace Modules\PMS\Services;


use App\Services\UserService;
use App\Services\workflow\FeatureService;
use App\Services\workflow\WorkflowService;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Support\Facades\DB;
use Modules\PMS\Entities\ProjectProposalFile;
use Modules\PMS\Repositories\ProjectProposalRepository;

class ProjectProposalReviewerAttachmentService
{
    use CrudTrait;
    use FileTrait;

    private $projectProposalSubmissionRepository;
    private $workflowService;
    private $featureService;
    private $userService;

    public function __construct(ProjectProposalRepository $projectProposalRepository, FeatureService $featureService, WorkflowService $workflowService, UserService $userService)
    {
        $this->projectProposalRepository = $projectProposalRepository;
        $this->featureService = $featureService;
        $this->workflowService = $workflowService;
        $this->userService = $userService;

        $this->setActionRepository($projectProposalRepository);
    }

    public function store($data = [])
    {
        return DB::transaction(function() use ($data) {

            $proposalSubmission = $this->findOrFail($data['project_proposal_submission_id']);

            foreach ($data['attachments'] as $attachment)
            {
                $path = $this->upload($attachment, 'project-submissions');

                $file = new ProjectProposalFile([
                    'attachments' => $path,
                    'proposal_id' => $data['project_proposal_submission_id'],
                    'file_name' => $attachment->getClientOriginalName()
                ]);

                $proposalSubmission->projectProposalFiles()->save($file);
            }

            return $proposalSubmission;
        });
    }

}