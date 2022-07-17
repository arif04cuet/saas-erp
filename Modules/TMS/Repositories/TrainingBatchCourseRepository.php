<?php
/**
 * Created by PhpStorm.
 * User: siaminflack
 * Date: 10/10/19
 * Time: 5:51 PM
 */

namespace Modules\TMS\Repositories;


use App\Repositories\AbstractBaseRepository;
use Modules\TMS\Entities\TrainingBatchCourse;

class TrainingBatchCourseRepository extends AbstractBaseRepository
{
    protected $modelName = TrainingBatchCourse::class;
}