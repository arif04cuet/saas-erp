<?php

namespace Modules\TMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\TMS\Entities\TrainingOrganization;

class TrainingOrganizationRepository extends AbstractBaseRepository
{
    protected $modelName = TrainingOrganization::class;
}
