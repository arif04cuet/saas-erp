<?php

namespace Modules\TMS\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Modules\TMS\Entities\Trainee;
use Modules\TMS\Entities\TrainingCourse;
use Modules\TMS\Entities\TrainingCourseModuleBatchSessionSchedule;
use Modules\TMS\Entities\TrainingCourseModuleSession;
use Modules\TMS\Entities\TrainingCourseResource;

class CheckSessionEvaluationExpiry
{
    private $session_id;
    private $trainee_id;
    private $speaker_id;

    /**
     * @param Request $request
     * @param Closure $next
     * @param string $course
     * @param string $session
     * @param string $speaker
     * @param string $trainee
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function handle(
        Request $request,
        Closure $next,
        string $course,
        string $session,
        string $speaker,
        string $trainee
    )
    {
        if ($request->method() == "GET") {
            if ($request->$session) {
                $this->session_id = $request->$session->id;
            } else {
                $this->session_id = null;
            }

            if ($request->$speaker) {
                $this->speaker_id = $request->$speaker->id;
            } else {
                $this->speaker_id = null;
            }

            if ($request->$trainee) {
                $this->trainee_id = $request->$trainee->id;
            } else {
                $this->trainee_id = null;
            }

        } else {
            $this->trainee_id = $request->trainee_id;
            $this->speaker_id = $request->training_course_resource_id;
            $this->session_id = $request->training_course_module_session_id;
        }

        if (!is_null($this->session_id) && !is_null($this->speaker_id) && !is_null($this->trainee_id)) {
            $schedule = TrainingCourseModuleBatchSessionSchedule::where(
                'training_course_module_session_id',
                $this->session_id
            )->first();

            if ($schedule) {
                $session = TrainingCourseModuleSession::where('id', $this->session_id)
                    ->where('training_course_resource_id', $this->speaker_id)
                    ->first();
                if($session) {
                    if (Carbon::now() <= Carbon::parse($schedule->end)->addHours($session->speaker_expire_timeline) && Carbon::now() >= Carbon::parse($schedule->end)) {
                        return $next($request);
                    } else {
                        return redirect()->route('trainings.public.index');
                    }

                }else {
                    return redirect()->route('trainings.public.index');
                }
            } else {
                return redirect()->route('trainings.public.index');
            }
        } else {
            return redirect()->route('trainings.public.index');
        }

    }
}
