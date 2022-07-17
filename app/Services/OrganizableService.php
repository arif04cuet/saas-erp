<?php
/**
 * Created by PhpStorm.
 * User: bs100
 * Date: 1/15/19
 * Time: 7:37 PM
 */

namespace App\Services;


use App\Repositories\Organization\OrganizableRepository;
use App\Repositories\Organization\OrganizationRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Config;
use Modules\PMS\Services\ProjectProposalService;
use Modules\RMS\Services\ResearchProposalSubmissionService;
use Prophecy\Doubler\Generator\TypeHintReference;

class OrganizableService
{
    use CrudTrait;
    private $organizableRepository;
    private $organizationRepository;
    private $projectProposalService;
    private $researchProposalSubmissionService;

    public function __construct(OrganizableRepository $organizableRepository,
                                OrganizationRepository $organizationRepository,
                                ProjectProposalService $projectProposalService,
                                ResearchProposalSubmissionService $researchProposalSubmissionService)

    {

        $this->organizableRepository = $organizableRepository;
        $this->organizationRepository = $organizationRepository;
        $this->projectProposalService = $projectProposalService;
        $this->researchProposalSubmissionService = $researchProposalSubmissionService;
        $this->setActionRepository($this->organizableRepository);
    }

    public function storeData($projectResearchData, $projectOrResearchId)
    {

        if ($projectResearchData['organizable_type'] == Config::get('constants.research')) {
            $projectResearch = $this->researchProposalSubmissionService->findOne($projectOrResearchId);
        }else{
            $projectResearch = $this->projectProposalService->findOne($projectOrResearchId);
        }
        $organizationId = (int)$projectResearchData['organization_id'];

        if ($organizationId > 0) {
            $projectResearch->organizations()->attach($organizationId);
        } else {
            $organization = $this->organizationRepository->save($projectResearchData);
            $projectResearch->organizations()->attach($organization['id']);
        }
        return new Response(trans('labels.save_success'));
    }

    // TODO: Remove unless necessary
    public function getAlreadyAddedOrganizationIds($projectOrResearchId, $type)
    {
        if ($type == Config::get('constants.research')) {
            $projectResearch = $this->researchProposalSubmissionService->findOne($projectOrResearchId);
       }else{
            $projectResearch = $this->projectProposalService->findOne($projectOrResearchId);
        }
        $alreadyAddedIds = [];
        if (is_null($projectResearch)) {
            abort(404);
        } else {
            $ids = $projectResearch->organizations->toArray();
            $alreadyAddedIds = array_column($ids, 'id');
        }
        return $alreadyAddedIds;

    }

}