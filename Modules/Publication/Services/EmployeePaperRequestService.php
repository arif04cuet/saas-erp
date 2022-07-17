<?php

namespace Modules\Publication\Services;

use App\Traits\CrudTrait;
use Illuminate\Support\Facades\DB;
use Modules\Publication\Services\PublicationInventoryService;
use Modules\Publication\Services\PublicationRequestService;
use Modules\Publication\Repositories\ResearchPaperFreeRequestRepository;


use Illuminate\Support\Facades\Auth;

class EmployeePaperRequestService
{
    use CrudTrait;

    private $researchPaperFreeRequestRepository;

    public function __construct(
        ResearchPaperFreeRequestRepository $researchPaperFreeRequestRepository,
        PublicationRequestService $publicationRequestService,
        PublicationInventoryService $publicationInventoryService
    ) {
        $this->researchPaperFreeRequestRepository = $researchPaperFreeRequestRepository;
        $this->setActionRepository($this->researchPaperFreeRequestRepository);
        $this->publicationInventoryService = $publicationInventoryService;
        $this->publicationRequestService = $publicationRequestService;
    }

    public function storeInResearchPaperFreeRequest(array $data)
    {
        $data['requester_id'] = Auth::user()->id;
        $data['application_type'] = 'application';
        $data['status'] = 'pending';
        $data['reference_type'] = 'employee';
        $data['reference_id'] = Auth::user()->id;
        $researchPaperFreeRequest = $this->researchPaperFreeRequestRepository->save($data);
        $this->sendNotificationForEmployeePaperRequest($researchPaperFreeRequest);
    }

    public function sendNotificationForEmployeePaperRequest($publicationRequest)
    {
        $userRole = 'ROLE_PUBLICATION_SECTION_OFFICER';
        $message = trans('publication::research-paper-free-request.employee_publication_request');
        $url = "research-paper-free-requests.show";
        $this->publicationRequestService->publicationRequestNotification($publicationRequest, $userRole, $message, null, $url);
    }


    public function approveRequestedPublicationByEmployee($id, $availableAmount)
    {
        $flag = false;
        DB::transaction(function () use ($id, $availableAmount, &$flag) {

            $data = $this->researchPaperFreeRequestRepository->getRequestedPublicationByEmployee($id);
            if ($availableAmount >= $data['quantity']) {
                $data['status'] = 'approved';
                $data->save();
                $this->sendNotificationForAcceptance($data);
                $data['reference_table_id'] = $data['id'];
                $data['reference_table'] = "Research Paper Free Request";
                $data = $data->toArray();
                $this->publicationInventoryService->distributeFromInventory($data);
                $flag = true;
            }
        });
        return $flag;
    }

    public function sendNotificationForAcceptance($data)
    {
        $id =   $data['requester_id'];
        $message = trans('publication::research-paper-free-request.publication_request_acceptance');
        $url = "research-paper-free-requests.show";
        $this->publicationRequestService->sendPublicationRequestNotification($data, $id, $message, $url);
    }
}
