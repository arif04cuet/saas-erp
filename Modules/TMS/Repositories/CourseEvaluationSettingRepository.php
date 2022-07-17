<?php


namespace Modules\TMS\Repositories;


use App\Repositories\AbstractBaseRepository;
use Modules\TMS\Entities\CourseEvaluationSetting;

class CourseEvaluationSettingRepository extends AbstractBaseRepository
{
    protected $modelName = CourseEvaluationSetting::class;
}
