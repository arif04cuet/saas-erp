<?php


namespace Modules\Publication\Repositories;

use App\Repositories\AbstractBaseRepository;
use Illuminate\Support\Facades\Auth;
use Modules\Publication\Entities\PublicationRequest;

class PublicationRequestRepository extends AbstractBaseRepository
{

    protected $modelName = PublicationRequest::class;

    public function getRequestsByUser()
    {
        return $this->model->whereHas('research', function ($query) {
            $query->where('submitted_by', Auth::id());
        })->get();
    }
}
