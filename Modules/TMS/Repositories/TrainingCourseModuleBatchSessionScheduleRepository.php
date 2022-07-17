<?php


namespace Modules\TMS\Repositories;


use App\Repositories\AbstractBaseRepository;
use Modules\TMS\Entities\TrainingCourseModuleBatchSessionSchedule;
use DB;

class TrainingCourseModuleBatchSessionScheduleRepository extends AbstractBaseRepository
{
    protected $modelName = TrainingCourseModuleBatchSessionSchedule::class;

    public function getFilterData()
    {
        $data = DB::table('training_course_module_batch_session_schedules as schedules')
            ->join('training_course_module_sessions as sessions', 'sessions.id', '=',
                'schedules.training_course_module_session_id')
            ->join('training_course_batches as batches', 'batches.id', '=', 'schedules.training_course_batch_id')
            ->join('training_course_modules as modules', 'modules.id', '=', 'sessions.training_course_module_id')
            ->join('training_courses as courses', 'courses.id', '=', 'modules.training_course_id')
            ->join('trainings as trainings', 'trainings.id', '=', 'courses.training_id')
            ->select(

                'trainings.id as training_id',
                'trainings.title as training_title',

                'courses.id as course_id',
                'courses.name as course_title',

                'modules.id as module_id',
                'modules.title as module_title',

                'sessions.id as session_id',
                'sessions.title as session_title',

                'batches.id as batch_id',
                'batches.title as batch_title',
                'batches.start_date as batch_start',
                'batches.end_date as batch_end',

                'schedules.id as scheduled_id',
                'schedules.status as scheduled_status'

            )->get()->all();
        return $data;
    }

    public function getSchedulesBySession(array $sessions)
    {
        return $this->getModel()::whereIn('training_course_module_session_id', $sessions)->get();

    }


}
