<?php
/**
 * Created by PhpStorm.
 * User: yousha
 * Date: 4/15/19
 * Time: 3:43 AM
 */

namespace Modules\RMS\Services;


use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Support\Facades\DB;
use Modules\RMS\Entities\ResearchDetailSubmissionAttachment;
use Modules\RMS\Repositories\ResearchDetailSubmissionRepository;

class ResearchProposalDetailReviewerAttachmentService
{
    use CrudTrait;
    use FileTrait;

    private $researchDetailSubmissionRepository;

    public function __construct(ResearchDetailSubmissionRepository $researchDetailSubmissionRepository)
    {
        $this->researchDetailSubmissionRepository = $researchDetailSubmissionRepository;
        $this->setActionRepository($this->researchDetailSubmissionRepository);
    }

    public function store($data)
    {
        return DB::transaction(function () use ($data) {

            $proposalDetailSubmission = $this->findOrFail($data['research_detail_submission_id']);

            foreach ($data['attachments'] as $attachment)
            {
                $path = $this->upload($attachment, 'research-detail-submissions');

                $file = new ResearchDetailSubmissionAttachment([
                    'attachments' => $path,
                    'research_detail_submission_id' => $data['research_detail_submission_id'],
                    'file_name' => $attachment->getClientOriginalName()
                ]);

                $proposalDetailSubmission->researchDetailSubmissionAttachment()->save($file);
            }

            return $proposalDetailSubmission;
        });
    }
}