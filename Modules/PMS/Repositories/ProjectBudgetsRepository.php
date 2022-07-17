<?php


namespace Modules\PMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\PMS\Entities\ProjectBudgets;

class ProjectBudgetsRepository extends AbstractBaseRepository
{
    protected $modelName = ProjectBudgets::class;
}
