<?php

namespace Modules\TMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\TMS\Entities\RegisteredTraineeHealthExam;

class TraineeHealthReportRepository extends AbstractBaseRepository
{
    protected $modelName = RegisteredTraineeHealthExam::class;
}
