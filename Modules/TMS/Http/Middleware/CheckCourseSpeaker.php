<?php

namespace Modules\TMS\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\HRM\Entities\Employee;
use Modules\TMS\Traits\MenuAccessTrait;

class CheckCourseSpeaker
{
    use MenuAccessTrait;

    /**
     * @param Request $request
     * @param Closure $next
     * @param string $course
     * @param string $speaker
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $course, string $speaker)
    {
        $user = auth()->user();

        $this->isDirector($user);

        $this->isTrainingDivisionEmployee($user);

        if ($this->can) {
            return $next($request);
        }

        $course = $request->$course;

        if($course) {
            $administratorEmployees = $course->administrations->map(function ($admin) {
                return $admin->employee_id;
            })->flatten()
                ->toArray();

            if(in_array(optional($user->employee)->id, $administratorEmployees)) {
                return $next($request);
            }
        }

        $speaker = $request->$speaker;

        if($speaker) {

            $resource = $speaker->getResource();

            if($speaker->reference_entity == Employee::class && $speaker->reference_entity_id == optional($user->employee)->id) {

                return $next($request);
            }
        }

        abort(403);
    }
}
