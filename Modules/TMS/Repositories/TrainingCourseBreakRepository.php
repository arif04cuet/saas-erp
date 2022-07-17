<?php
/**
 * Created by PhpStorm.
 * User: siaminflack
 * Date: 10/6/19
 * Time: 11:36 AM
 */

namespace Modules\TMS\Repositories;


use App\Repositories\AbstractBaseRepository;
use Modules\TMS\Entities\TrainingCourseBreak;

class TrainingCourseBreakRepository extends AbstractBaseRepository
{
    protected $modelName = TrainingCourseBreak::class;
}