<?php

namespace Modules\TMS\Services;

use App\Constants\NotificationType as NotificationTypeConstant;
use App\Entities\Notification\Notification;
use App\Entities\Notification\NotificationType;
use App\Mail\WorkflowEmailNotification;
use App\Traits\CrudTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Modules\HRM\Entities\Employee;
use Modules\TMS\Entities\Training;
use Modules\TMS\Entities\TrainingCourse;
use Modules\TMS\Entities\TrainingCourseAdministration;
use Modules\TMS\Repositories\TrainingAdministrationRepository;
use Modules\TMS\Repositories\TrainingCourseAdministrationRepository;

class TrainingAdministrationService
{
    use CrudTrait;

    /**
     * @var TrainingAdministrationRepository
     */
    private $repository;

    /**
     * TrainingCourseAdministrationService constructor.
     * @param TrainingAdministrationRepository $repository
     */
    public function __construct(TrainingAdministrationRepository $repository)
    {
        $this->repository = $repository;
        $this->setActionRepository($repository);
    }

    public function updateRequest(Training $training, array $data)
    {
        return DB::transaction(function () use ($training, $data) {

            $training->administrations()->delete();
            $employeeIds = $this->getRoleKeyedEmployeeIdCollection($data)
                ->filter($this->validEmployeeId());
            $administration = $training->administrations()->saveMany(
                $employeeIds->map(function ($employeeId, $role) {
                    return new TrainingCourseAdministration([
                        'role' => $role,
                        'employee_id' => $employeeId,
                    ]);
                })
            );

            $employeeIds->filter(function ($employeeId) {
                return $employeeId > 0;
            })->each(function ($employeeId) use ($training) {
                // dd($training);
                $this->sendNotification($employeeId, $training, false);
            });
            // dd($administration);
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

        list(
            'coordinator' => $admins['coordinator'],
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
                        'message' => $course->title ?? trans('Training Administration Request'),
                        'item_url' => route(
                            'trainings.administrations.show',
                            [$course->id]
                        )
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
