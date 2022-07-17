<?php

namespace Modules\TMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\TMS\Entities\TrainingCourseGuest;

class TrainingCourseGuestRepository extends AbstractBaseRepository
{
    protected $modelName = TrainingCourseGuest::class;
}
