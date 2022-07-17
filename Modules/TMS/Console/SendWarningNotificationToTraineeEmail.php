<?php

namespace Modules\TMS\Console;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Modules\TMS\Emails\SessionEvaluationTraineeWarningEmail;
use Modules\TMS\Entities\Trainee;
use Modules\TMS\Entities\TrainingCourse;
use Modules\TMS\Entities\TrainingCourseModuleSession;
use Modules\TMS\Entities\TrainingCourseResource;
use Modules\TMS\Services\TraineeService;
use Modules\TMS\Services\TrainingCourseModuleBatchSessionScheduleService;
use Modules\TMS\Services\TrainingCourseSessionsEvaluationTraineeWarningEmailRecipientService;
use Modules\TMS\Services\TrainingSpeakerAssessmentService;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class SendWarningNotificationToTraineeEmail extends Command
{
    private $now;

    private $recipients;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'send:assessment-warning-trainee';

    /**
     * The console command signature
     *
     * @var string
     */
    protected $signature = 'send:assessment-warning-trainee {recipients?}';

    /**
     * The console command description.
     *
     * @var string
     */

    protected $description = 'Sends Warning Notification Email to Trainees who haven\'t completed speaker evaluation.';

    private $trainingCourseModuleBatchSessionScheduleService;

    private $trainingSpeakerAssessmentService;

    private $trainingCourseSessionsEvaluationTraineeWarningEmailRecipientService;

    private $traineeService;

    /**
     * SendWarningNotificationToTraineeEmail constructor.
     * @param TrainingCourseModuleBatchSessionScheduleService $trainingCourseModuleBatchSessionScheduleService
     * @param TrainingSpeakerAssessmentService $trainingSpeakerAssessmentService
     * @param TrainingCourseSessionsEvaluationTraineeWarningEmailRecipientService $trainingCourseSessionsEvaluationTraineeWarningEmailRecipientService
     * @param TraineeService $traineeService
     */
    public function __construct(
        TrainingCourseModuleBatchSessionScheduleService $trainingCourseModuleBatchSessionScheduleService,
        TrainingSpeakerAssessmentService $trainingSpeakerAssessmentService,
        TrainingCourseSessionsEvaluationTraineeWarningEmailRecipientService $trainingCourseSessionsEvaluationTraineeWarningEmailRecipientService,
        TraineeService $traineeService
    ) {
        parent::__construct();

        $this->trainingCourseModuleBatchSessionScheduleService = $trainingCourseModuleBatchSessionScheduleService;
        $this->trainingSpeakerAssessmentService = $trainingSpeakerAssessmentService;
        $this->trainingCourseSessionsEvaluationTraineeWarningEmailRecipientService = $trainingCourseSessionsEvaluationTraineeWarningEmailRecipientService;
        $this->traineeService = $traineeService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if ($this->argument('recipients')) {

            $scheduledSessions = $this->trainingCourseModuleBatchSessionScheduleService->scheduledSessionsAboutToExpire();

            $scheduledSessions = $scheduledSessions->filter(function ($scheduledSession) {

                $scheduleEnd = Carbon::parse($scheduledSession->end);

                $scheduledSessionExpiry = optional($scheduledSession->session)->speaker_expire_timeline;

                $scheduleEnd->addHours($scheduledSessionExpiry);

                $isValid = $this->checkValidity($scheduleEnd);

//                dump($isValid);

                if ($isValid) {
                    $this->update($scheduledSession);
                }
            });
        } else {

            $this->prepare();

            $this->send();
        }

    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            $this->argument('recipients')
        ];
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

    private function checkValidity(Carbon $scheduleEndTime)
    {
        $configurations = config('training.course.module.session.schedule.email');
        $warningBeforeExpireHour = $configurations['trainee_evaluation_warning']['fetch_recipients']['hour_before_expire'];
        $this->now = Carbon::now('Asia/Dhaka');
        return ($scheduleEndTime > $this->now && $scheduleEndTime->diffInHours($this->now) <= $warningBeforeExpireHour);

    }

    private function update($scheduledSession)
    {
        $trainees = optional($scheduledSession->session->module->course->training)->trainee;

        if ($trainees) {
            $trainees = $trainees->pluck('id')->toArray();

            $traineesWhoDidEvaluation = $this->trainingSpeakerAssessmentService->findBy([
                'training_course_module_session_id' => optional($scheduledSession->session)->id
            ])->pluck('trainee_id')
                ->toArray();

            $traineesToBeWarned = array_diff($trainees, $traineesWhoDidEvaluation);

            collect($traineesToBeWarned)->each(function ($trainee) use ($scheduledSession) {

                $traineeToBeWarned = $this->trainingCourseSessionsEvaluationTraineeWarningEmailRecipientService->updateOrStore([
                    'trainee_id' => $trainee,
                    'training_course_module_batch_session_schedule_id' => $scheduledSession->id
                ]);
            });
        }
    }

    private function prepare()
    {
        $this->recipients();
    }

    private function recipients()
    {
        $this->recipients = $this->trainingCourseSessionsEvaluationTraineeWarningEmailRecipientService
            ->findBy([
                'status' => 'pending,failed'
            ]);
    }

    private function send()
    {
        $trainees = $this->recipients->groupBy('trainee_id');


        $trainees = $trainees->chunk(100);

        if (isset($trainees[0])) {

            $trainees[0]->each(function ($trainee, $iterator) {

                $data = [];

                $trainee->each(function ($schedule, $index) use ($iterator, &$data) {
                    if (!isset($data[optional($schedule->schedule->session->module->course)->id])) {
                        $data[optional($schedule->schedule->session->module->course)->id] = [];
                    }

                    $scheduleEnd = Carbon::parse(optional($schedule->schedule)->end);

                    $scheduledSessionExpiry = optional($schedule->schedule->session)->speaker_expire_timeline;

                    $scheduleEnd->addHours($scheduledSessionExpiry);

                    if ($this->checkValidity($scheduleEnd)) {

                        $traineeToAssess = $this->traineeService->findOne($iterator);
                        $data[optional($schedule->schedule->session->module->course)->id][] = [
                            'course_name' => optional($schedule->schedule->session->module->course)->name,
                            'module_name' => optional($schedule->schedule->session->module)->title,
                            'session_name' => optional($schedule->schedule->session)->title,
                            'session_date' => Carbon::parse(optional($schedule->schedule)->date)->format('F j, Y'),
                            'session_start' => Carbon::parse(optional($schedule->schedule)->start)->format('h:i A'),
                            'session_end' => Carbon::parse(optional($schedule->schedule)->end)->format('h:i A'),
                            'speaker_name' => optional($schedule->schedule->session->speaker)->getResourceName(),
                            'venue_name' => optional($schedule->schedule->venue)->title,
                            'evaluation_expiry' => Carbon::parse($scheduleEnd)->format('F j, Y h:i A'),
                            'evaluation_url' => $this->evaluationUrl(
                                optional($schedule->schedule->session->module)->course,
                                optional($schedule->schedule)->session,
                                optional($schedule->schedule->session)->speaker,
                                $traineeToAssess
                            ),
                        ];

                        $schedule->update(['status' => 'completed']);
                    } else {
                        $schedule->delete();
                    }

                });

                $this->notify($iterator, $data);

            });
        }
    }

    private function notify($trainee, $data)
    {
        $data = $this->verify($data);

        $trainee = $this->traineeService->findOne($trainee);

        if (!$data === false && !empty($data)) {
            try {

                Mail::to([$trainee->email])
                    ->send(new SessionEvaluationTraineeWarningEmail(
                        $trainee,
                        $data
                    ));

                $mail = true;

            } catch (\Exception $e) {
                Log::error(get_class($this) . $e->getMessage() . ' : \n' . $e->getTraceAsString());

                $mail = false;
            }
        }

    }

    private function evaluationUrl(
        TrainingCourse $course,
        TrainingCourseModuleSession $session,
        TrainingCourseResource $speaker,
        Trainee $trainee
    ) {
        return route('public.speakers.evaluations.create', [
            $course,
            $session,
            $speaker,
            $trainee
        ]);

    }

    private function verify($data)
    {
        if (!is_array($data)) {
            return false;
        }

        foreach ($data as $key => $content) {
            if (empty($content)) {
                unset($data[$key]);
            }
        }

        return $data;
    }
}
