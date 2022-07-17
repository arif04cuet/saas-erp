<?php


namespace Modules\TMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\TMS\Entities\TrainingCourseAdministration;

class TrainingAdministrationRepository extends AbstractBaseRepository
{
    protected $modelName = TrainingCourseAdministration::class; // we are using the existing table


}
