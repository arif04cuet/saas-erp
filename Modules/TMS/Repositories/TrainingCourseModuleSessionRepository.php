<?php


namespace Modules\TMS\Repositories;


use App\Repositories\AbstractBaseRepository;
use Modules\TMS\Entities\TrainingCourseModule;
use Modules\TMS\Entities\TrainingCourseModuleSession;

class TrainingCourseModuleSessionRepository extends AbstractBaseRepository
{
    protected $modelName = TrainingCourseModuleSession::class;

    public function getSessionbyTrainingCourseModuleId($id)
    {
        return TrainingCourseModuleSession::where('training_course_module_id',$id)->get()->toarray();
    }
}
