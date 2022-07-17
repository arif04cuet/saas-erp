<?php
/**
 * Created by PhpStorm.
 * User: yousha
 * Date: 4/15/19
 * Time: 9:15 AM
 */

namespace Modules\PMS\Services;


use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Support\Facades\DB;
use Modules\PMS\Entities\ProjectDetailProposalAttachment;
use Modules\PMS\Repositories\ProjectDetailProposalRepository;

class ProjectProposalDetailReviewerAttachmentService
{
    use CrudTrait;
    use FileTrait;

    private $projectDetailProposalRepository;

    public function __construct(ProjectDetailProposalRepository $projectDetailProposalRepository)
    {
        $this->projectDetailProposalRepository = $projectDetailProposalRepository;
        $this->setActionRepository($this->projectDetailProposalRepository);
    }

    public function store($data = [])
    {
        return DB::transaction(function () use ($data) {

            $detailProposalSubmission = $this->findOrFail($data['project_detail_submission_id']);

            foreach ($data['attachments'] as $attachment)
            {
                $path = $this->upload($attachment, 'project-submissions');

                $file = new ProjectDetailProposalAttachment([
                    'attachments' => $path,
                    'project_request_id' => $data['project_detail_submission_id'],
                    'file_name' => $attachment->getClientOriginalName()
                ]);

                $detailProposalSubmission->projectDetailProposalFiles()->save($file);
            }

            return $detailProposalSubmission;
        });
    }
}