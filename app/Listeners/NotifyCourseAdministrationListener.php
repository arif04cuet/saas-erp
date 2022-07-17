<?php

namespace App\Listeners;

use App\Events\NotifyCourseAdministration;
use App\Mail\SendCourseAdministrator;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Modules\HRM\Entities\Employee;
use Modules\HRM\Entities\MailNotification;
use Modules\TMS\Entities\Trainee;
use Modules\TMS\Entities\Training;
use Modules\TMS\Entities\TrainingCertificateLink;
use Modules\TMS\Entities\TrainingCourseAdministration;
use PHPUnit\Exception;

class NotifyCourseAdministrationListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param NotifyCourseAdministration $event
     * @return void
     */
    public function handle(NotifyCourseAdministration $event)
    {
        $trainingCourseAdministration = $event->trainingCourseAdministration;
        try {
            $this->sendEmailToAdministrators($trainingCourseAdministration);
        } catch (\Exception $exception) {
            Log::error('Course Administration Email Error ' . $exception->getMessage() . ' Trace: ' . $exception->getTraceAsString());
            Session::flash('error', 'Course Administration Email Error:  ' . $exception->getMessage());
        }
    }

    private function sendEmailToAdministrators(TrainingCourseAdministration $trainingCourseAdministration)
    {

        $employee = $trainingCourseAdministration->employee;
        $training = $trainingCourseAdministration->training;
        if (is_null($employee->user) or is_null($training)) {
            return;
        }
        // commenting out, direct email send as it slows down the request
        // redirecting to our running mail notification (Via Cron)
        //Mail::to($employee->email)->send(new SendCourseAdministrator($employee, $training));

        $this->sendMailNotification($training, $employee);
    }

    /**
     * @param Training $training
     * @param Employee $employee
     */
    public function sendMailNotification(Training $training, Employee $employee)
    {
        MailNotification::create([
            'email' => $employee->email,
            'title' => 'Course Administration Email Notification',
            'message' => 'Dear' . $employee->getName() . ', You Have Been Added As A Course Administrator For ' . $training->getTitle(),
            'item_url' => route('training.show', $training),
        ]);
    }

}
