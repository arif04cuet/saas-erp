<?php

namespace Modules\TMS\Services;

use App\Traits\CrudTrait;
use Modules\TMS\Entities\TrainingCourse;
use Illuminate\Support\Facades\DB;
use Modules\TMS\Repositories\TrainingCoursePaymentRepository;
use Modules\TMS\Entities\TrainingCoursePayment;

class TrainingCoursePaymentService
{

    use CrudTrait;
    /**
     * @var TrainingCoursePaymentRepository
     */
    private $trainingCoursePaymentRepository;

    public function __construct(TrainingCoursePaymentRepository $trainingCoursePaymentRepository)
    {
        /** @var TrainingCoursePaymentRepository $trainingCoursePaymentRepository */
        $this->trainingCoursePaymentRepository = $trainingCoursePaymentRepository;
        $this->setActionRepository($trainingCoursePaymentRepository);
    }

    public function storeTrainingCoursePaymentInfo(TrainingCourse $course, array $data)
    {
        return DB::transaction(function () use ($course, $data){
            $trainingCoursePaymentInfo = new TrainingCoursePayment($data);
            return $course->trainingCoursePayment()->save($trainingCoursePaymentInfo);
        });
    }

    public function updateTrainingCoursePaymentInfo(TrainingCourse $course, array $data)
    {
        return DB::transaction(function () use ($course, $data) {
            $course->trainingCoursePayment()->delete();

            if (isset($data['payment_type'])) {
                $course->trainingCoursePayment()->save(new TrainingCoursePayment($data));
            }
            return $course->trainingCoursePayment()->get();
        });
    }

}

