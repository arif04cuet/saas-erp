<?php

namespace Modules\TMS\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\HRM\Entities\Employee;
use Modules\TMS\Entities\Trainee;
use Modules\TMS\Entities\TrainingCourseResource;

class ScheduledSessionCourseAdminEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $employee;
    private $data;

    /**
     * ScheduledSessionTraineeEmail constructor.
     * @param Employee $employee
     * @param array $data
     */
    public function __construct(Employee $employee, $data = [])
    {
        $this->employee = $employee;
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('tms::emails.session.schedule.course-administration.notification')
            ->with([
                'employee' => $this->employee,
                'data' => $this->data
            ]);
    }
}
