<?php
/**
 * Created by PhpStorm.
 * User: bs110
 * Date: 12/24/18
 * Time: 7:00 PM
 */

namespace Modules\TMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\TMS\Entities\Trainee;
use Modules\TMS\Entities\Training;


class TraineeRepository extends AbstractBaseRepository
{
    protected $modelName = Trainee::class;

    // Fn to get the number of trainees assigned for a particular training
    public function fetchAssignedTraineeNo($trainingId)
    {
        $traineeNo = Trainee::where('training_id', $trainingId)->count();

        return $traineeNo;
    }

    public function getTraineesByTraining($trainingId)
    {
        return $this->model->whereHas('training', function ($query) use ($trainingId) {
            $query->where('id', $trainingId);
        })->get();
    }
    public function getTraineesByTrainingTest($trainingId)
    {
        return $trainess = Trainee::where('training_id', $trainingId)
        ->where('status','!=',0)->get();
    }

    /**
     * @param string $mobileNumber
     * @param Training $training
     * @return mixed
     */
    public function getRegisteredTraineeOfTraining(string $mobileNumber, Training $training)
    {
        return $this->model
            ->newQuery()
            ->whereTrainingId($training->id)
            ->whereMobile($mobileNumber)
            ->get();
    }

}
