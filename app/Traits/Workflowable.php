<?php

/**
 * Created by VS Code.
 * User: Araf
 * Date: 12/06/2022
 * Time: 1:04 PM
 */

namespace App\Traits;

use App\Constants\NotificationType as NotificationTypeConstant;
use App\Entities\Notification\Notification;
use App\Entities\Notification\NotificationType;
use App\Entities\StateDetail;
use App\Entities\StateRecipient;
use App\Entities\User;
use App\Mail\WorkflowEmailNotification;
use Iben\Statable\Statable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

trait Workflowable
{
    use Statable;

    public function applyTransition($transition, $beforeRecipients = [], $details = [])
    {
        $isTransitionApplied = $this->apply($transition);

        if ($isTransitionApplied) {
            $this->stateMachine()->getObject()->save();

            $recipients = $this->saveRecipients($beforeRecipients);

            $this->saveDetails($details);

            $this->sendNotification($recipients, $this->getNotificationType());
        }

        return $isTransitionApplied;
    }

    public function getStateOwnerTransition()
    {
        $possibleTransitions = array_filter(
            $this->stateMachine()->getPossibleTransitions(),
            [$this, 'filterPossibleTransitions']
        );

        return array_values(array_unique($possibleTransitions));
    }

    // TODO: change this to call specific method from arguments | User::all()->filter(function($user) {})
    public function getNextStatePossibleRecipients()
    {
        $users = User::all()
            ->filter(function ($user) {
                return ($user->hasAnyRole($this->nextRecipientsRoles())
                    && ($user->id !== auth()->user()->id));
            })->values()
            ->pluck('name', 'id');
        return $users;
    }

    public function isRecipient()
    {
        return is_null($this->stateOwner()) ? false : true;
    }

    public function getStateUrl()
    {
        $object = $this->stateMachine()->getObject();

        return route($this->stateMachine()->metadata(
            'state',
            $this->stateMachine()->getState(),
            'url'
        ), $object->id);
    }

    public function filterPossibleTransitions($transition)
    {
        $possibleTransition = auth()->user()->hasRole($this->stateMachine()->metadata(
            'transition',
            $transition,
            'action.role'
        ));
        $data = $this->canCurrentUserReceive();

        if (!is_null($possibleTransition)) {
            $data[] = $possibleTransition;
        }

        $data = array_unique($data);

        return in_array($transition, $data);
    }

    public function canCurrentUserReceive()
    {
        $data = [];

        if (
            $this->stateMachine()->getObject()->receiver_id == auth()->user()->id
            || $this->stateMachine()->getObject()->requester_id == auth()->user()->id
        ) {

            $data[] = 'receive';
        }

        return $data;
    }

    public function getLatestStateHistory()
    {
        return $this->lastStateHistory();
    }

    private function stateOwner()
    {
        $lastHistory = $this->lastStateHistory();
        // logger(auth()->user());
        if (is_null($lastHistory->get()->last())) {
            return null;
        }

        $stateRecipient = DB::table('state_recipients')
            ->where('state_history_id', $lastHistory->get()->last()->id)
            ->where('user_id', auth()->user()->id)
            ->first();



        return empty($stateRecipient) ? null : $stateRecipient;
    }

    private function getAfterRecipients()
    {
        $recipients = $this->getStateRecipientsByRoles();

        $recipients = $recipients->merge($this->getStateRecipientsByKeys());

        return $recipients->unique();
    }

    /**
     * @param $transition
     * @return array
     * @throws \Illuminate\Container\EntryNotFoundException
     */
    private function getStateRecipientsByRoles()
    {
        $object = $this->stateMachine()->getObject();

        $roles = $this->stateMachine()->metadata(
            'state',
            $this->stateMachine()->getState(),
            'recipients.type.after.roles'
        );

        return ($this->getUsers($object->requester_id, $roles));
    }

    private function getStateRecipientsByKeys()
    {
        $object = $this->stateMachine()->getObject();

        $keys = $this->stateMachine()->metadata(
            'state',
            $this->stateMachine()->getState(),
            'recipients.type.after.keys'
        );

        $recipients = collect();

        if (!is_null($keys) && is_array($keys)) {
            foreach ($keys as $key) {

                if (!is_null($object->$key)) {
                    $user = User::findOrFail($object->$key);
                    if (!is_null($user)) {
                        $recipients->push($user);
                    }
                }
            }
        }

        return $recipients;
    }

