<?php

namespace Modules\TMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\TMS\Entities\RegisteredTraineeEducation;

class TraineeEducationInfoRepository extends AbstractBaseRepository
{
    protected $modelName = RegisteredTraineeEducation::class;
}
