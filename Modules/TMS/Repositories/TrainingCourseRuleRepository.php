<?php
/**
 * Created by PhpStorm.
 * User: siaminflack
 * Date: 10/3/19
 * Time: 6:44 PM
 */

namespace Modules\TMS\Repositories;


use App\Repositories\AbstractBaseRepository;
use Modules\TMS\Entities\TrainingCourseRuleGuideline;

class TrainingCourseRuleRepository extends AbstractBaseRepository
{
    protected $modelName = TrainingCourseRuleGuideline::class;
}