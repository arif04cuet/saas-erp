<?php
/**
 * Created by PhpStorm.
 * User: siaminflack
 * Date: 10/3/19
 * Time: 5:07 PM
 */

namespace Modules\TMS\Services;


use App\Traits\CrudTrait;
use Illuminate\Support\Facades\DB;
use Modules\TMS\Entities\TrainingCourse;
use Modules\TMS\Entities\TrainingCourseMethodStrategy;
use Modules\TMS\Repositories\TrainingCourseMethodRepository;

class TrainingCourseMethodService
{
    use CrudTrait;
    private $repository;

    /**
     * TrainingCourseMethodService constructor.
     * @param TrainingCourseMethodRepository $repository
     */
    public function __construct(TrainingCourseMethodRepository $repository)
    {
        $this->repository = $repository;
        $this->setActionRepository($repository);
    }

    public function updateRequest(TrainingCourse $course, array $data)
    {
        return DB::transaction(function () use ($course, $data) {
            $course->methods()->delete();

            if (isset($data['methods_and_strategies'])) {
                $methodsAndStrategies = collect($data['methods_and_strategies']);

                $course->methods()->saveMany($methodsAndStrategies->map(function ($methodAndStrategy) {
                    return new TrainingCourseMethodStrategy([
                        'title' => $methodAndStrategy['title'],
                        'description' => $methodAndStrategy['description'],
                    ]);
                }));
            }

            return $course->methods()->get();
        });
    }
}