    private function getUsers($requester_id, $roles)
    {
        $requester = User::findOrFail($requester_id);

        $departmentId = get_user_department($requester)->id;

        $users = User::all()
            ->filter(function ($user) use ($departmentId, $roles) {
                if (!empty($user->employee)) {
                    return get_user_department($user)->id == $departmentId && $user->hasAnyRole($roles);
                }
            });

        return !empty($users) ? $users : collect();
    }

    private function nextRecipientsRoles()
    {

        $possibleTransitions = $this->stateMachine()->getPossibleTransitions();
        $recipientRoles = [];

        foreach ($possibleTransitions as $possibleTransition) {

            $next_state = $this->stateMachine()->metadata(
                'transition',
                $possibleTransition,
                'next_state'
            );

            if (!is_null($next_state)) {
                $roles = $this->stateMachine()->metadata(
                    'state',
                    $next_state,
                    'recipients.type.before.roles'
                );

                if (!is_null($roles) && is_array($roles)) {
                    $recipientRoles = array_merge($roles, $recipientRoles);
                }
            }
        }

        return array_unique($recipientRoles);
    }

    private function saveRecipients($beforeRecipients)
    {
        $recipients = $this->getAfterRecipients();

        if (!empty($beforeRecipients)) {
            $recipients = $recipients->merge($beforeRecipients);
        }

        $lastStateHistory = $this->lastStateHistory();

        if (!empty($recipients)) {
            foreach ($recipients as $recipient) {
                StateRecipient::create([
                    'state_history_id' => $lastStateHistory->get()->last()->id,
                    'user_id' => $recipient->id,
                ]);
            }
        }

        return $recipients;
    }

    private function saveDetails($details)
    {
        $lastStateHistory = $this->lastStateHistory();

        if (!empty($details)) {
            StateDetail::create([
                'state_history_id' => $lastStateHistory->get()->last()->id,
                'message' => !empty($details['message']) ? $details['message'] : null,
                'remark' => !empty($details['remark']) ? $details['remark'] : "",
            ]);
        }
    }

    /**
     * @param $recipients
     * @param $notificationType
     * @throws \Illuminate\Container\EntryNotFoundException
     */
    private function sendNotification($recipients, $notificationType): void
    {
        $notificationType = NotificationType::where(
            'name',
            NotificationTypeConstant::getConstant($notificationType)
        )->firstOrFail();

        if (!count($recipients)) {
            return;
        }

        foreach ($recipients as $recipient) {
            $notification = Notification::create([
                'type_id' => $notificationType->id,
                'ref_table_id' => $this->stateMachine()->getObject()->id,
                'from_user_id' => Auth::id(),
                'to_user_id' => $recipient->id,
                'message' => $this->getMessage() . $this->stateMachine()->getState(),
                'item_url' => $this->getStateUrl()
            ]);

            // Commented out by shohag since sending mail is not required by BARD
            //            Mail::to($recipient)->send(
            //                new WorkflowEmailNotification(
            //                    'IMS Workflow',
            //                    $notification->message,
            //                    $this->getStateUrl()
            //                )
            //            );
        }

        //$recipientUsers = User::find($recipients);
        $message = "";
        foreach ($recipients as $recipientUser) {
            $message .= $recipientUser->name . ' ';
        }
        Session::flash('success', 'Notification Sent To ' . $message);
    }

    /**
     * @return mixed
     * @throws \Illuminate\Container\EntryNotFoundException
     */
    private function lastStateHistory()
    {
        $lastStateHistory = $this->stateMachine()->getObject()->stateHistory();

        return $lastStateHistory;
    }

    private function getNotificationType()
    {
        $notificationType = $this->stateMachine()->metadata(
            'state',
            $this->stateMachine()->getState(),
            'notification_type'
        );

        return $notificationType;
    }

    private function getMessage()
    {
        $message = $this->stateMachine()->metadata(
            'state',
            $this->stateMachine()->getState(),
            'message'
        );

        return $message;
    }
}
