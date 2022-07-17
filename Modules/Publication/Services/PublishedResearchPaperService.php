<?php

namespace Modules\Publication\Services;

use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Support\Facades\DB;
use Modules\Publication\Services\PublicationPressService;
use Modules\RMS\Services\ResearchService;
use Modules\Publication\Repositories\PublishedResearchPaperAttachmentRepository;
use Modules\Publication\Repositories\PublishedResearchPaperCommentRepository;
use Modules\Publication\Repositories\PublishedResearchPaperRepository;
use App\Services\UserService;
use PDO;

class PublishedResearchPaperService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var PublishedResearchPaperRepository
     */
    private $publishedResearchPaperRepo;

    /**
     * @var PublicationRequestService
     */
    private $publicationRequestService;

    /**
     * @var ResearchService
     */
    private $researchService;

    /**
     * @var UserService
     */
    private $userService;

    /**
     * @var PublishedResearchPaperAttachmentRepository
     */
    private $publishedResearchPaperAttachmentRepo;

    /**
     * @var PublishedResearchPaperCommentRepository
     */
    private $publishedResearchPaperCommentRepo;

    private $publicationRequest;

    public function __construct(
        PublishedResearchPaperRepository $publishedResearchPaperRepo,
        PublicationRequestService $publicationRequestService,
        PublicationPressService $publicationPressService,
        PublishedResearchPaperAttachmentRepository $publishedResearchPaperAttachmentRepo,
        PublishedResearchPaperCommentRepository $publishedResearchPaperCommentRepo,
        ResearchService $researchService,
        UserService $userService

    ) {
        $this->publishedResearchPaperRepo = $publishedResearchPaperRepo;
        $this->publicationRequestService = $publicationRequestService;
        $this->publicationPressService = $publicationPressService;
        $this->publishedResearchPaperAttachmentRepo = $publishedResearchPaperAttachmentRepo;
        $this->publishedResearchPaperCommentRepo = $publishedResearchPaperCommentRepo;
        $this->setActionRepository($this->publishedResearchPaperRepo);
        $this->researchService = $researchService;
        $this->userService = $userService;
    }

    public function getAll()
    {
        return $this->publishedResearchPaperRepo->getAll();
    }
    public function getAllCompleted()
    {
        $publishedResearchPaper  = $this->publishedResearchPaperRepo->getAllCompleted();
        return $publishedResearchPaper;
    }


    public function store(array $data)
    {
        DB::transaction(function () use ($data) {
            $data['proof_status'] = config('publication.proof_status.initiated');
            $data['status'] = config('publication.status.on_press');

            $publicationRequest =  $this->publicationRequestService->findOne($data['publication_request_id'])->update(['status' => config('publication.status.on_press')]);

            $save = $this->save($data);
            $this->saveAttachment($data['workorder'], $save->id);
            $this->publicationRequest = $save;
        });
        return $this->publicationRequest;
    }

    public function saveAttachment($file, $id, $type = 'workorder')
    {
        $fileName = $file->getClientOriginalName();
        $path = $this->upload($file, 'published-research-paper-attachments');

        $workorderData = [
            'published_research_paper_id' => $id,
            'attachment' => $path,
            'file_name' => $fileName,
            'type' => $type
        ];

        $this->publishedResearchPaperAttachmentRepo->save($workorderData);
    }

    public function proofRequest(array $data)
    {
        $paper = $this->publishedResearchPaperRepo->findOne($data['published_research_paper_id']);

        DB::transaction(function () use ($data, $paper) {
            if ($paper->proof_status == "final_proof_done") {
                foreach ($data['attachments'] as $attachment) {
                    $this->saveAttachment($attachment, $paper->id, 'book');
                }

                $this->publishedResearchPaperRepo->findOne($paper->id)->update(['status' => config('publication.status.completed')]);
                $this->publicationRequestService->findOne($paper->publication_request_id)->update(['status' => config('publication.status.completed')]);
                $this->sendNotificationForPublicationProof($paper, $paper->proof_status);
            } else {
                $proofStatus = $this->getNextProofStatus($paper->proof_status);
                $this->updatePublishedResearchStatus($proofStatus, $paper->id);
                $data['action'] = $proofStatus;
                $this->publishedResearchPaperCommentRepo->save($data);
                $this->sendNotificationForPublicationProof($paper, $proofStatus);
            }
        });
    }

    public function sendNotificationForPublicationProof($paper, $proofStatus)
    {
        if ($paper->status == 'on_press') {
            $research = $paper->publicationRequest->research;
            $toUserId = $research->researchSubmittedByUser->id;
        } elseif ($paper->status == 'back_to_researcher') {
            $press = $this->publicationPressService->findOrFail($paper['publication_press_id']);
            $toUserId =   $press->employee->user->id;
        }
        $this->checkProofStatus($paper, $toUserId, $proofStatus);
    }

    public function checkProofStatus($paper, $id, $proofStatus)
    {
        $message = $this->getProofStatusMessage($proofStatus);
        $url =  "publication.published-research-papers.show";
        $userRole = 'ROLE_PUBLICATION_SECTION_OFFICER';
        $this->publicationRequestService->sendPublicationRequestNotification($paper, $id, $message, $url);
        $this->publicationRequestService->publicationRequestNotification($paper, $userRole, $message, null, $url);
    }

    public function getProofStatusMessage($proofStatus)
    {
        switch ($proofStatus) {
            case "first_proof":
                return trans('publication::published-research-paper.proof_status.first_proof');
                break;
            case "second_proof":
                return trans('publication::published-research-paper.proof_status.second_proof');
                break;
            case "final_proof":
                return trans('publication::published-research-paper.proof_status.final_proof');
                break;
            case "first_proof_done":
                return trans('publication::published-research-paper.proof_status.first_proof_done');
                break;
            case "second_proof_done":
                return trans('publication::published-research-paper.proof_status.second_proof_done');
                break;
            case "final_proof_done":
                return trans('publication::published-research-paper.proof_status.final_proof_done');
                break;
            case "completed":
                return trans('publication::published-research-paper.proof_status.final_proof_done');
                break;
            default:
                break;
        }
    }

    public function updatePublishedResearchStatus($proofStatus, $id): bool
    {
        $status_for_press = config('publication.status_for_press');

        $publishedResearchData = [
            'proof_status' => $proofStatus,
        ];

        if (array_key_exists($proofStatus, $status_for_press)) {
            $publishedResearchData['status'] = config('publication.status.on_press');
        } else {
            $publishedResearchData['status'] = config('publication.status.back_to_researcher');
        }

        return $this->publishedResearchPaperRepo->findOne($id)->update($publishedResearchData);
    }

    public function getNextProofStatus($current)
    {
        $status = array_keys(config('publication.proof_status'));

        switch ($current) {
            case $status[0]:
                return $status[1];
                break;
            case $status[1]:
                return $status[2];
                break;
            case $status[2]:
                return $status[3];
                break;
            case $status[3]:
                return $status[4];
                break;
            case $status[4]:
                return $status[5];
                break;
            case $status[5]:
                return $status[6];
                break;
            case $status[6]:
                return '';
                break;
            default:
                break;
        }
    }

    //For Dashboard 
    public function getResearchPaperForPressUser($id)
    {
        $employeeId = $this->getEmployeeIdByUserId($id);
        $presses = $this->publicationPressService->findBy(['press_user_id' => $employeeId]);
        $researchPapers = [];
        $publicationResearchPapers = [];
        foreach ($presses as $press) {
            $researchPapers[] = $this->findBy(['publication_press_id' => $press['id'], 'status' => 'on_press']);
        }
        foreach ($researchPapers as $researchPaper) {
            foreach ($researchPaper as $f) {
                $publicationResearchPapers[] = $f;
            }
        }
        return $publicationResearchPapers;
    }

    public function getResearchPaperForResearcher($id)
    {
        $employeeId = $this->getEmployeeIdByUserId($id);
        $researches = $this->researchService->findBy(['submitted_by' => $employeeId]);
        $publicationRequests = [];

        if (count($researches)) {
            foreach ($researches as $research) {
                if ($research->publicationRequest) {
                    if ($research->publicationRequest->publishedResearchPaper) {
                        if ($research->publicationRequest->publishedResearchPaper->status == 'back_to_researcher')
                            $publicationRequests[] = $research->publicationRequest->publishedResearchPaper;
                    }
                }
            }
        }

        return $publicationRequests;
    }

    public function getEmployeeIdByUserId($id)
    {
        $user = $this->userService->findOrFail($id);
        return $user->employee->id;
    }
}
