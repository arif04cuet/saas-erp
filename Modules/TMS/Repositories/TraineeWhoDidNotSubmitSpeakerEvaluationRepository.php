<?php


namespace Modules\TMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\TMS\Entities\Trainee;
use Modules\TMS\Entities\TrainingCourse;
use Modules\TMS\Entities\TrainingCourseModuleBatchSessionSchedule;
use Modules\TMS\Entities\TrainingCourseModuleSession;

class TraineeWhoDidNotSubmitSpeakerEvaluationRepository extends AbstractBaseRepository
{
    protected $modelName = TrainingCourseModuleSession::class;

    public function getScheduledSessions(array $sessionIds)
    {
        return $this->getModel()
            ->newQuery()
            ->whereIn('id', $sessionIds)
            ->get();
    }

    public function getTraineesOfTraining($trainingId)
    {
        return Trainee::whereTrainingId($trainingId)->get();
    }

    public function getTrainingCourse($trainingCourseId)
    {
        return TrainingCourse::find($trainingCourseId);
    }

}
