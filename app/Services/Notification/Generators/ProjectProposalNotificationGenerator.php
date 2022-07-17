<?php
/**
 * Created by PhpStorm.
 * User: bs110
 * Date: 2/5/19
 * Time: 6:38 PM
 */

namespace App\Services\Notification\Generators;


use App\Constants\DepartmentShortName;
use App\Entities\Notification\NotificationType;
use App\Entities\User;
use App\Mail\WorkflowEmailNotification;
use App\Models\NotificationInfo;
use App\Services\Notification\AppNotificationService;
use App\Services\Notification\EmailNotifiable;
use App\Services\Notification\SystemNotifiable;
use App\Services\UserService;
use App\Services\workflow\WorkflowService;
use App\Traits\MailSender;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Modules\HRM\Entities\Designation;
use Modules\PMS\Emails\WorkflowNotificationEmail;
use Modules\PMS\Entities\ProjectDetailProposal;
use Modules\PMS\Entities\ProjectProposal;
use Modules\PMS\Services\ProjectDetailProposalService;
use Modules\PMS\Services\ProjectProposalService;
use Symfony\Component\Debug\Debug;

class ProjectProposalNotificationGenerator extends BaseNotificationGenerator implements SystemNotifiable, EmailNotifiable
{
    use MailSender;

    private $appNotificationService;
    private $userService;
    private $projectProposalService;
    private $projectDetailProposalService;
    private $workflowService;

    /**
     * ProjectProposalNotificationGenerator constructor.
     * @param AppNotificationService $appNotificationService
     * @param ProjectProposalService $projectProposalService
     * @param UserService $userService
     */
    public function __construct(
        AppNotificationService $appNotificationService,
        ProjectProposalService $projectProposalService,
        ProjectDetailProposalService $projectDetailProposalService,
        UserService $userService,
        WorkflowService $workflowService
    ) {
        $this->appNotificationService = $appNotificationService;
        $this->userService = $userService;
        $this->projectProposalService = $projectProposalService;
        $this->projectDetailProposalService = $projectDetailProposalService;
        $this->workflowService = $workflowService;
    }

    public function notify(NotificationInfo $notificationInfo, NotificationType $notificationType)
    {
        $notificationData = $notificationInfo->getDynamicValues()['notificationData'];
        $notificationData['type_id'] = $notificationType->id;

        // app notification part
        if (array_key_exists('designation_id', $notificationData)) {
            $notificationRecipientDesignationId = $notificationData['designation_id'];
            $designation = $this->getDesignationById($notificationRecipientDesignationId);
            if (is_null($designation)) {
                Session::flash('error', trans('pms::project_proposal.flash_messages.no_designation_user_found'));
            } else {
                $recipients = $this->getUsersForNotificationSend([$designation->short_name]);
            }
        } elseif (array_key_exists('workflow_master_id', $notificationData)) {
            $activeWf = $this->workflowService->getActiveWorkflowByWFMasterId($notificationData['workflow_master_id']);
            $notificationRecipientDesignationId = (!is_null($activeWf)) ? $activeWf->designation_id : null;
            $designation = $this->getDesignationById($notificationRecipientDesignationId);
            if (is_null($designation)) {
                Session::flash('error', trans('pms::project_proposal.flash_messages.no_designation_user_found'));
            } else {
                $recipients = $this->getUsersForNotificationSend([$designation->short_name]);
            }
        } else {
            $recipients = $this->fetchRecipients($notificationData['ref_table_id'],
                $notificationInfo->getDynamicValues()['event'],
                $notificationData['feature'], $notificationData); // this code is actually ignoring designtaion_id selection
        }
        $name = "";
        if (empty($recipients)) {
            Session::flash('success', trans('labels.save_success'));
        }
        foreach ($recipients as $recipient) {
            $notificationData['to_user_id'] = $recipient['id'];
            $this->saveAppNotification($notificationData);
            $name .= $recipient['name'] . ', ';
        }
        if (!empty($name)) {
            Session::flash('success',
                trans('pms::project_proposal.flash_messages.workflow_notification_message',
                    ['name' => $name]));
        }
        // email part
        $emailRecipientDesignationId = null;
        if (array_key_exists('designation_id', $notificationData)) {
            $emailRecipientDesignationId = $notificationData['designation_id'];
        } elseif (array_key_exists('workflow_master_id', $notificationData)) {
            $activeWf = $this->workflowService->getActiveWorkflowByWFMasterId($notificationData['workflow_master_id']);
            $emailRecipientDesignationId = (!is_null($activeWf)) ? $activeWf->designation_id : null;
        }

        if (!is_null($emailRecipientDesignationId)) {
            $emailData ['user'] = $this->userService->getUserByDesignationId($emailRecipientDesignationId);
        } else {
            $emailData['user'] = collect($recipients)->map(function ($user) {
                return (object)$user;
            });
        }

        $emailData['url'] = $notificationData['item_url'];
        $emailData['title'] = $notificationData['item_title'];
        $emailData['message'] = $notificationData['message'];
        if ($this->hasEmailNotification($notificationType)) {
            $this->sendEmailNotification($emailData);
        }
    }

