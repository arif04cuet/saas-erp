<?php

namespace App\Listeners;

use App\Events\InvitationSent;
use App\Services\Notification\AppNotificationService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\WorkflowEmailNotification;
use Illuminate\Support\Facades\Session;

class SendProposalInvitationEmailNotificaiton
{
    /**
     * @var AppNotificationService
     */
    private $appNotificationService;

    /**
     * Create the event listener.
     *
     * @param AppNotificationService $appNotificationService
     */
    public function __construct(AppNotificationService $appNotificationService)
    {
        $this->appNotificationService = $appNotificationService;
    }

    /**
     * Handle the event.
     *
     * @param InvitationSent $event
     * @return void
     */
    public function handle(InvitationSent $event)
    {
        $proposalInvitation = $event->proposalInvitation;
        if ($proposalInvitation->hasAppNotification()) {
            $this->saveAppNotification($proposalInvitation);
        }

        if ($proposalInvitation->hasEmailNotification()) {
            $this->sendMailNotification($proposalInvitation);
        }
    }

    /**
     * @param $user
     * @param $proposalInvitation
     */
    private function sendMailNotification($proposalInvitation): void
    {
        foreach ($proposalInvitation->recipients as $user) {
            Mail::to($user->email)->send(
                new WorkflowEmailNotification(
                    $proposalInvitation->model->title,
                    $proposalInvitation->message,
                    $proposalInvitation->url
                )
            );
        }
    }

    /**
     * @param $user
     * @param $proposalInvitation
     */
    private function saveAppNotification($proposalInvitation): void
    {
        foreach ($proposalInvitation->recipients as $user) {
            $this->appNotificationService->save([
                'type_id' => $proposalInvitation->notificationTypeId,
                'ref_table_id' => $proposalInvitation->model->id,
                'from_user_id' => Auth::id(),
                'to_user_id' => $user->id,
                'message' => $proposalInvitation->message,
                'item_url' => $proposalInvitation->url,
            ]);
            Session::flash('success',
                trans('rms::research_proposal.flash_messages.workflow_notification_message',
                    ['name' => $user->name]));
        }

    }
}
