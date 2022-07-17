<?php

namespace Modules\TMS\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Modules\TMS\Entities\CourseEvaluationSetting;
use Modules\TMS\Repositories\CourseEvaluationSettingRepository;

class CheckCourseEvaluationExpiry
{
    private $course_id;
    private $courseEvaluationSettingRepository;

    public function __construct(
        CourseEvaluationSettingRepository $courseEvaluationSettingRepository
    )
    {
        $this->courseEvaluationSettingRepository = $courseEvaluationSettingRepository;
    }

    /**
     * @param Request $request
     * @param Closure $next
     * @param string $course
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function handle(
        Request $request,
        Closure $next,
        string $course
    )
    {
        $this->course_id = optional($request->$course)->id;

        return $this->checkExpiry() ? $next($request) : redirect()->route('courses.public.index');
    }

    private function checkExpiry()
    {
        $setting = $this->courseEvaluationSettingRepository->findBy([
            'training_course_id' => $this->course_id
        ])->first();

        if($setting) {
            if($setting->status) {
                $startDate = Carbon::parse($setting->start_date);
                $endDate = Carbon::parse($setting->end_date);
                $today = Carbon::today('Asia/Dhaka');

                if($today->greaterThanOrEqualTo($startDate) && $today->lessThanOrEqualTo($endDate)) {
                    return true;
                }
            }
        }

        return false;
    }
}
