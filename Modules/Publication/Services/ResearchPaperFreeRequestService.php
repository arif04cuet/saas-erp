<?php

namespace Modules\Publication\Services;

use App\Traits\CrudTrait;
use Illuminate\Support\Facades\DB;
use Modules\Publication\Repositories\ResearchPaperFreeRequestRepository;
use Modules\Publication\Services\PublicationRequestService;
use Modules\Publication\Services\PublicationInventoryService;
use Modules\Publication\Services\PublicationOrganizationService;

class ResearchPaperFreeRequestService
{
    use CrudTrait;

    private $researchPaperFreeRequestRepository;

    public function __construct(
        ResearchPaperFreeRequestRepository $researchPaperFreeRequestRepository,
        PublicationInventoryService $publicationInventoryService,
        PublicationRequestService $publicationRequestService,
        PublicationOrganizationService $publicationOrganizationService
    ) {
        $this->researchPaperFreeRequestRepository = $researchPaperFreeRequestRepository;
        $this->setActionRepository($this->researchPaperFreeRequestRepository);
        $this->publicationInventoryService = $publicationInventoryService;
        $this->publicationRequestService = $publicationRequestService;
        $this->publicationOrganizationService = $publicationOrganizationService;
    }
    public function storeInResearchPaperFreeRequest(array $data)
    {
        DB::transaction(function () use ($data) {
            $data['application_type'] = 'manual';
            $data['status'] = 'approved';
            $researchPaperFreeRequest = $this->researchPaperFreeRequestRepository->save($data);
            $data['reference_table_id'] = $researchPaperFreeRequest['id'];
            $data['reference_table'] = "Research Paper Free Distribution";
            $this->publicationInventoryService->distributeFromInventory($data);
            $this->checkEmployeeOrOrganization($data);
        });
    }

    public function checkEmployeeOrOrganization($data)
    {
        $publicationRequest['id'] = $data['reference_table_id'];
        $url = 'research-paper-free-requests.show';
        $message = trans('publication::research-paper-free-request.publication_distribution');

        if ($data['reference_type'] == 'employee') {
            $toUserId = $data['reference_id'];
            $this->publicationRequestService->sendPublicationRequestNotification($publicationRequest, $toUserId, $message, $url);
        } else {
            if ($data['reference_id']) {
                $organizationId = $data['reference_id'];
                $organization = $this->publicationOrganizationService->findOrFail($organizationId);
                $toUserId = $organization->organization_head;
                $this->publicationRequestService->sendPublicationRequestNotification($publicationRequest, $toUserId, $message, $url);
            }
        }
    }

    public function getRequestedPaper()
    {
        return  $this->researchPaperFreeRequestRepository->getRequestedPaper();
    }
    public function getDistributedPaper()
    {
        return  $this->researchPaperFreeRequestRepository->getDistributedPaper();
    }
}
