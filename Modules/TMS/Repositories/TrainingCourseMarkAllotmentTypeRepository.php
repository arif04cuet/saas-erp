<?php


namespace Modules\TMS\Repositories;


use App\Repositories\AbstractBaseRepository;
use Modules\TMS\Entities\TrainingCourseMarkAllotment;
use Modules\TMS\Entities\TrainingCourseMarkAllotmentType;

class TrainingCourseMarkAllotmentTypeRepository extends AbstractBaseRepository
{
    protected $modelName = TrainingCourseMarkAllotmentType::class;
}
