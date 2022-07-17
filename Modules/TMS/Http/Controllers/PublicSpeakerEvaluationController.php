<?php

namespace Modules\TMS\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Modules\TMS\Services\TraineeService;
use Modules\TMS\Services\TrainingsService;
use Modules\TMS\Entities\TrainingSpeakerAssessment;
use Modules\TMS\Entities\TrainingCourseModuleSession;

class PublicSpeakerEvaluationController extends Controller
{
    /**
     * @var TraineeService
     */
    private $traineeService;
    /**
     * @var TrainingsService
     */
    private $trainingsService;

    /**
     * TrainingPublicController constructor.
     * @param TraineeService $traineeService
     * @param TrainingsService $trainingsService
     */
    public function __construct(TraineeService $traineeService, TrainingsService $trainingsService)
    {
        $this->traineeService = $traineeService;
        $this->trainingsService = $trainingsService;
    }

    public function index()
    {
        return view('tms::training.public.index');
    }

    public function show(Request $request)
    {
        $mobileNo = $request->input('mobile-no');
        if (is_null($mobileNo)) {
            return 'Please provide the mobile number';
        }
        $isFoundTrainee = $this->traineeService->findBy(['mobile' => $mobileNo])->first();
        
        $traineeRecords = $this->traineeService->findBy(['mobile' => $mobileNo])
            ->flatMap(function ($trainee) {
                return $trainee->training->sessions()
                    ->filter(function ($session) {
                        // ignore the sessi if the speaker is set to (not_available for evaluation)
                        return optional($session->speaker)->should_be_evaluated ?? true;
                    })
                    ->map(function ($session) use ($trainee) {
                        return (object)[
                            'trainee_id' => $trainee->id,
                            'trainee_full_name' => $trainee->getFullName(),
                            'session_id' => $session->id,
                            'created_at' => $session->created_at,
                            'speaker_expire_timeline' => $session->speaker_expire_timeline,
                            'session_name' => $session->title,
                            'course_id' => Arr::get($session, 'module.course.id'),
                            'course_name' => Arr::get($session, 'module.course.name'),
                            'training_id' => Arr::get($session, 'module.course.training.id'),
                            'training_name' => Arr::get($session, 'module.course.training.title'),
                            'speaker_id' => $session->training_course_resource_id,
                            'speaker_name' => optional($session->speaker)->getResourceName(),
                            'module_name' => optional($session->module)->title,
                        ];
                    });
            })
            ->filter(function ($session) {
                $schedule = TrainingCourseModuleSession::find($session->session_id);
                $schedule = optional($schedule)->schedule;

                if (!$schedule) {
                    return false;
                }

                $sessionEndTime = Carbon::parse($schedule->end);
                $speakerExpireTimeline = Carbon::parse($schedule->end)->addHour($session->speaker_expire_timeline);
                // dd($sessionEndTime, Carbon::now());
                if ($sessionEndTime < now() && $speakerExpireTimeline >= now()) {
                    $alreadyAssessed = TrainingSpeakerAssessment::where('trainee_id', $session->trainee_id)
                        ->where('training_course_id', $session->course_id)
                        ->where('training_course_resource_id', $session->speaker_id)
                        ->where('training_course_module_session_id', $session->session_id)
                        ->exists();

                    return !$alreadyAssessed;
                }
                return false;
            })
            ->values();
        if ($traineeRecords->count()) {
            return view('tms::training.public.show', compact('traineeRecords'));
        } else {
            if (is_null($isFoundTrainee)) {
                return redirect()->back()->withErrors(['not_registered_trainee' => trans('error.not_registered_trainee')]);
            } else {
                return redirect()->back()->withErrors(['not_registered_trainee' => trans('error.no_session_left')]);
            }
        }

    }
}
