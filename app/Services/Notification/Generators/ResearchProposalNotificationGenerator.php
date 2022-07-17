<?php
/**
 * Created by PhpStorm.
 * User: jahangir
 * Date: 2/5/19
 * Time: 6:38 PM
 */

namespace App\Services\Notification\Generators;


use App\Constants\DepartmentShortName;
use App\Entities\Notification\NotificationType;

use App\Entities\User;
use App\Mail\WorkflowEmailNotification;
use App\Models\NotificationInfo;
use App\Repositories\Notification\NotificationTypeRepository;
use App\Services\Notification\AppNotificationService;
use App\Services\Notification\EmailNotifiable;
use App\Services\Notification\SystemNotifiable;
use App\Services\UserService;
use App\Services\workflow\WorkflowService;
use App\Traits\MailSender;
use Illuminate\Support\Facades\Session;
use Modules\HRM\Entities\Designation;
use function Composer\Autoload\includeFile;
use const http\Client\Curl\AUTH_ANY;
use Illuminate\Support\Facades\Auth;
use Modules\HRM\Services\DesignationService;
use Modules\PMS\Emails\WorkflowNotificationEmail;
use Modules\PMS\Entities\ProjectProposal;
use Modules\RMS\Entities\ResearchProposalSubmission;
use Modules\RMS\Services\ResearchProposalSubmissionService;
use Prophecy\Doubler\Generator\TypeHintReference;
use Symfony\Component\Debug\Debug;

class ResearchProposalNotificationGenerator extends BaseNotificationGenerator implements SystemNotifiable, EmailNotifiable
{
    use MailSender;

    private $appNotificationService;
    private $userService;
    private $researchProposalSubmissionService;
    private $workflowService;
    private $notificationTypeRepository;


    /**
     * ResearchProposalNotificationGenerator constructor.
     * @param UserService $userService
     * @param AppNotificationService $appNotificationService
     * @param ResearchProposalSubmissionService $researchProposalSubmissionService
     */
    public function __construct(
        AppNotificationService $appNotificationService,
        ResearchProposalSubmissionService $researchProposalSubmissionService,
        UserService $userService,
        WorkflowService $workflowService,
        NotificationTypeRepository $notificationTypeRepository
    ) {
        $this->appNotificationService = $appNotificationService;
        $this->researchProposalSubmissionService = $researchProposalSubmissionService;
        $this->userService = $userService;
        $this->workflowService = $workflowService;
        $this->notificationTypeRepository = $notificationTypeRepository;

    }


    public function notify(NotificationInfo $notificationInfo, NotificationType $notificationType)
    {
        if ($this->hasAppNotification($notificationType)) {
            $this->saveAppNotification($notificationInfo);
        }

        if ($this->hasEmailNotification($notificationType)) {
            $this->sendEmailNotification($notificationInfo);
        }
    }

    public function sendEmailNotification($notificationInfo)
    {

        $notificationData = $notificationInfo->getDynamicValues()['notificationData'];
//        dd($notificationData);
        if (array_key_exists('designation_id', $notificationData)) {
            $emailRecipientDesignationId = $notificationData['designation_id'];
        } elseif (array_key_exists('workflow_master_id', $notificationData)) {
            $activeWf = $this->workflowService->getActiveWorkflowByWFMasterId($notificationData['workflow_master_id']);
            $emailRecipientDesignationId = $activeWf->designation_id;
        } else {
            $emailRecipientDesignationId = null;
        }

        if (isset($notificationData['to_users'])) {
            $toUsers = $notificationData['to_users'];
        } else {
            $toUsers = $this->userService->getUserByDesignationId($emailRecipientDesignationId);
        }
        //        dd($senderEmail);
        $emailData['url'] = $notificationData['url'];
        $emailData['title'] = $notificationData['item_title'];
        $emailData['message'] = $notificationData['message'];
//        dd($toUsers);
        if (!is_null($toUsers)) {
//            dd('here');
            foreach ($toUsers as $toUser) {
                if (!is_null($toUser)) {
                    $this->sendEmail($toUser->email,
                        new WorkflowEmailNotification($emailData['title'], $emailData['message'], $emailData['url']));
                } else {
                    Debug::log('error', 'Empty recipient collection');
                }
            }

        } else {
            Debug::log('error', 'Empty recipient collection');
        }


//        if (isset($senderEmail) && !empty($senderEmail)) {
//            //            $user = $emailData['user']->first();
//            $emailData['url'] = $notificationData['url'];
//            $emailData['title'] = $notificationData['item_title'];
//            $emailData['message'] = $notificationData['message'];
//            //            dd($emailData);
//            $this->sendEmail($senderEmail, new WorkflowEmailNotification($emailData['title'], $emailData['message'], $emailData['url']));
//        } else {
//            Debug::log('error', 'Empty recipient collection');
//        }

    }


    /**
     * @param NotificationInfo $data
     */
    public function saveAppNotification($data)
    {
        $notificationType = $this->notificationTypeRepository->findBy(['name' => $data->notificationType])->first();
        $notificationData = (array)$data->dynamicValues['notificationData'];
        $notificationData['type_id'] = $notificationType->id;
        $notificationData['from_user_id'] = Auth::user()->id;
        $users = $this->getRecipients($data);
        if (empty($users)) {
            Session::flash('success', trans('labels.save_success'));
        } 
        foreach ($users as $user) {
            $notificationData['to_user_id'] = $user['id'];
            Session::flash('success',
                trans('rms::research_proposal.flash_messages.workflow_notification_message',
                    ['name' => $user['name']]));
            $this->appNotificationService->save($notificationData);
        }
    }


    /**
     * @param $data
     * @return array
     */
    private function getRecipients($data): array
    {
        if (!empty($data->dynamicValues['to_users_designation'])) {
            $users = $this->userService->getUserForNotificationSend($data->dynamicValues['to_users_designation']);
        } else {
            $users = [];
        }

        if (isset($data->dynamicValues['to_employee_id']) && count($data->dynamicValues['to_employee_id']) > 0) {
            $employeesUsers = $this->userService->getUserByEmployeeIds($data->dynamicValues['to_employee_id'])->toArray();
            $users = array_merge($users, $employeesUsers);
        }

        if (isset($data->dynamicValues['proposal_id'])) {
            $proposal = $this->researchProposalSubmissionService->findOne($data->dynamicValues['proposal_id']);
            array_push($users, $proposal->submittedBy->toArray());
        }

        if (isset($data->dynamicValues['notificationData']['designation_id'])) {
            $designationUsers = Designation::find($data->dynamicValues['notificationData']['designation_id'])->user;
            // there might be some case, where user does not have to belong RMS department. like Director General is global
            if ($designationUsers->count() > 1) {
                $designationUsers = $designationUsers->filter(function ($user) use ($data) {
                    if (isset($data->dynamicValues['notificationData']['department_id'])) {
                        return $user->employee->department_id == $data->dynamicValues['notificationData']['department_id'];
                    } else {
                        return $user->getDepartmentCode() == DepartmentShortName::ResearchDivision;
                    }
                });
            }
            
            $users = array_merge($users, $designationUsers->toArray());
        }

        return $users;
    }

    private function hasEmailNotification(NotificationType $notificationType)
    {
        return intval($notificationType->is_email_notification) === 1;
    }

    private function hasAppNotification(NotificationType $notificationType)
    {
        return intval($notificationType->is_application_notification) === 1;
    }
}
