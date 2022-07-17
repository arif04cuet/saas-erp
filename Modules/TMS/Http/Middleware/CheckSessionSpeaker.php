<?php

namespace Modules\TMS\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\HRM\Entities\Employee;
use Modules\TMS\Traits\MenuAccessTrait;

class CheckSessionSpeaker
{
    use MenuAccessTrait;

    /**
     * @param Request $request
     * @param Closure $next
     * @param string $session
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $session)
    {
        $user = auth()->user();

        $this->isDirector($user);

        $this->isTrainingDivisionEmployee($user);

        if ($this->can) {
            return $next($request);
        }

        $session = $request->$session;


        $sessionSpeaker = $session->speaker->getResource();

        if ($sessionSpeaker) {
            if (
                (optional($session->speaker)->reference_entity == Employee::class)
                && (optional($session->speaker)->reference_entity_id == optional($user->employee)->id)
            ) {
               return $next($request);
            }
        }


        $administrations = optional($session->module->course->administrations);

        if ($administrations->count()) {

            $administrationsEmployees = $administrations->map(function ($admin) {
                return [$admin->employee_id];
            })->flatten()
                ->toArray();

            if(in_array(optional($user->employee)->id, $administrationsEmployees)) {
                return $next($request);
            }
        }

        abort(403);
    }
}
