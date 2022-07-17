<?php
/**
 * Created by PhpStorm.
 * User: artisan33
 * Date: 3/3/19
 * Time: 7:48 PM
 */

namespace Modules\PMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\PMS\Entities\ProjectTraining;

class ProjectTrainingRepository extends AbstractBaseRepository
{
    protected $modelName = ProjectTraining::class;
}