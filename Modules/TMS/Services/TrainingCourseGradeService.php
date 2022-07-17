<?php

namespace Modules\TMS\Services;

use App\Traits\CrudTrait;
use Illuminate\Support\Facades\DB;
use Modules\TMS\Entities\Training;
use Modules\TMS\Entities\TrainingCourse;
use Modules\TMS\Entities\TrainingCourseGrade;
use Modules\TMS\Repositories\TrainingCourseGradeRepository;

class TrainingCourseGradeService
{

    use CrudTrait;

    /**
     * @var TrainingCourseGradeRepository
     */
    private $repository;

    /**
     * TrainingCourseAdministrationService constructor.
     * @param TrainingCourseGradeRepository $repository
     */
    public function __construct(TrainingCourseGradeRepository $repository)
    {
        $this->repository = $repository;
        $this->setActionRepository($repository);
    }

    public function update(TrainingCourse $course, $data)
    {
        return DB::transaction(function () use ($data, $course) {
            $delete = $course->trainingCourseGrade()->delete();
            if (!empty($data)) {
                // dd($data);
                return $course->trainingCourseGrade()->createMany($data);
            }
            return $delete;
        });
    }

    public function formattedDropdown()
    {
         return $this->repository->findAll()
            ->mapWithKeys(function ($type) {
                return [$type->id => trans('tms::mark_allotment_type.' . $type->title)];
            });
    }

}

