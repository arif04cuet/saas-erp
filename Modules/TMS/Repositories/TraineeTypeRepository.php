<?php


namespace Modules\TMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\TMS\Entities\TraineeType;

class TraineeTypeRepository extends AbstractBaseRepository 
{
    protected $modelName = TraineeType::class;
}
