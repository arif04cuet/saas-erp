<?php


namespace Modules\TMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\TMS\Entities\TrainingCoursePayment;

class TrainingCoursePaymentRepository extends AbstractBaseRepository 
{
    protected $modelName = TrainingCoursePayment::class;
}
