<?php


namespace Modules\Accounts\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\Accounts\Entities\Journal;

class JournalRepository extends AbstractBaseRepository
{
    protected $modelName = Journal::class;

    public function getDepartmentJournals($departmentId)
    {
        return $this->model->newQuery()->whereDepartmentId($departmentId)->get();
    }
}
