<?php


namespace Modules\TMS\Repositories;


use App\Repositories\AbstractBaseRepository;
use Modules\TMS\Entities\TrainingCourseModule;
use DB;
class TrainingCourseModuleRepository extends AbstractBaseRepository
{
    protected $modelName = TrainingCourseModule::class;
    public function getModelByTrainingCourseId($id)
    {
        $data = TrainingCourseModule::where('training_course_id',$id)->get()->toarray();
        $modules = [];

        foreach ($data as $key => $value) {
            $is_session_axist = DB::table('training_course_module_sessions')->where('training_course_module_id',$value['id'])->count();
            if($is_session_axist){
                $modules[] = $value;
            }
        }

        return $modules;
    }

}
