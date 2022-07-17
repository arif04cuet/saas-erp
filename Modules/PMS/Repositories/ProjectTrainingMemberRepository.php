<?php
/**
 * Created by PhpStorm.
 * User: artisan33
 * Date: 3/6/19
 * Time: 4:12 PM
 */

namespace Modules\PMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\PMS\Entities\ProjectTrainingMember;

class ProjectTrainingMemberRepository extends AbstractBaseRepository
{
    protected $modelName = ProjectTrainingMember::class;
}