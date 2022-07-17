<?php
namespace Modules\TMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\TMS\Entities\RegisteredTraineeEmergency;

class TraineeEmergencyContactRepository extends AbstractBaseRepository
{
    protected $modelName = RegisteredTraineeEmergency::class;
}
