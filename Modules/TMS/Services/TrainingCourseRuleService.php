<?php
/**
 * Created by PhpStorm.
 * User: siaminflack
 * Date: 10/3/19
 * Time: 6:45 PM
 */

namespace Modules\TMS\Services;


use App\Traits\CrudTrait;
use Illuminate\Support\Facades\DB;
use Modules\TMS\Entities\TrainingCourse;
use Modules\TMS\Entities\TrainingCourseRuleGuideline;
use Modules\TMS\Repositories\TrainingCourseRuleRepository;

class TrainingCourseRuleService
{
    use CrudTrait;
    private $repository;

    /**
     * TrainingCourseRuleService constructor.
     * @param TrainingCourseRuleRepository $repository
     */
    public function __construct(TrainingCourseRuleRepository $repository)
    {
        $this->repository = $repository;
        $this->setActionRepository($repository);
    }

    public function updateRequest(TrainingCourse $course, array $data)
    {
        return DB::transaction(function () use ($course, $data) {
            $course->guidelines()->delete();

            $course->guidelines()->save(new TrainingCourseRuleGuideline([
                'type' => 'description',
                'content' => $data['description']
            ]));

            if (isset($data['specific_points'])) {
                $specificPoints = collect($data['specific_points']);

                $course->guidelines()->saveMany($specificPoints->map(function ($specificPoint) {
                    return new TrainingCourseRuleGuideline([
                        'type' => 'specific_point',
                        'content' => $specificPoint['content']
                    ]);
                }));
            }

            return $course->guidelines()->get();
        });
    }
}