<?php

namespace Modules\TMS\Console;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Modules\HRM\Entities\Employee;
use Modules\TMS\Emails\ScheduledSessionCourseAdminEmail;
use Modules\TMS\Emails\ScheduledSessionSpeakerEmail;
use Modules\TMS\Entities\TrainingCourseScheduledSessionsSpeakerEmailRecipient;
use Modules\TMS\Services\TrainingCourseModuleBatchSessionScheduleService;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class SendScheduledSessionNotificationToCourseAdministration extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'send:session-schedules-to-course-administration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send all the session schedules to course administration as well';
    private $trainingCourseModuleBatchSessionScheduleService;
    private $recipients;
    private $tomorrow;
    private $schedules;

    /**
     * SendScheduledSessionNotificationToSpeakerEmail constructor.
     * @param TrainingCourseModuleBatchSessionScheduleService $trainingCourseModuleBatchSessionScheduleService
     */
    public function __construct(
        TrainingCourseModuleBatchSessionScheduleService $trainingCourseModuleBatchSessionScheduleService
    ) {
        parent::__construct();

        $this->trainingCourseModuleBatchSessionScheduleService = $trainingCourseModuleBatchSessionScheduleService;
    }


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Log::info('Emailing Schedule Session To Course Administration Has Started !');

        $this->tomorrow = Carbon::tomorrow();

        $this->schedules = $this->trainingCourseModuleBatchSessionScheduleService->schedules($this->tomorrow);

        $this->prepare();

        $this->send();

        Log::info('Emailing Schedule Session To Course Administration Has Ended !');
    }

    //--------------------------------- Private Method --------------------------------------------

    private function prepare()
    {
        $this->recipients = $this->schedules->each(function ($schedule) {
            $schedule->administrations = null;
            $training = null;
            try {
                $training = optional($schedule->session->module->course)->training;
            } catch (\Exception $exception) {
                $training = null;
            }
            if (!is_null($training)) {
                $schedule->administrations = $training->administrations;
            }
        })->pluck('administrations')->flatten()->unique('employee_id');
    }


    private function send()
    {
        if ($this->schedules->count() && $this->recipients->count()) {

            $this->schedules = $this->schedules->filter(function ($schedule) {
                return Carbon::parse($schedule->date)->greaterThanOrEqualTo($this->tomorrow);
            });
            $data = [];
            $this->schedules->each(function ($schedule) use (&$data) {
                if (!isset($data[optional($schedule->session->module->course)->id])) {
                    $data[optional($schedule->session->module->course)->id] = [];
                }
                $data[optional($schedule->session->module->course)->id][] = [
                    'course_name' => optional($schedule->session->module->course)->name,
                    'module_name' => optional($schedule->session->module)->title,
                    'session_name' => optional($schedule->session)->title,
                    'session_date' => Carbon::parse($schedule->date)->format('j F, Y'),
                    'session_start' => Carbon::parse($schedule->start)->format('h:i A'),
                    'session_end' => Carbon::parse($schedule->end)->format('h:i A'),
                    'speaker_name' => optional($schedule->session->speaker)->getResourceName(),
                    'venue_name' => optional($schedule->venue)->title,
                ];
            });
            foreach ($this->recipients as $administrator) {
                $employee = $administrator->employee;
                if (!is_null($employee) && $employee->email) {
                    $notify = $this->notify($employee, $data);
                }
            }
        }
    }

    private function notify($employee, $data)
    {
        try {
            Mail::to([$employee->email])
                ->send(new ScheduledSessionCourseAdminEmail(
                    $employee,
                    $data
                ));
            $mail = true;
        } catch (\Exception $e) {
            Log::error(get_class($this) . $e->getMessage() . ' :\n' . $e->getTraceAsString());
            $this->info($e->getMessage());
            $mail = false;
        }

        return $mail;
    }
}
