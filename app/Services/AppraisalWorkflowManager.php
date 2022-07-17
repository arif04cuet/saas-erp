<?php
/**
 * Created by PhpStorm.
 * User: yousha
 * Date: 8/25/19
 * Time: 7:34 AM
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

class AppraisalWorkflowManager
{
    public function update(TransitionEvent $event)
    {
        $stateMachine = $event->getStateMachine();
        $model = $stateMachine->getObject();

        $lastStateHistory = $model->stateHistory();

        $this->storeStateRecipient($event, $model, $lastStateHistory);

        $this->sendNotification($model);
    }

    private function storeStateRecipient($event, $model, $lastStateHistory)
    {
        $recipient = $this->getStateRecipient($event, $model, $lastStateHistory);

        if(!is_null($recipient)) {
            StateRecipient::create([
                'state_history_id' => $lastStateHistory->get()->last()->id,
                'user_id' => $recipient->user->id
            ]);
        }
    }

    private function sendNotification($model)
    {
        $recipient = $model->stateRecipients()->get()->last();
        $stateHistory = $model->stateHistory()->get()->last();

        if($recipient->state_history_id == $stateHistory->id) {
            $notificationType = NotificationType::where('name', NotificationTypeConstant::HRM_APPRAISAL_REQUEST)->firstOrFail();

            if(!is_null($recipient)) {

                $notification = Notification::create([
                    'type_id' => $notificationType->id,
                    'ref_table_id' => $model->id,
                    'from_user_id' => Auth::id(),
                    'to_user_id' => $recipient->user->id,
                    'message' => 'Appraisal Request is ' . $model->status,
                    'item_url' => ($model->status == 'completed'
                        ? route('appraisals.show', ['appraisal' => $model->id])
                        : route('appraisals.edit', ['complaintInvitation' => $model->id]))
                ]);

                if(!is_null($recipient->user->email)) {
                    Mail::to($recipient->user)->send(
                        new WorkflowEmailNotification(
                            'HRM Appraisal Request Workflow',
                            $notification->message,
                            ($model->status == 'completed'
                                ? route('appraisals.show', ['appraisal' => $model->id])
                                : route('appraisals.edit', ['complaintInvitation' => $model->id]))
                        )
                    );
                }

            }
        }


    }

    /**
     * @param $event
     * @param $model
     * @param $lastStateHistory
     * @return mixed
     */
    private function getStateRecipient($event, $model, $lastStateHistory)
    {
        switch ($event->getTransition()) {
            case 'initialize':
                if($model->status == 'initialized') {
                    if($lastStateHistory->get()->last()->from == "new") {
                        return $model->medicalReporter;
                    }else {
                        return $model->reporter;
                    }
                }else {
                    return $model->reporter;
                }
                break;
            case 'verifying':
                return $model->reportingEmployee;
                break;
            case 'reporting':
                return $model->signer;
                break;
            case 'signing':
                return $model->finisher;
                break;
            case 'completing':
                return $model->initiator;
                break;
            default:
                break;
        }
    }

}