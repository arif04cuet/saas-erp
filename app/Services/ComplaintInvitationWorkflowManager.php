<?php
/**
 * Created by PhpStorm.
 * User: siaminflack
 * Date: 8/6/19
 * Time: 2:06 PM
 */

namespace App\Services;

use App\Constants\NotificationType as NotificationTypeConstant;
use App\Entities\Notification\Notification;
use App\Entities\Notification\NotificationType;
use App\Entities\StateDetail;
use App\Entities\StateRecipient;
use App\Mail\WorkflowEmailNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Modules\HRM\Entities\Employee;
use SM\Event\TransitionEvent;

class ComplaintInvitationWorkflowManager
{
    public function update(TransitionEvent $event)
    {
        $sm = $event->getStateMachine();
        $model = $sm->getObject();

        $lastStateHistory = $model->stateHistory()->get()->last();

        $this->storeStateRecipient($event, $model, $lastStateHistory);

        $this->sendNotification($event, $model, $lastStateHistory);

        $this->storeStateDetails($lastStateHistory);
    }

    /**
     * @param TransitionEvent $event
     * @param $model
     * @return mixed
     */
    private function getStateRecipient(TransitionEvent $event, $model)
    {
        switch ($event->getTransition()) {
            case 'review':
                $employeeId = Input::get('employee_id');
                return Employee::findOrFail($employeeId);
            case 'ready':
                return $model->creator;
            case 'approve':
                $employeeId = Input::get('reviewer_id');
                return $model->complainer;
            case 'reject':
                return $model->complainer;
            default:
                return null;
        }
    }

    /**
     * @param $lastStateHistory
     */
    private function storeStateDetails($lastStateHistory): void
    {
        StateDetail::create([
            'state_history_id' => $lastStateHistory->id,
            'message' => Input::get('message'),
            'remark' => Input::get('remark'),
        ]);
    }

    /**
     * @param TransitionEvent $event
     * @param $model
     * @param $lastStateHistory
     */
    private function storeStateRecipient(TransitionEvent $event, $model, $lastStateHistory): void
    {
        $recipient = $this->getStateRecipient($event, $model);

        if (!is_null($recipient)) {
            StateRecipient::create([
                'state_history_id' => $lastStateHistory->id,
                'user_id' => $recipient->user->id,
            ]);
        }
    }

    private function sendNotification(TransitionEvent $event, $model, $lastHistory)
    {
        $recipient = $model->stateRecipients()->get()->last();

        $notificationType = NotificationType::where('name', NotificationTypeConstant::HRM_COMPLAINT_INVITATION)->firstOrFail();

        if(!is_null($recipient)) {

            $notification = Notification::create([
                'type_id' => $notificationType->id,
                'ref_table_id' => $model->id,
                'from_user_id' => Auth::id(),
                'to_user_id' => $recipient->user->id,
                'message' => 'Complaint Invitation Request is ' . $model->status,
                'item_url' => (in_array($model->status, ['approved', 'rejected'])
                    ? ($model->status == 'approved'
                        ? route('complaint.create', ['complaintInvitation' => $model->id])
                        :route('complaints.invitations.show', ['complaintInvitation' => $model->id])
                    )
                    : route('complaints.invitations.workflow.edit', ['complaintInvitation' => $model->id]))
            ]);

            if(!is_null($recipient->user->email)) {
                Mail::to($recipient->user)->send(
                    new WorkflowEmailNotification(
                        'HRM Complaint Invitation Workflow',
                        $notification->message,
                        (in_array($model->status, ['approved', 'rejected'])
                            ? ($model->status == 'approved'
                                ? route('complaint.create', ['complaintInvitation' => $model->id])
                                :route('complaints.invitations.show', ['complaintInvitation' => $model->id])
                            )
                            : route('complaints.invitations.workflow.edit', ['complaintInvitation' => $model->id]))
                    )
                );
            }

        }
    }
}