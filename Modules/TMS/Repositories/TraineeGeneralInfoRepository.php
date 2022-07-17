<?php
namespace Modules\TMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\TMS\Entities\RegisteredTraineeGeneralInfo;

class TraineeGeneralInfoRepository extends AbstractBaseRepository
{
    protected $modelName = RegisteredTraineeGeneralInfo::class;
}
