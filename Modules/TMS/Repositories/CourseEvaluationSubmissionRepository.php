<?php


namespace Modules\TMS\Repositories;


use App\Repositories\AbstractBaseRepository;
use Modules\TMS\Entities\CourseEvaluationSubmission;

class CourseEvaluationSubmissionRepository extends AbstractBaseRepository
{
    protected $modelName = CourseEvaluationSubmission::class;
}
