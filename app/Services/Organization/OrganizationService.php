<?php
/**
 * Created by PhpStorm.
 * User: bs100
 * Date: 1/15/19
 * Time: 6:31 PM
 */

namespace App\Services;


use App\Repositories\Organization\OrganizationRepository;
use App\Traits\CrudTrait;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Modules\PMS\Entities\Project;
use Modules\PMS\Services\ProjectService;
use Modules\RMS\Services\ResearchService;

class OrganizationService
{
    use CrudTrait;
    private $organizationRepository;
    private $projectResearchOrgService;
    private $projectProposalService;
    /**
     * @var ResearchService
     */
    private $researchService;
    /**
     * @var ProjectService
     */
    private $projectService;

    /**
     * OrganizationService constructor.
     * @param OrganizationRepository $organizationRepository
     * @param ResearchService $researchService
     * @param ProjectService $projectService
     */
    public function __construct(
        OrganizationRepository $organizationRepository,
        ResearchService $researchService,
        ProjectService $projectService
    )
    {
        $this->organizationRepository = $organizationRepository;
        $this->researchService = $researchService;
        $this->projectService = $projectService;
        $this->setActionRepository($this->organizationRepository);
    }

    public function getUnmappedOrganizations($organizable)
    {
        $organizationIds = $organizable->organizations->pluck('id');

        return $this->organizationRepository->getOrganizationExceptIds($organizationIds);
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            if ($data['organization_id'] == 'add_new') {
                $organization = $this->save($data);
            } else {
                $organization = $this->findOne($data['organization_id']);
            }

            if ($data['organizable_type'] == Config::get('constants.research')) {
                $research = $this->researchService->findOne($data['organizable_id']);
                $research->organizations()->attach($organization);
            } else {
                $project = $this->projectService->findOne($data['organizable_id']);
                $project->organizations()->attach($organization);
            }

            return $organization;
        });
    }

    public function getSelectOptions(Project $project)
    {
        $organisations = $this->getUnmappedOrganizations($project)
            ->pluck('name', 'id');

        $defaultOptionId = 'add_new';
        $defaultOptionValue = '+ ' . trans('pms::project_proposal.add_new_organization');

        return $organisations->prepend($defaultOptionValue, $defaultOptionId);
    }
}