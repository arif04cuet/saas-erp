<?php
/**
 * Created by PhpStorm.
 * User: siaminflack
 * Date: 10/3/19
 * Time: 5:06 PM
 */

namespace Modules\TMS\Repositories;


use App\Repositories\AbstractBaseRepository;
use Modules\TMS\Entities\TrainingCourseMethodStrategy;

class TrainingCourseMethodRepository extends AbstractBaseRepository
{
    protected $modelName = TrainingCourseMethodStrategy::class;
}