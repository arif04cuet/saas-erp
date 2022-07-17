<?php

namespace Modules\PMS\Http\Controllers;

use App\Entities\Attribute;
use App\Entities\Organization\Organization;
use App\Services\AttributeService;
use App\Services\DivisionService;
use App\Services\TaskService;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Modules\HRM\Services\EmployeeService;
use Modules\PMS\Entities\Project;
use Modules\PMS\Http\Requests\CreateProjectRequest;
use Modules\PMS\Services\AttributePlanningService;
use Modules\PMS\Services\ProjectDetailProposalService;
use Modules\PMS\Services\ProjectService;
use Modules\PMS\Services\ProjectAttributeService;
use App\Services\OrganizationService;
use App\Services\OrganizationMemberService;

class ProjectController extends Controller
{

    /**
     * @var UserService
     */
    private $userService;
    /**
     * @var ProjectService
     */
    private $projectService;
    /**
     * @var TaskService
     */
    private $taskService;
    /**
     * @var DivisionService
     */
    private $divisionService;
    /**
     * @var AttributeService
     */
    private $attributeService;

    /**
     * @var ProjectDetailProposalService
     */
    private $projectDetailProposalService;
    /**
     * @var $attributePlanningService
     */
    private $attributePlanningService;
    /**
     * @var EmployeeService
     */
    private $employeeService;

    private $projectAttributeService;

    private $organizationService;



    /**
     * ProjectController constructor.
     * @param UserService $userService
     * @param ProjectService $projectService
     * @param TaskService $taskService
     * @param DivisionService $divisionService
     * @param AttributeService $attributeService
     * @param EmployeeService $employeeService
     * @param ProjectDetailProposalService $projectDetailProposalService
     */
    public function __construct(
        UserService $userService,
        ProjectService $projectService,
        TaskService $taskService,
        DivisionService $divisionService,
        AttributeService $attributeService,
        EmployeeService $employeeService,
        ProjectAttributeService $projectAttributeService,
        OrganizationService $organizationService,
        ProjectDetailProposalService $projectDetailProposalService
    ) {
        $this->userService = $userService;
        $this->employeeService = $employeeService;
        $this->projectService = $projectService;
        $this->taskService = $taskService;
        $this->divisionService = $divisionService;
        $this->attributeService = $attributeService;
        $this->projectAttributeService = $projectAttributeService;
        $this->organizationService = $organizationService;
        $this->projectDetailProposalService = $projectDetailProposalService;
    }

    /**
     * Display a listing of the resource.
     * @return Factory|Application|Response|View
     */
    public function index()
    {
        $projects = $this->projectService->getProjectsForUser(Auth::user());

        return view('pms::project.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Factory|Application|Response|View
     */
    public function create()
    {
        $username = Auth::user()->username;
        $name = Auth::user()->name;
        $auth_user_id = Auth::user()->id;
        $departmentName = $this->userService->getDepartmentName($username);
        $designation = $this->userService->getDesignation($username);
        $employees = $this->employeeService->getEmployeesForDropdown();
        $proposals = $this->projectDetailProposalService->getRemainingApprovedDetailProposal();
        return view(
            'pms::project.create',
            compact(
                'auth_user_id',
                'name',
                'employees',
                'designation',
                'departmentName',
                'proposals'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     * @param CreateProjectRequest $request
     * @return RedirectResponse
     */
    public function store(CreateProjectRequest $request)
    {
        $this->projectService->store($request->all());
        Session::flash('success', trans('labels.save_success'));
        return redirect()->route('project.index');
    }

    /**
     * Show the specified resource.
     * @param Project $project
     * @param Attribute $attribute
     * @return Factory|Application|Response|View
     */
    public function show(Project $project, Attribute $attribute)
    {
        $maleMembersCount = $this->projectService->getTotalMembersByGender($project, 'male');
        $femaleMembersCount = $this->projectService->getTotalMembersByGender($project, 'female');
        $ganttChart = $this->taskService->getTasksGanttChartData($project->tasks);
        $divisions = $this->divisionService->findAll();
        $projectAttributeSummary = $this->projectService->getProjectAttributeSummary($project, true);
        $projectFiscalYears = $this->projectService->getFiscalYearsForProject($project);
        $projectAttributes = $this->projectAttributeService->getProjectAttributesForDropdown(
            null,
            null,
            ['project_id' => $project['id']],
            false
        );
        $attributes = $this->attributeService->getAttributesForDropdown(
            null,
            null,
            ['project_id' => $project['id']],
            false
        );
        $organizations = $project->organizations->toArray();
        $members = $this->projectService->getOrganizationMembers($project->organizations);

        // Testing Purpose 
        // $organization = $this->organizationService->findOrFail(8)->members->toArray();
        // $ids = [];
        // foreach ($organization as  $abc) {
        //     $ids[] = $abc['id'];
        // }
        // return $ids;

        return view(
            'pms::project.show',
            compact(
                'project',
                'ganttChart',
                'divisions',
                'attribute',
                'maleMembersCount',
                'projectAttributeSummary',
                'femaleMembersCount',
                'projectFiscalYears',
                'projectAttributes',
                'attributes',
                'organizations',
                'members'
            )
        );
    }

    public function edit(Project $project)
    {
        $employees = $this->employeeService->getEmployeesForDropdown(null, null, null, true);
        return view('pms::project.edit', compact('project', 'employees'));
    }

    public function update(Request $request, Project $project)
    {
        if ($this->projectService->updateData($project, $request->all())) {
            return redirect()
                ->route('project.index')
                ->with('success', trans('labels.update_success'));
        } else {
            return redirect()
                ->route('project.index')
                ->with('error', trans('labels.update_fail'));
        }
    }

    public function filter(Request $request, $projectId)
    {
        $organization = null;
        if (!is_null($request['organization_id'])) {
            $organization = $this->organizationService->findOrFail($request['organization_id']);
        }

        if (!is_null($request['attribute_id'])) {
            return $value = $this->projectService->filterUsingAttribute(
                $request['attribute_id'],
                $request['period_from_org'],
                $request['period_to_org'],
                $organization,
                $request['member_id']
            );
        } else {
            $value = $this->projectService->filterAttributeValuesByDateRange(
                $projectId,
                $request['period_from_org'],
                $request['period_to_org'],
                $organization,
                $request['member_id']
            );
            if (!is_null($organization) || !is_null($request['member_id'])) {
                $selectedProjectId = 3;
            } else {
                $selectedProjectId = 0;
            }


            $values = [];
            array_push($values, $value);
            array_push($values,  $selectedProjectId);
            return  $values;
        }
    }

    public function getMembersByOrganizationId($organizationId)
    {
        $members = $this->projectService->getMembers($organizationId);
        $data['members'] = $members;
        $data['members_size'] = sizeof($members);
        return $data;
    }
}
