<?php


namespace Modules\HM\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\HM\Entities\CheckinTrainee;
use Modules\TMS\Entities\Training;

class CheckinTraineeRepository extends AbstractBaseRepository
{
    protected $modelName = CheckinTrainee::class;


    public function getCheckedInTrainees($trainingId)
    {
        return $this->getModel()->newQuery()
            ->whereNotNull('trainee_id')
            ->where('training_id', $trainingId)
            ->pluck('trainee_id');
    }

    public function getCheckedInIds($trainingId)
    {
        return $this->getModel()
            ->newQuery()
            ->where('training_id', $trainingId)
            ->pluck('checkin_id');
    }
}
