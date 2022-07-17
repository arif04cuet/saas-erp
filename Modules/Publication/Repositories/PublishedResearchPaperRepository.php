<?php


namespace Modules\Publication\Repositories;

use Illuminate\Support\Facades\Auth;
use App\Repositories\AbstractBaseRepository;
use Modules\Publication\Entities\PublishedResearchPaper;

class PublishedResearchPaperRepository extends AbstractBaseRepository
{

    protected $modelName = PublishedResearchPaper::class;

    public function getAll()
    {
        if (auth()->user()->hasAnyRole('ROLE_PUBLICATION_COMMITTEE') || auth()->user()->hasAnyRole("ROLE_PUBLICATION_SECTION_OFFICER")) {
            return $this->model->get();
        }

        return $this->model->whereHas('publicationRequest', function ($query) {
            $query->whereHas('research', function ($query) {
                $query->where('submitted_by', Auth::user()->id);
            });
        })->orWhereHas('publicationPress', function ($query) {
            $query->where('press_user_id', Auth::user()->employee->id);
        })->get();
    }
    public function getAllCompleted()
    {
        return $this->model->where('status', 'completed')->get();
    }
}
