<?php

namespace Modules\PMS\Http\Controllers;

use App\Entities\Organization\Organization;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Modules\PMS\Entities\Project;
use Modules\PMS\Services\ProjectReportService;

class ProjectReportController extends Controller
{
    /**
     * @var ProjectReportService
     */
    private $projectReportService;

    public function __construct(ProjectReportService $projectReportService)
    {
        $this->projectReportService = $projectReportService;
    }

    /**
     * Display a listing of the resource.
     * @param Project $project
     * @return Factory|Application|Response|View
     */
    public function showIndicatorReport(Project $project)
    {
        $organizations = $project->organizations->pluck('name', 'id') ?? [];
        $method = 'get';
        return view('pms::project.report.indicator', compact('project', 'organizations', 'method'));
    }

    public function loadIndicatorReport(Request $request, Project $project)
    {
        try {
            $selectedOrganization = $request['organization_id'];

            $organizations = $project->organizations->pluck('name', 'id') ?? [];
            $fromDate = $request['from'] ? Carbon::parse($request['from']) : Carbon::now();
            $toDate = $request['to'] ? Carbon::parse($request['to']) : Carbon::now();
            $organization = Organization::find($selectedOrganization);
            if (is_null($organization)) {
                throw new \Exception('Organization Not Found !');
            }
            $projectAttributeSummary = $this->projectReportService->getAchievedPlannedValuesInDateRange(
                $project,
                $fromDate,
                $toDate
            );
            $membersMonthlyData = $this->projectReportService->getMemberAchievedPlannedValuesInDateRange($project,
                $organization,
                $fromDate,
                $toDate
            );
            $members = $organization->members;
            $method = $request->getMethod();
            return view('pms::project.report.indicator',
                compact('fromDate', 'toDate', 'organization', 'method', 'members', 'project', 'organizations',
                    'membersMonthlyData', 'projectAttributeSummary'));

        } catch (\Exception $exception) {
            Session::flash($exception->getMessage() . ' Trace: ' . $exception->getTraceAsString());
            redirect()->route('project.report.indicator.show', $project);
        }
    }
}
