<?php


namespace Modules\Publication\Repositories;

use Modules\Publication\Entities\ResearchPaperFreeRequest;
use App\Repositories\AbstractBaseRepository;

class ResearchPaperFreeRequestRepository extends AbstractBaseRepository
{
    protected $modelName = ResearchPaperFreeRequest::class;

    public function getRequestedPaper()
    {
        return $this->model->whereNotNull('requester_id')->get();
    }

    public function getDistributedPaper()
    {
        return $this->model->whereNull('requester_id')->get();
    }

    public function getRequestedPublicationByEmployee($id)
    {
        return $this->model->where('id', $id)->where('status', 'pending')->first();
    }
}
