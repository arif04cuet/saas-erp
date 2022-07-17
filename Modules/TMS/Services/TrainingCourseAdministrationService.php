<?php
/**
 * Created by PhpStorm.
 * User: siaminflack
 * Date: 10/6/19
 * Time: 3:03 PM
 */

namespace Modules\TMS\Services;


use App\Constants\NotificationType as NotificationTypeConstant;
use App\Entities\Notification\Notification;
use App\Entities\Notification\NotificationType;
use App\Entities\User;
use App\Mail\WorkflowEmailNotification;
use App\Traits\CrudTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Modules\HRM\Entities\Employee;
use Modules\TMS\Entities\TrainingCourse;
use Modules\TMS\Entities\TrainingCourseAdministration;
use Modules\TMS\Repositories\TrainingCourseAdministrationRepository;

class TrainingCourseAdministrationService
{
    use CrudTrait;

    /**
     * @var TrainingCourseAdministrationRepository
     */
    private $repository;

    /**
     * TrainingCourseAdministrationService constructor.
     * @param TrainingCourseAdministrationRepository $repository
     */
    public function __construct(TrainingCourseAdministrationRepository $repository)
    {
        $this->repository = $repository;
        $this->setActionRepository($repository);
    }

    public function updateRequest(TrainingCourse $course, array $data)
    {
        return DB::transaction(function () use ($course, $data) {

            $course->administrations()->delete();
            $training = $course->training;
            $employeeIds = $this->getRoleKeyedEmployeeIdCollection($data)
                ->filter($this->validEmployeeId());

            $administration = $course->administrations()->saveMany(
                $employeeIds->map(function ($employeeId, $role) use ($training, $course) {
                    return new TrainingCourseAdministration([
                        'training_id' => $training->id,
                        'training_course_id' => $course->id,
                        'role' => $role,
                        'employee_id' => $employeeId,
                    ]);
                })
            );

            $employeeIds->filter(function ($employeeId) {
                return $employeeId > 0;
            })->each(function ($employeeId) use ($course) {
                $this->sendNotification($employeeId, $course);
            });

            return $administration;
        });
    }

    /**
     * @param $data
     * @return \Illuminate\Support\Collection
     */
    private function getRoleKeyedEmployeeIdCollection($data)
    {
        $admins = array();

        list('coordinator' => $admins['coordinator'],
            'director' => $admins['course_director'],
            'associate_director' => $admins['course_associate_director'],
            'assistant_director' => $admins['course_assistant_director'],
            ) = $data;

        return collect($admins);
    }

    /**
     * @return \Closure
     */
    function validEmployeeId(): \Closure
    {
        return function ($employeeId) {
            return !is_null($employeeId) && $employeeId > 0;
        };
    }

    private function sendNotification($recipient, $course, $sendMail = true)
    {
        $notificationType = NotificationType::where('name', NotificationTypeConstant::TMS_COURSE_ADMINISTRATION)
            ->firstOrFail();
        $employee = Employee::find($recipient);

        $user = $employee->user;

        if ($user) {
            $value = Notification::where([['ref_table_id', '=', $course->id], ['to_user_id', '=', $user->id]])->get();
            if (count($value) == null) {
                if ($user) {
                    $notification = Notification::create([
                        'type_id' => $notificationType->id,
                        'ref_table_id' => $course->id,
                        'from_user_id' => Auth::id(),
                        'to_user_id' => $user->id,
                        'message' => $course->name,
                        'item_url' => route('trainings.courses.administrations.show',
                            [$course->training_id, $course->id])
                    ]);

                    if ($sendMail) {
                        $this->sendEmail($user, $notification, $course);
                    }
                }
            }
        }
    }

    private function sendEmail($recipient, $notification, $course)
    {

        Mail::to($recipient->email)->send(
            new WorkflowEmailNotification(
                'TMS COURSE ADMINISTRATION',
                $notification->message,
                route('trainings.courses.administrations.show', [$course->training_id, $course->id])
            )
        );
    }
}
