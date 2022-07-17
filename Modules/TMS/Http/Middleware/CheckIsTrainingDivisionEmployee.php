<?php

namespace Modules\TMS\Http\Middleware;

use App\Constants\DepartmentShortName;
use Closure;
use Illuminate\Http\Request;

class CheckIsTrainingDivisionEmployee
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
        $division = optional($user->employee)->employeeDepartment;

        if($division) {
            if($division->department_code == DepartmentShortName::TRAINING) {
                return $next($request);
            }
        }

        abort(403);
    }
}
