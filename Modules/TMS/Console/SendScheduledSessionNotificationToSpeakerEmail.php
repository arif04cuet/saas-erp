<?php

namespace Modules\TMS\Console;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Modules\HRM\Entities\Employee;
use Modules\TMS\Emails\ScheduledSessionSpeakerEmail;
use Modules\TMS\Entities\TrainingCourseScheduledSessionsSpeakerEmailRecipient;
use Modules\TMS\Services\TrainingCourseModuleBatchSessionScheduleService;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class SendScheduledSessionNotificationToSpeakerEmail extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'send:session-schedule-speaker';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends Next day\'s scheduled sessions information to speaker.';

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
        Log::info('Emailing Schedule Session To Speakers Has Started !');

        $this->tomorrow = Carbon::tomorrow();

        $this->schedules = $this->trainingCourseModuleBatchSessionScheduleService->schedules($this->tomorrow);

        $this->prepare();

        $this->recipients();

        $this->send();

        Log::info('Emailing Schedule Session To Speakers Has Ended !');

    }

    private function prepare()
    {
        $this->schedules->each(function ($schedule) {
            $session = optional($schedule->session);
            $training = optional($schedule->session->module->course)->training;
            if ($session) {
                $speaker = $session->speaker;
                if ($speaker && Carbon::parse($training->end_date)->greaterThanOrEqualTo($this->tomorrow)) {
                    $recipient = TrainingCourseScheduledSessionsSpeakerEmailRecipient::updateOrCreate(
                        [
                            'training_course_resource_id' => $speaker->id,
                            'training_course_module_batch_session_schedule_id' => $schedule->id
                        ],
                        [
                            // if previous row exist, make the status pending again
                            'status' => 'pending'
                        ]
                    );
                }
            }
        });
    }

    private function recipients()
    {
        $this->recipients = TrainingCourseScheduledSessionsSpeakerEmailRecipient::select('training_course_resource_id')
            ->whereIn('status', ['pending', 'failed'])
            ->distinct('training_course_resource_id')
            ->get();

    }

    private function send()
    {
        $recipients = $this->recipients->chunk(100);
        if (isset($recipients[0])) {
            $recipients[0]->each(function ($recipient) {
                $resource = $recipient->resource;

                $schedules = $resource->schedules->filter(function ($schedule) {
                    return Carbon::parse(optional($schedule->schedule)->date)->greaterThanOrEqualTo($this->tomorrow);
                });

                if (!$schedules->count()) {
                    // if there is no schedules for this resource tomorrow, we can delete it
                    // otherwise this pending or failed rows will start piling up
                    $this->deleteRow($resource, $schedules);
                    return;
                }

                $data = [];

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
                        'venue_name' => optional($schedule->schedule->venue)->title,
                    ];
                });

                $notify = $this->notify($resource, $data);

                $schedules->each(function ($schedule) use ($notify) {
                    $update = $schedule->update(['status' => $notify ? 'completed' : 'failed']);
                });


            });
        }
    }

    private function notify($resource, $data)
    {
        $recipientType = get_class($resource->getResource());

        $recipient = $resource->getResource();

        if ($recipientType == Employee::class) {
            $recipient->email = optional($recipient->user)->email ?? $recipient->email;
        }

        try {
            Mail::to([$recipient->email])
                ->send(new ScheduledSessionSpeakerEmail(
                    $resource,
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

    private function deleteRow($resource)
    {
        return $resource->schedules()->delete();
    }

}
