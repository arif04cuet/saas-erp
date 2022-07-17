<?php
/**
 * Created by PhpStorm.
 * User: siaminflack
 * Date: 10/1/19
 * Time: 12:48 PM
 */

namespace Modules\TMS\Repositories;


use App\Repositories\AbstractBaseRepository;
use Modules\TMS\Entities\TrainingCourse;

class TrainingCourseRepository extends AbstractBaseRepository
{
    protected $modelName = TrainingCourse::class;
    public function getTrainingBytrainingId($id)
    {
        return TrainingCourse::where('training_id',$id)->get()->toarray();
    }
}