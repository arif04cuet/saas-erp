<?php

namespace Modules\TMS\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Modules\TMS\Entities\TrainingCourseModuleBatchSessionSchedule;
use Modules\TMS\Entities\TrainingCourseModuleSession;
use Modules\TMS\Entities\TrainingSpeakerAssessment;

class CheckSessionIsEvaluated
{
    private $trainee_id;
    private $session_id;
    private $speaker_id;
    private $course_id;

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
        if($request->method() == "GET") {
            if($request->$session) {
                $this->session_id = $request->$session->id;
            }else {
                $this->session_id = null;
            }

            if($request->$speaker) {
                $this->speaker_id = $request->$speaker->id;
            }else {
                $this->speaker_id = null;
            }

            if($request->$trainee) {
                $this->trainee_id = $request->$trainee->id;
            }else {
                $this->trainee_id = null;
            }

            if($request->$course) {
                $this->course_id = $request->$course->id;
            }else {
                $this->course_id = null;
            }

        }else {
            $this->course_id = $request->training_course_id;
            $this->trainee_id = $request->trainee_id;
            $this->speaker_id = $request->training_course_resource_id;
            $this->session_id = $request->training_course_module_session_id;
        }

        if(!is_null($this->course_id) && !is_null($this->session_id) && !is_null($this->speaker_id) && !is_null($this->trainee_id)) {
            $assessment = TrainingSpeakerAssessment::where('training_course_id', $this->course_id)
                ->where('training_course_module_session_id', $this->session_id)
                ->where('training_course_resource_id', $this->speaker_id)
                ->where('trainee_id', $this->trainee_id)
                ->first();

            if(is_null($assessment)) {
                return $next($request);
            }else {
                return redirect()->route('trainings.public.index');
            }
        }else {
            return redirect()->route('trainings.public.index');
        }
    }
}
