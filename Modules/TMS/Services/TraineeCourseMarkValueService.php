<?php
/**
 * Created by PhpStorm.
 * User: siaminflack
 * Date: 10/21/19
 * Time: 5:07 PM
 */

namespace Modules\TMS\Services;


use App\Traits\CrudTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\TMS\Entities\TrainingCourse;
use Modules\TMS\Repositories\TraineeCourseMarkValueRepository;

class TraineeCourseMarkValueService
{
    use CrudTrait;
    private $repository;

    /**
     * TrainingCourseMarkValueService constructor.
     * @param TraineeCourseMarkValueRepository $repository
     */
    public function __construct(TraineeCourseMarkValueRepository $repository)
    {
        $this->repository = $repository;
        $this->setActionRepository($repository);
    }

    public function updateRequest(TrainingCourse $course, array $data)
    {
        try {
            DB::beginTransaction();

            list('trainee_id' => $traineeId, 'marks' => $marks) = $data;

            foreach ($marks as $mark) {
                list('mark_allotment_type_id' => $markAllotmentTypeId, 'value' => $value) = $mark;

                $traineeCourseMarkValue = $this->repository->getModel()->updateOrCreate(
                    [
                        'trainee_id' => $traineeId,
                        'training_course_id' => $course->id,
                        'training_course_mark_allotment_type_id' => $markAllotmentTypeId
                    ],
                    [
                        'value' => $value
                    ]
                );

                Log::debug("$traineeCourseMarkValue created or updated successfully");
            }

            DB::commit();

            return true;
        } catch (\Exception $exception) {
            DB::rollBack();

            Log::error(get_class($this) . " " . $exception->getMessage());

            return false;
        }
    }
}
