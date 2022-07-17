<?php

namespace Modules\TMS\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\TMS\Repositories\CourseEvaluationSubmissionRepository;

class CheckCourseIsEvaluated
{
    private $course_id;
    private $trainee_id;
    private $courseEvaluationSubmissionRepository;

    public function __construct(
        CourseEvaluationSubmissionRepository $courseEvaluationSubmissionRepository
    )
    {
        $this->courseEvaluationSubmissionRepository = $courseEvaluationSubmissionRepository;
    }

    /**
     * @param Request $request
     * @param Closure $next
     * @param string $course
     * @param string $trainee
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function handle(
        Request $request,
        Closure $next,
        string $course,
        string $trainee
    )
    {
        $this->course_id = optional($request->$course)->id;
        $this->trainee_id = optional($request->$trainee)->id;

        return $this->checkIfCourseIsEvaluated() ? $next($request) : redirect()->route('courses.public.index');
    }

    private function checkIfCourseIsEvaluated()
    {
        $submission = $this->courseEvaluationSubmissionRepository->findBy([
            'training_course_id' => $this->course_id,
            'trainee_id' => $this->trainee_id
        ])->first();

        return $submission ? false : true;
    }
}
