<?php

namespace Modules\TMS\Http\Middleware;

use App\Constants\DepartmentShortName;
use Closure;
use Illuminate\Http\Request;
use Modules\HRM\Entities\Employee;
use Modules\TMS\Entities\TrainingCourseAdministration;
use Modules\TMS\Entities\TrainingCourseResource;
use Modules\TMS\Traits\MenuAccessTrait;

class CanAccessTMS
{
    use MenuAccessTrait;

    private $can = false;

    private $directorRoles = [
        'ROLE_DIRECTOR_GENERAL',
        'ROLE_DIRECTOR_ADMIN',
        'ROLE_DIRECTOR_TRAINING',
    ];

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        
        $user = auth()->user();

        $this->isDirector($user);
        $this->isTrainingDivisionEmployee($user);
        $this->isTrainingCourseAdministrator($user);
        $this->isTrainingCourseResource($user);
        if(!$this->can) {
            abort(403);
        }

        return $next($request);
    }


}
