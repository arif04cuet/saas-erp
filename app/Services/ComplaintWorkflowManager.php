<?php
/**
 * Created by PhpStorm.
 * User: artisan33
 * Date: 8/18/19
 * Time: 5:46 PM
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
use Modules\HRM\Repositories\EmployeeRepository;
use Modules\HRM\Services\EmployeeService;
use SM\Event\TransitionEvent;

class ComplaintWorkflowManager
{
    /**
     * @var EmployeeService
     */
    private $employeeRepository;

    public function __construct()
    {
        $this->employeeRepository = new EmployeeRepository();
    }

    public function update(TransitionEvent $event)
    {
        $sm = $event->getStateMachine();
        $model = $sm->getObject();

        $lastStateHistory = $model->stateHistory();
        $this->storeStateRecipient($event, $model, $lastStateHistory);

        $this->sendNotification($event, $model, $lastStateHistory);

        if($lastStateHistory->get()->last()->from != 'new') {
            $this->storeStateDetails($lastStateHistory);
        }
    }

    private function storeStateRecipient(TransitionEvent $event, $model, $lastStateHistory): void
    {
        $recipient = $this->getStateRecipient($event, $model, $lastStateHistory->get()->last());

        if (!is_null($recipient)) {
            StateRecipient::create([
                'state_history_id' => $lastStateHistory->get()->last()->id,
                'user_id' => $recipient->user->id,
            ]);
        }
    }

    private function getStateRecipient(TransitionEvent $event, $model, $lastStateHistory)
    {
        switch ($event->getTransition()) {
            case 'check':
                $complainer_id = $model->complainer;
                $department_id = Employee::findOrFail($model->complainer->id)->department_id;
                if(is_null($model->invitation)) {

                    $recipientId = $this->getRecipientBasedOnLastHistory($lastStateHistory, $department_id);
                    return Employee::findOrFail($recipientId);
                }else {
                    return $model->invitation->reviewer;
                }

            case 'review':
                $complainer_id = $model->complainer->id;
                $department_id = Employee::findOrFail($complainer_id)->department_id;
                $recipientId = $this->getRecipientBasedOnLastHistory($lastStateHistory, $department_id);
                return Employee::findOrFail($recipientId);
            case 'approve':
                return $model->complainer;
            case 'reject':
                return $model->complainer;
            default:
                return null;
        }
    }

    private function getRecipientBasedOnLastHistory($lastStateHistory, $deptId)
    {
        switch($lastStateHistory->get()->last()->from) {
            case 'new':
                return $this->employeeRepository->findBy([
                    'department_id' => $deptId,
                    'is_divisional_director' => true
                ])->first()->id;
            case 'checking':
                return $this->employeeRepository->findOneBy([
                    'employee_id' => 'directoradmin'
                ])->id;
            case 'reviewing':
                return Input::get('employee_id');
            default:
                return null;
        }
    }

    private function storeStateDetails($lastStateHistory): void
    {
        StateDetail::create([
            'state_history_id' => $lastStateHistory->get()->last()->id,
            'message' => Input::get('message'),
            'remark' => Input::get('remark'),
        ]);
    }

    private function sendNotification(TransitionEvent $event, $model, $lastHistory)
    {
        $recipient = $model->stateRecipients()->get()->last();

        $notificationType = NotificationType::where('name', NotificationTypeConstant::HRM_COMPLAINT)->firstOrFail();

        if(!is_null($recipient)) {

            $notification = Notification::create([
                'type_id' => $notificationType->id,
                'ref_table_id' => $model->id,
                'from_user_id' => Auth::id(),
                'to_user_id' => $recipient->user->id,
                'message' => 'Complaint Request is ' . $model->status,
                'item_url' => in_array($model->status, ['approved', 'rejected'])
                    ? route('complaint.show', ['complaint' => $model->id])
                    : route('complaint.workflow.edit', ['complaint' => $model->id])
            ]);

            if(!is_null($recipient->user->email)) {
                Mail::to($recipient->user)->send(
                    new WorkflowEmailNotification(
                        'HRM Complaint Workflow',
                        $notification->message,
                        in_array($model->status, ['approved', 'rejected'])
                            ? route('complaint.show', ['complaint' => $model->id])
                            : route('complaint.workflow.edit', ['complaint' => $model->id])
                    )
                );
            }

        }
    }
}