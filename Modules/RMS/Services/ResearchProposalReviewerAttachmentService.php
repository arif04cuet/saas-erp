<?php
/**
 * Created by PhpStorm.
 * User: yousha
 * Date: 4/1/19
 * Time: 4:56 PM
 */

namespace Modules\RMS\Services;


use App\Services\UserService;
use App\Services\workflow\FeatureService;
use App\Services\workflow\WorkflowService;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use function foo\func;
use Illuminate\Support\Facades\DB;
use Modules\RMS\Entities\ResearchProposalSubmissionAttachment;
use Modules\RMS\Repositories\ResearchProposalSubmissionRepository;

class ResearchProposalReviewerAttachmentService
{
    use CrudTrait;
    use FileTrait;

    private $researchProposalSubmissionRepository;
    private $workflowService;
    private $featureService;
    private $userService;

    public function __construct(ResearchProposalSubmissionRepository $researchProposalSubmissionRepository, WorkflowService $workflowService, FeatureService $featureService,
                                UserService $userService)
    {
        $this->researchProposalSubmissionRepository = $researchProposalSubmissionRepository;
        $this->workflowService = $workflowService;
        $this->featureService = $featureService;
        $this->userService = $userService;
        $this->setActionRepository($this->researchProposalSubmissionRepository);
    }

    public function store($data = [])
    {
        return DB::transaction(function() use ($data) {

            $proposalSubmission = $this->findOrFail($data['research_proposal_submission_id']);

            foreach ($data['attachments'] as $attachment)
            {
                $path = $this->upload($attachment, 'research-submissions');

                $file = new ResearchProposalSubmissionAttachment([
                    'attachments' => $path,
                    'submissions_id' => $data['research_proposal_submission_id'],
                    'file_name' => $attachment->getClientOriginalName()
                ]);

                $proposalSubmission->researchProposalSubmissionAttachments()->save($file);

            }

            return $proposalSubmission;
        });
    }
}