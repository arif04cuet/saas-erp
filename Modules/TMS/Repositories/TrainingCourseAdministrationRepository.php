<?php
/**
 * Created by PhpStorm.
 * User: siaminflack
 * Date: 10/6/19
 * Time: 3:03 PM
 */

namespace Modules\TMS\Repositories;


use App\Repositories\AbstractBaseRepository;
use Modules\TMS\Entities\TrainingCourseAdministration;

class TrainingCourseAdministrationRepository extends AbstractBaseRepository
{
    protected $modelName = TrainingCourseAdministration::class;
}