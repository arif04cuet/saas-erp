<?php

namespace Modules\TMS\Console;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Modules\TMS\Emails\ScheduledSessionTraineeEmail;
use Modules\TMS\Entities\TrainingCourseScheduledSessionsTraineeEmailRecipient;
use Modules\TMS\Services\TrainingCourseModuleBatchSessionScheduleService;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class SendScheduledSessionNotificationToTraineeEmail extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'send:session-schedule-trainee';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends Next day\'s scheduled sessions information to trainee.';

    /**
     * @var TrainingCourseModuleBatchSessionScheduleService
     */
    protected $trainingCourseModuleBatchSessionScheduleService;

    /**
     * @var $schedules
     */
    private $schedules;
    private $recipients;

    private $tomorrow;

    /**
     * SendScheduledSessionNotificationToTraineeEmail constructor.
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
        Log::info('Emailing Schedule Session To Trainees Has Started !');

        $this->tomorrow = Carbon::tomorrow();

        $this->schedules = $this->trainingCourseModuleBatchSessionScheduleService->schedules($this->tomorrow);

        $this->prepare();

        $this->recipients();

        $this->send();

        Log::info('Emailing Schedule Session To Trainees Has Ended !');
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
        ];
    }

    private function prepare()
    {
        $this->schedules->each(function ($schedule) {
            $training = optional($schedule->session->module->course->training);
            if ($training && Carbon::parse($training->end_date)->greaterThanOrEqualTo($this->tomorrow)) {
                $trainees = $training->trainee;
                $trainees->each(function ($trainee) use ($schedule) {
                    $recipient = TrainingCourseScheduledSessionsTraineeEmailRecipient::updateOrCreate(
                        [
                            'trainee_id' => $trainee->id,
                            'training_course_module_batch_session_schedule_id' => $schedule->id
                        ],
                        [
                            'trainee_id' => $trainee->id,
                            'training_course_module_batch_session_schedule_id' => $schedule->id
                        ]
                    );
                });
            }
        });
    }

    private function recipients()
    {
        $this->recipients = TrainingCourseScheduledSessionsTraineeEmailRecipient::select('trainee_id')
            ->whereIn('status', ['pending', 'failed'])
            ->distinct('trainee_id')
            ->get(['trainee_id']);

    }

    private function send()
    {
        $recipients = $this->recipients->chunk(100);

        if (isset($recipients[0])) {
            $recipients[0]->each(function ($recipient) {
                $trainee = $recipient->trainee;
                if (is_null($trainee)) {
                    Log::error('Trainee Not Found WIth ID '. $recipient['trainee_id'] ?? 0);
                    return;
                }
                $schedules = $trainee->schedules->filter(function ($schedule) {
                    return Carbon::parse(optional($schedule->schedule)->date)->greaterThanOrEqualTo($this->tomorrow);
                });
                if (!$schedules->count()) {
                    Log::error('No schedules Found For this Trainee Id: '. $recipient['trainee_id'] ?? 0);
                    return;
                }

                $data = [];
                $course = collect();
                if ($schedules->count()) {
                    $course = optional($schedules->first()->schedule->session->module)->course;

                    $schedules->each(function ($schedule) use (&$data) {
                        if (!isset($data[optional($schedule->schedule->session->module->course)->id])) {
                            $data[optional($schedule->schedule->session->module->course)->id] = [];
                        }
                        $data[optional($schedule->schedule->session->module->course)->id][] = [
                            'course_name' => optional($schedule->schedule->session->module->course)->name,
                            'module_name' => optional($schedule->schedule->session->module)->title,
                            'session_name' => optional($schedule->schedule->session)->title,
                            'session_date' => Carbon::parse($schedule->schedule->date)->format('j F, Y'),
                            'session_start' => Carbon::parse($schedule->schedule->start)->format('h:i A'),
                            'session_end' => Carbon::parse($schedule->schedule->end)->format('h:i A'),
                            'speaker_name' => optional($schedule->schedule->session->speaker)->getResourceName(),
                            'venue_name' => optional($schedule->schedule->venue)->title,
                        ];
                    });
                    // Add the course break schedule
                    if ($course->count()) {
                        $recurringSchedules = $course->breaks;
                        if ($recurringSchedules->count()) {
                            $recurringSchedules->each(function ($recurringSchedule) use (&$data) {
                                $data[optional($recurringSchedule->course)->id][] = [
                                    'course_name' => optional($recurringSchedule->course)->name,
                                    'module_name' => trans('labels.not_applicable'),
                                    'session_name' => optional($recurringSchedule)->title,
                                    'session_date' => Carbon::parse($this->tomorrow)->format('j F, Y'),
                                    'session_start' => Carbon::parse($recurringSchedule->start_time)->format('h:i A'),
                                    'session_end' => Carbon::parse($recurringSchedule->end_time)->format('h:i A'),
                                    'speaker_name' => trans('labels.not_applicable'),
                                    'venue_name' => optional($recurringSchedule)->scheduledVenueTitle(),
                                ];
                            });
                        }
                    }

                }


                foreach ($data as $key => $datum) {
                    $data[$key] = $this->sortByScheduledTime($datum);
                }

                $notify = $this->notify($trainee, $data);

                // update schedule status
                $schedules->each(function ($schedule) use ($notify) {
                    $update = $schedule->update(['status' => $notify ? 'completed' : 'pending']);
                });
            });
        }
    }

    private function notify($recipient, $data)
    {
        try {

            Mail::to([$recipient->email])
                ->send(new ScheduledSessionTraineeEmail(
                    $recipient,
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

    private function sortByScheduledTime($data)
    {
        usort($data, [$this, 'compareByTime']);
        return $data;
    }

    private function compareByTime($a, $b)
    {
        $start_time['a'] = Carbon::createFromFormat('h:i A', $a['session_start']);
        $start_time['b'] = Carbon::createFromFormat('h:i A', $b['session_start']);
        $end_time['a'] = Carbon::createFromFormat('h:i A', $a['session_end']);
        $end_time['b'] = Carbon::createFromFormat('h:i A', $b['session_end']);

        return ($start_time['b']->lessThanOrEqualTo($start_time['a']) && $end_time['b']->lessThanOrEqualTo($end_time['a']));
    }
}
