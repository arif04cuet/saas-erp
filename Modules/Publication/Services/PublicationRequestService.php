<?php

namespace Modules\Publication\Services;

use App\Constants\NotificationType as NotificationTypeConstant;
use App\Entities\Notification\Notification;
use Modules\Publication\Entities\PublicationRequest;
use App\Entities\Notification\NotificationType;
use Modules\Publication\Services\PublicationPressService;
use Illuminate\Support\Facades\Auth;
use App\Entities\Role;
use App\Traits\CrudTrait;
use Modules\Publication\Repositories\PublicationRequestRepository;

class PublicationRequestService
{
    use CrudTrait;

    const PUBLICATION_RESEARCH_REQUEST_DESCRIPTION = 'Notification for any activity regrading research proposal';

    /**
     * @var PublicationRequestRepository
     */
    private $publicationRequestRepository;

    /**
     * PublicationRequestService constructor.
     * @param PublicationRequestRepository $publicationRequestRepository
     */
    public function __construct(
        PublicationRequestRepository $publicationRequestRepository,
        PublicationPressService $publicationPressService
    ) {
        $this->publicationRequestRepository = $publicationRequestRepository;
        $this->setActionRepository($this->publicationRequestRepository);
        $this->publicationPressService = $publicationPressService;
    }

    public function getPublicationRequestsByUser()
    {
        $requests = [];

        if (auth()->user()->hasAnyRole('ROLE_PUBLICATION_COMMITTEE')) {
            $requests = $this->publicationRequestRepository->findAll();
        } elseif (auth()->user()->hasAnyRole("ROLE_PUBLICATION_SECTION_OFFICER")) {
            $requests = $this->publicationRequestRepository->findBy(['status' => 'approved']);
        } else {
            $requests = $this->publicationRequestRepository->getRequestsByUser();
        }

        return $requests;
    }

    public function updatePublicationRequest(array $data, $id)
    {
        $request = $this->publicationRequestRepository->findOne($id);
        $request->update($data);
        return $request;
    }

    public function createPublicationRequestNotification($publicationRequest)
    {
        $userRole = 'ROLE_PUBLICATION_COMMITTEE';
        $message = trans('publication::publication-request.create_publication_request');
        $url = "publication.publication-requests.show";
        $this->publicationRequestNotification($publicationRequest, $userRole, $message, null, $url);
    }

    public function updatePublicationRequestNotification($publicationRequest)
    {
        $url = "publication.publication-requests.show";
        if ($publicationRequest['status'] == 'approved') {
            $userRole = 'ROLE_PUBLICATION_SECTION_OFFICER';
            $message = trans('publication::publication-request.update_publication_request');
            $this->publicationRequestNotification($publicationRequest, $userRole, $message, null, $url);
        } elseif ($publicationRequest['status'] == 'send_back') {
            $message = trans('publication::publication-request.send_back_publication_request');
            $this->notificationForSendBackAndRejectedPublication($publicationRequest, $message, $url);
        } elseif ($publicationRequest['status'] == 'pending') {
            $userRole = 'ROLE_PUBLICATION_COMMITTEE';
            $message = trans('publication::publication-request.create_publication_request');
            $this->publicationRequestNotification($publicationRequest, $userRole, $message, null, $url);
        } else {
            $message = trans('publication::publication-request.reject_publication_request');
            $this->notificationForSendBackAndRejectedPublication($publicationRequest, $message, $url);
        }
    }

    public function notificationForSendBackAndRejectedPublication($publicationRequest, $message, $url)
    {
        $id = $publicationRequest->research->submitted_by;
        $this->sendPublicationRequestNotification($publicationRequest, $id, $message, $url);
    }



    public function sendToPressNotification($publicationRequest)
    {
        $press = $this->publicationPressService->findOrFail($publicationRequest['publication_press_id']);
        $id = $press->employee->user->id;
        $message = trans('publication::publication-request.publication_request_to_press');
        $url = "publication.published-research-papers.show";
        $this->sendPublicationRequestNotification($publicationRequest, $id, $message, $url);
    }

    public function publicationRequestNotification($publicationRequest, $userRole, $message, $users, $url)
    {
        if ($userRole != null) {
            $role = Role::where('name', $userRole)->first();
            $users = $role->users->pluck('id')->toArray();
        }
        foreach ($users as $user) {
            $this->sendPublicationRequestNotification($publicationRequest, $user, $message, $url);
        }
    }

    public function getTypeName(): string
    {
        return NotificationTypeConstant::PUBLICATION_REQUEST;
    }

    public function getTypeDescription(): string
    {
        return self::PUBLICATION_RESEARCH_REQUEST_DESCRIPTION;
    }

    public function sendPublicationRequestNotification(
        $publicationRequest,
        $toUserId,
        $message,
        $url
    ) {
        $notificationTypeArr = [
            'name' => $this->getTypeName(),
            'description' => $this->getTypeDescription(),
            'is_application_notification' => 1,
            'is_email_notification' => 0,
            'is_sms_notification' => 0,
            'icon_name' => '',
        ];

        $notificationType = NotificationType::firstOrCreate($notificationTypeArr);

        if ($toUserId && $toUserId != Auth::user()->id) {
            Notification::create([
                'type_id' => $notificationType->id,
                'ref_table_id' => $publicationRequest['id'],
                'from_user_id' => Auth::user()->id,
                'to_user_id' => $toUserId,
                'message' => $message,
                'item_url' => route($url, $publicationRequest['id'])
            ]);
        }
    }

    public function sendDeadlineNotification(
        $publicationRequest,
        $toUserId,
        $message,
        $url
    ) {
        $notificationTypeArr = [
            'name' => $this->getTypeName(),
            'description' => $this->getTypeDescription(),
            'is_application_notification' => 1,
            'is_email_notification' => 0,
            'is_sms_notification' => 0,
            'icon_name' => '',
        ];

        $notificationType = NotificationType::firstOrCreate($notificationTypeArr);

        Notification::create([
            'type_id' => $notificationType->id,
            'ref_table_id' => $publicationRequest['id'],
            'to_user_id' => $toUserId,
            'message' => $message,
            'item_url' => route($url, $publicationRequest['id'])
        ]);
    }
}
