<?php

/**
 * Created by PhpStorm.
 * User: artisan33
 * Date: 1/27/19
 * Time: 12:06 PM
 */

namespace Modules\PMS\Services;

use Carbon\Carbon;
use Closure;
use App\Entities\User;
use App\Entities\Attribute;
use App\Entities\Organization\Organization;
use App\Services\UserService;
use App\Traits\CrudTrait;
use App\Utilities\DropDownDataFormatter;
use Illuminate\Support\Facades\DB;
use Modules\Accounts\Services\FiscalYearService;
use Modules\PMS\Entities\Project;
use Modules\PMS\Repositories\ProjectRepository;
use Modules\PMS\Services\AttributePlanningService;
use App\Services\AttributeValueService;
use App\Services\AttributeService;
use App\Services\OrganizationMemberService;

class ProjectService
{
    use CrudTrait;

    /**
     * @var ProjectRepository
     */
    private $projectRepository;
    /**
     * @var UserService
     */
    private $userService;

    private $projectDetailProposalService;
    /**
     * @var AttributeService
     */
    private $attributeService;
    /**
     * @var ProjectAssignedRoleService
     */
    private $projectAssignedRoleService;
    /**
     * @var FiscalYearService
     */
    private $fiscalYearService;

    private $attributePlanningService;
    private $attributeValueService;
    private $organizationMemberService;


