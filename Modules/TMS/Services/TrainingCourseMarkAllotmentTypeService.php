<?php


namespace Modules\TMS\Services;


use App\Traits\CrudTrait;
use Modules\TMS\Entities\TrainingCourse;
use Modules\TMS\Repositories\TrainingCourseMarkAllotmentTypeRepository;

class TrainingCourseMarkAllotmentTypeService
{
    use CrudTrait;

    /**
     * @var TrainingCourseMarkAllotmentTypeRepository
     */
    private $repository;

    /**
     * TrainingCourseMarkAllotmentTypeService constructor.
     * @param TrainingCourseMarkAllotmentTypeRepository $trainingCourseMarkAllotmentTypeRepository
     */
    public function __construct(
        TrainingCourseMarkAllotmentTypeRepository $trainingCourseMarkAllotmentTypeRepository
    )
    {
        $this->repository = $trainingCourseMarkAllotmentTypeRepository;
        $this->setActionRepository($this->repository);
    }

    public function leftovers(TrainingCourse $course)
    {
        $usedTypes = $course->markAllotments()->get()
            ->map(function ($type) {
                return [$type->type->id];
            })->flatten()
            ->toArray();

        return $this->repository->findAll()
            ->filter(function ($type) use ($usedTypes) {
                return !in_array($type->id, $usedTypes);
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
