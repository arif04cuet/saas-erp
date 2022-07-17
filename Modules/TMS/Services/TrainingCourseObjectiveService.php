<?php
/**
 * Created by PhpStorm.
 * User: siaminflack
 * Date: 10/3/19
 * Time: 3:13 PM
 */

namespace Modules\TMS\Services;


use App\Traits\CrudTrait;
use Illuminate\Support\Facades\DB;
use Modules\TMS\Entities\TrainingCourse;
use Modules\TMS\Entities\TrainingCourseObjective;
use Modules\TMS\Repositories\TrainingCourseObjectiveRepository;

class TrainingCourseObjectiveService
{
    use CrudTrait;
    private $repository;

    /**
     * TrainingCourseObjectiveService constructor.
     * @param TrainingCourseObjectiveRepository $repository
     */
    public function __construct(TrainingCourseObjectiveRepository $repository)
    {
        $this->repository = $repository;
        $this->setActionRepository($repository);
    }

    public function updateRequest(TrainingCourse $course, array $data)
    {
        return DB::transaction(function () use ($course, $data) {
            $course->objectives()->delete();

            $course->objectives()->save(new TrainingCourseObjective([
                'type' => 'description',
                'content' => $data['description']
            ]));

            if (isset($data['specific_points'])) {
                $specificPoints = collect($data['specific_points']);

                $course->objectives()->saveMany(
                    $specificPoints->map(function ($specificPoint) {
                        return new TrainingCourseObjective([
                            'type' => 'specific_point',
                            'content' => $specificPoint['content']
                        ]);
                    }));
            }

            return $course->objectives()->get();
        });

    }
}