    /**
     * ProjectService constructor.
     * @param ProjectRepository $projectRepository
     * @param UserService $userService
     * @param ProjectAssignedRoleService $projectAssignedRoleService
     * @param AttributeService $attributeService
     * @param ProjectDetailProposalService $projectDetailProposalService
     */
    public function __construct(
        ProjectRepository $projectRepository,
        UserService $userService,
        ProjectAssignedRoleService $projectAssignedRoleService,
        AttributeService $attributeService,
        FiscalYearService $fiscalYearService,
        ProjectDetailProposalService $projectDetailProposalService,
        AttributePlanningService $attributePlanningService,
        OrganizationMemberService $organizationMemberService,
        AttributeValueService $attributeValueService

    ) {
        $this->projectRepository = $projectRepository;
        $this->setActionRepository($projectRepository);
        $this->userService = $userService;
        $this->fiscalYearService = $fiscalYearService;
        $this->projectAssignedRoleService = $projectAssignedRoleService;
        $this->attributeService = $attributeService;
        $this->projectDetailProposalService = $projectDetailProposalService;
        $this->attributePlanningService = $attributePlanningService;
        $this->organizationMemberService = $organizationMemberService;
        $this->attributeValueService = $attributeValueService;
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            $project = $this->save($data);
            if (!isset($data['ignore_workflow'])) {
                $this->projectDetailProposalService->update(
                    $this->projectDetailProposalService->findOrFail($data['project_detail_proposal_id']),
                    ['project_id' => $project->id]
                );
                $project->attributes()->saveMany([
                    new Attribute([
                        'name' => 'Deposit',
                        'unit' => 'tk',
                    ]),
                    new Attribute([
                        'name' => 'Loan',
                        'unit' => 'tk',
                    ]),
                    new Attribute([
                        'name' => 'Share',
                        'unit' => 'share',
                    ]),
                ]);
            }
            // create or update project assigned role service data
            $this->projectAssignedRoleService->createOrUpdate($project, $data);
            return $project;
        });
    }

    public function updateData(Project $project, array $data)
    {
        return DB::transaction(function () use ($project, $data) {
            $project = $this->update($project, $data);
            // create or update project assigned role service data
            $this->projectAssignedRoleService->createOrUpdate($project, $data);
            return $project;
        });
    }

    public function getProjectsForUser(User $user)
    {
        if ($this->userService->isDirectorGeneral()) {
            return $this->projectRepository->findAll();
        } else {
            if ($this->userService->isProjectDivisionUser($user)) {
                return $this->projectRepository->findAll();
            } else {
                return $this->projectRepository->findBy(['submitted_by' => $user->id]);
            }
        }
    }

    public function getTotalMembersByGender(Project $project, $gender)
    {
        return $project->organizations->reduce(function ($carry, Organization $organization) use ($gender) {
            return $carry + $organization->members->where('gender', $gender)->count();
        }, 0);
    }

    /**
     * @param Closure|null $implementedValue
     * @param Closure|null $implementedKey
     * @param array|null $query
     * @param false $isEmptyOption
     * @return mixed
     */
    public function getProjectsForDropdown(
        Closure $implementedValue = null,
        Closure $implementedKey = null,
        array $query = null,
        $isEmptyOption = false
    ) {
        $trainings = $query ? $this->projectRepository->findBy($query) : $this->projectRepository->findAll();
        return DropDownDataFormatter::getFormattedDataForDropdown(
            $trainings,
            $implementedKey,
            $implementedValue ?: function ($training) {
                return $training->title;
            },
            $isEmptyOption
        );
    }

    public function getProjectAttributeSummary(Project $project, $onlyTillActiveMonth = false)
    {
        $data = [];
        foreach ($project->attributes as $attribute) {
            $data[$attribute->id] = $this->attributeService->getAchievedPlannedValuesByMonthYear(
                $attribute,
                $onlyTillActiveMonth
            );
        }
        return $data;
    }

    public function getFiscalYearsForProject(Project $project)
    {
        return $this->fiscalYearService->getFiscalYearsForProject($project);
    }

    public function filterAttributeValuesByDateRange($projectId, $from, $to, $organization, $memberId)
    {
        $values = [];
        $from = Carbon::createFromFormat('d/m/Y',  $from)->format('Y-m-d');
        $to = Carbon::createFromFormat('d/m/Y',   $to)->format('Y-m-d');

        $project = $this->findOrFail($projectId);
        $achievedValues = $this->attributeValueService->getTotalAchievedValueByDateRange($project, $from, $to,  $organization, $memberId);
        if ($organization == null && $memberId == null) {
            $plannedValues = $this->attributePlanningService->getTotalPlannedValueByDateRange($project, $from, $to);

            for ($i = 0; $i < sizeof($achievedValues); $i++) {
                $value = [];
                array_push($value, $plannedValues[$i][0], $plannedValues[$i][1], $plannedValues[$i][2], $achievedValues[$i][2]);
                array_push($values, $value);
            }
        } else {
            for ($i = 0; $i < sizeof($achievedValues); $i++) {
                $value = [];
                array_push($value, $achievedValues[$i][0], $achievedValues[$i][1], null, $achievedValues[$i][2]);
                array_push($values, $value);
            }
        }

        return  $values;
    }

    public function filterUsingAttribute($attributeId, $from, $to, $organization, $memberId)
    {
        $values = [];
        $from = Carbon::createFromFormat('d/m/Y',  $from)->format('Y-m-d');
        $to = Carbon::createFromFormat('d/m/Y',   $to)->format('Y-m-d');
        $selectedProjectId = 1;

        $achievedValues = $this->attributeValueService->getAchievedValues($attributeId, $from, $to, $organization, $memberId);
        if ($organization == null && $memberId == null) {
            $plannedValues = $this->attributePlanningService->getPlannedValues($attributeId, $from, $to);
            array_push($values,  $plannedValues);
            $selectedProjectId = 1;
        } else {
            $selectedProjectId = 2;
        }
        array_push($values,  $achievedValues);

        $data = [];
        array_push($data,  $values);
        array_push($data,  $selectedProjectId);
        return $data;
    }

    public function getOrganizationMembers($organizations)
    {
        $members = array();
        foreach ($organizations as $organization) {
            $member =  $organization->members->toArray();
            $members =  array_merge($members, $member);
        }
        return $members;
    }

    public function getMembers($organizationId)
    {
        // return $members = $this->organizationMemberService->getMembersForDropdown(
        //     null,
        //     null,
        //     ['organization_id' => $organizationId],
        //     false
        // );

        return $members = $this->organizationMemberService->getMembers(
            ['organization_id' => $organizationId]
        );
    }
}
