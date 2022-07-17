<?php
namespace Modules\TMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\TMS\Entities\RegisteredTraineeServiceInfo;

class TraineeServiceInfoRepository extends AbstractBaseRepository
{
    protected $modelName = RegisteredTraineeServiceInfo::class;
}
