<?php

namespace Modules\TMS\Console;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Modules\TMS\Emails\CourseAdministrationsTraineeListEmail;
use Modules\TMS\Services\TraineeService;
use Modules\TMS\Services\TrainingCourseModuleBatchSessionScheduleService;
use Modules\TMS\Services\TrainingSpeakerAssessmentService;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class SendTraineeListToCourseAdministration extends Command
{
    private $today;
    private $yesterday;

    private $recipients;

    private $schedules;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'send:trainees-list-course-administrations';

    /**
     * The console command signature
     *
     * @var string
     */
    protected $signature = 'send:trainees-list-course-administrations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send trainees list to course administrations who haven\'t evaluated the sessions.';

    private $trainingCourseModuleBatchSessionScheduleService;

    private $trainingSpeakerAssessmentService;

    private $traineeService;

    /**
     * SendTraineeListToCourseAdministration constructor.
     * @param TrainingCourseModuleBatchSessionScheduleService $trainingCourseModuleBatchSessionScheduleService
     * @param TrainingSpeakerAssessmentService $trainingSpeakerAssessmentService
     * @param TraineeService $traineeService
     */
    public function __construct(
        TrainingCourseModuleBatchSessionScheduleService $trainingCourseModuleBatchSessionScheduleService,
        TrainingSpeakerAssessmentService $trainingSpeakerAssessmentService,
        TraineeService $traineeService
    ) {
        parent::__construct();

        $this->trainingCourseModuleBatchSessionScheduleService = $trainingCourseModuleBatchSessionScheduleService;
        $this->trainingSpeakerAssessmentService = $trainingSpeakerAssessmentService;
        $this->traineeService = $traineeService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->schedules = $this->trainingCourseModuleBatchSessionScheduleService->scheduledSessionsExpired();

        $this->today = Carbon::today('Asia/Dhaka');
        $this->yesterday = Carbon::yesterday('Asia/Dhaka');

        $this->schedules = $this->schedules->filter(function ($schedule) {
            $training = optional($schedule->session->module->course)->training;
            $scheduleEnd = Carbon::parse($schedule->end);
            $scheduledSessionExpiry = optional($schedule->session)->speaker_expire_timeline;

            $scheduleEnd->addHours($scheduledSessionExpiry);

            $notification = optional($schedule->notification)->status;

            if ($notification == "completed") {
                return false;
            }

            if ($training && Carbon::today()->addDays(2)->greaterThan(Carbon::parse($training->end_date))) {
                return false;
            }

            return $scheduleEnd->lessThan($this->today);

        });

        $this->prepare();

    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [];
    }

    private function prepare()
    {
        $this->schedules->each(function ($schedule) {

            $schedule->notification()->updateOrCreate([
                'training_course_module_batch_session_schedule_id' => $schedule->id
            ]);

            $this->recipients = $this->recipients($schedule);

            $trainees = optional($schedule->session->module->course->training)->trainee;

            if ($trainees) {
                $trainees = $trainees->pluck('id')->toArray();

                $traineesWhoDidEvaluation = $this->trainingSpeakerAssessmentService
                    ->findBy([
                        'training_course_module_session_id' => optional($schedule->session)->id
                    ])->pluck('trainee_id')
                    ->toArray();

                $traineesToBeWarned = array_diff($trainees, $traineesWhoDidEvaluation);

                $data = [];
                $data['training_name'] = optional($schedule->session->module->course->training)->title;
                $data['course_name'] = optional($schedule->session->module->course)->name;
                $data['module_name'] = optional($schedule->session->module)->title;
                $data['session_name'] = optional($schedule->session)->title;
                $data['session_date'] = Carbon::parse($schedule->date)->format('j F, Y');
                $data['session_start'] = Carbon::parse($schedule->start)->format('h:i A');
                $data['session_end'] = Carbon::parse($schedule->end)->format('h:i A');
                $data['speaker_name'] = optional($schedule->session->speaker)->getResourceName();
                $data['venue_name'] = optional($schedule->venue)->title;
                $data['trainees'] = [];

                collect(array_values($traineesToBeWarned))->each(function ($trainee) use (&$data) {
                    $trainee = $this->traineeService->findOne($trainee);

                    if ($trainee) {
                        $data['trainees'][] = $trainee;
                    }
                });

                $this->send($data);

                $schedule->notification()->update([
                    'status' => 'completed'
                ]);
            }
        });
    }

    private function recipients($schedule)
    {
        $course = optional($schedule->session->module)->course;

        $recipients = collect();

        if ($course) {
            $courseAdministrations = $course->administrations;

            $courseAdministrations->each(function ($administrator) use (&$recipients) {
                if ($administrator->employee) {
                    $recipients->push($administrator->employee);
                }
            });
        }

        return $recipients;
    }

    private function send($data)
    {
        $this->recipients->each(function ($recipient) use ($data) {

            $recipientEmail = optional($recipient)->email;

            if (!$recipientEmail) {
                $recipientEmail = optinal($recipient->user)->email;
            }

            if ($recipientEmail) {
                $email = $this->notify($recipientEmail, $recipient, $data);
            }
        });
    }

    private function notify($email, $recipient, $data)
    {
        try {

            Mail::to([$email])
                ->send(new CourseAdministrationsTraineeListEmail(
                        $recipient,
                        $data
                    )
                );

            $mail = true;

        } catch (\Exception $e) {

            Log::error(get_class($this) . $e->getMessage() . ' : \n' . $e->getTraceAsString());

            $this->info($e->getMessage());

            $mail = false;
        }

        return $mail;
    }
}
