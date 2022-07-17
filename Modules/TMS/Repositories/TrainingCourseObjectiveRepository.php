<?php
/**
 * Created by PhpStorm.
 * User: siaminflack
 * Date: 10/3/19
 * Time: 3:13 PM
 */

namespace Modules\TMS\Repositories;


use App\Repositories\AbstractBaseRepository;
use Modules\TMS\Entities\TrainingCourseObjective;

class TrainingCourseObjectiveRepository extends AbstractBaseRepository
{
    protected $modelName = TrainingCourseObjective::class;
}