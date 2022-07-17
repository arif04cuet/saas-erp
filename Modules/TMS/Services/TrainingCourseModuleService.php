<?php


namespace Modules\TMS\Services;


use App\Traits\CrudTrait;
use Illuminate\Support\Facades\DB;
use Modules\TMS\Entities\TrainingCourse;
use Modules\TMS\Repositories\TrainingCourseModuleRepository;

class TrainingCourseModuleService
{
    use CrudTrait;

    /**
     * @var $repository
     */
    private $repository;

    public function __construct(
        TrainingCourseModuleRepository $trainingCourseModuleRepository
    )
    {
        $this->repository = $trainingCourseModuleRepository;
        $this->setActionRepository($this->repository);
    }

    public function update(TrainingCourse $course, $data = [])
    {
        return DB::transaction(function () use ($course, $data) {

            $moduleIdsShouldBeUpdated = $this->getModuleIdsToUpdate($data ?: []);

            $deletes = $this->getModulesToDelete($course, $moduleIdsShouldBeUpdated)
                ->each(function ($delete) {
                    $delete->delete();
                });

            if (!empty($data)) {
                $updateOrSaves = collect($data)->each(function ($module) use ($course) {
                    $course->modules()->updateOrCreate(['id' => $module['id']], $module);
                });

                return $updateOrSaves;
            }

            return $deletes;

        });
    }

    /**
     * @param TrainingCourse $course
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function modules(TrainingCourse $course)
    {
        $modules = $this->repository->findBy([
            'training_course_id' => $course->id
        ]);

        return $modules;

    }

    /**
     * @param array $data
     * @return array
     */
    private function getModuleIdsToUpdate(array $data = []): array
    {
        return array_filter(array_column($data, 'id'));
    }

    /**
     * @param $course
     * @param $moduleIdsShouldBeUpdated
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function getModulesToDelete($course, $moduleIdsShouldBeUpdated)
    {
        return $this->repository->findBy([
            'training_course_id' => $course->id
        ])->filter(function ($module) use ($moduleIdsShouldBeUpdated) {
            return !in_array($module->id, $moduleIdsShouldBeUpdated);
        });
    }
}
