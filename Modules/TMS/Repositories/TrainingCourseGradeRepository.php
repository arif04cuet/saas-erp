<?php


namespace Modules\TMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\TMS\Entities\TrainingCourseGrade;

class TrainingCourseGradeRepository extends AbstractBaseRepository
{
    protected $modelName = TrainingCourseGrade::class; // we are using the existing table

}
