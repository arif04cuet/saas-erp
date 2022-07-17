<?php
namespace Modules\TMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\TMS\Entities\TrainingCourseResource;

class TrainingCourseResourceRepository extends AbstractBaseRepository
{
    protected $modelName = TrainingCourseResource::class;
}
