<?php
/**
 * Created by PhpStorm.
 * User: artisan33
 * Date: 1/27/19
 * Time: 12:09 PM
 */
namespace Modules\PMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\PMS\Entities\Project;

class ProjectRepository extends AbstractBaseRepository
{
    protected $modelName = Project::class;
}