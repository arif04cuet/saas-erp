<?php


namespace Modules\TMS\Repositories;


use App\Repositories\AbstractBaseRepository;
use Modules\TMS\Entities\TrainingCourseBatch;

class TrainingCourseBatchRepository extends AbstractBaseRepository
{
    protected $modelName = TrainingCourseBatch::class;
    public function getBatchsByTrainingCourseId($id)
    {
        return TrainingCourseBatch::where('training_course_id',$id)->get()->toarray();
    }
}
