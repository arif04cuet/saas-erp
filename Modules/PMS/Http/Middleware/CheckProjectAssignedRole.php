<?php

namespace Modules\PMS\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Modules\PMS\Entities\Project;

class CheckProjectAssignedRole
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
        $project = $this->getProjectFromRequest($request);
        $projectAssignedRole = $project->projectAssignedRole;
        if (is_null($projectAssignedRole)) {
            return $this->redirectToProjectIndex(
                $project,
                trans('pms::project.flash_messages.project_assigned_role_not_found')
            );
        }
        $employee = optional($request->user())->employee;
        if (is_null($employee)) {
            return $this->redirectToProjectIndex($project, 'Employee Information Not Found For You !');
        }
        if ($employee->id == $projectAssignedRole->project_director_id) {
            $passed = true;
        }
        if ($employee->id == $projectAssignedRole->project_sub_director_id) {
            $passed = true;
        }
        if ($employee->user->hasAnyRole(['ROLE_PROJECT_DIRECTOR', 'ROLE_DIRECTOR_PROJECT'])) {
            $passed = true;
        }

        if (!$passed) {
            return $this->redirectToProjectIndex(
                $project,
                trans('pms::project.flash_messages.project_assigned_role_error')
            );
        }
        return $next($request);
    }

    //-------------------------- Private Methods -----------------------------------------------------------
    private function redirectToProjectIndex(Project $project, $flashMessage)
    {
        Session::flash('error', $flashMessage);
        return redirect()->route('project.show', $project);
    }

    private function getProjectFromRequest(Request $request)
    {
        return $request->route()->parameter('project');
    }
}
