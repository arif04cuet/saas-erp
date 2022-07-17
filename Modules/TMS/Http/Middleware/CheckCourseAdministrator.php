<?php

namespace Modules\TMS\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Modules\TMS\Entities\Training;
use Modules\TMS\Entities\TrainingCourse;

class CheckCourseAdministrator
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $passed = false;
        $course = $this->getCourseFromRequest($request);
        $training = $course->training;
        $employee = optional($request->user())->employee;
        if (is_null($employee)) {
            $this->redirectToCourse($course, 'Employee Information Not Found For You !');
        }

        $this->fixAdminData($training, $course);

        foreach ($training->administrations as $administration) {
            if ($administration->employee_id == $employee->id) {
                $passed = true;
            }
        }

        if (!$passed) {
            return $this->redirectToCourse($course,
                trans('tms::training_course.flash_messages.course_administrator_check_error'));
        }
        return $next($request);
    }

    //-------------------------- Private Methods -----------------------------------------------------------
    private function redirectToCourse(TrainingCourse $course, $flashMessage)
    {
        Session::flash('error', $flashMessage);
        $training = $course->training;
        return redirect()->route('trainings.courses.show', [$training, $course]);
    }

    private function getCourseFromRequest(Request $request)
    {
        return $request->route()->parameter('course');
    }

    /**
     * There are several scenarios here:
     * if training has no admin, but course has admin, we need to update the rows with training_id, so training can get
     * the admins [we are doing this to sync both old flow and new flow ]
     * if - training and course both has no admins, then redirect with the message that says, 'Course Admin Not Defined'
     * @param $training
     * @param $course
     * @return RedirectResponse
     */
    private function fixAdminData(Training $training, TrainingCourse $course)
    {
        if (!$training->administrations->count()) {
            if ($course->administrations->count()) {
                $course->administrations()->update(['training_id' => $training->id]);
            } else {
                return $this->redirectToCourse($course,
                    trans('tms::training_course.flash_messages.course_administrator_not_found'));
            }
        }
    }
}