    public function saveAppNotification($data)
    {
        return $this->appNotificationService->save($data);
    }

    public function fetchRecipients($proposalId, $event, $feature, $data)
    {
//        $recipients = config('constants.' . $event);
//        $usersByKeys = [];
//        if ($key = array_search('initiator', $recipients) !== false) {
//            unset($recipients[$key]);
//            if ($feature == 'project_proposal_feature_name') {
//                $proposal = $this->projectProposalService->findOne($proposalId);
//            } elseif ($feature == 'project_details_proposal_feature_name') {
//                $proposal = $this->projectDetailProposalService->findOne($proposalId);
//            } else {
//                $proposal = null;
//            }
//            $usersByKeys = (!is_null($proposal)) ? $proposal->proposalSubmittedBy->getAttributes() : [];
//        }
//
//        $users = $this->getUsersForNotificationSend($recipients, $data);
//
//        count($usersByKeys) ? array_push($users, $usersByKeys) : '';
//
//        $users[] = array_shift($users);

        // Not need to send notification to initiator for every action

        return $this->getUsersForNotificationSend($data);
    }

    public function sendEmailNotification($data)
    {
        if ($data['user']->count() > 0) {
            $data['user']->each(function ($user) use ($data) {
                $this->sendEmail($user->email,
                    new WorkflowEmailNotification($data['title'], $data['message'], $data['url']));
            });
        } else {
            Debug::log('error', 'Empty user collection');
        }
    }

    private function hasEmailNotification(NotificationType $notificationType)
    {
        return intval($notificationType->is_email_notification) === 1;
    }

    private function getUsersForNotificationSend($data)
    {
        if (isset($data['designation_id'])) {
            $designationIds = [1 => $data['designation_id']];
        } else {
            $designationIds = [];
        }

        $designationUsers = [];
        $designations = Designation::whereIn('id',
            $designationIds)->get(); // could have inject the service, choose to do this way, dont be mad ;)

        foreach ($designations as $designation) {
            $users = $this->filterUserByProjectDepartment($designation->user, $data);
            $designationUsers = array_merge($designationUsers, $users->toArray());
        }

        return $designationUsers;
    }

    private function filterUserByProjectDepartment($designationUsers, $data)
    {
        if ($designationUsers->count() > 1) {
            $designationUsers = $designationUsers->filter(function ($user) use ($data)  {
                if (isset($data['department_id']) && !empty($data['department_id'])) {
                    return $user->employee->department_id == $data['department_id'];
                } else {
                    return $user->getDepartmentCode() == DepartmentShortName::ProjectDivision;
                }
            });
        }

        return $designationUsers;
    }

    private function getDesignationById($designationId)
    {
        return Designation::find($designationId);
    }

}
