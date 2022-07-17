<?php
/**
 * Created by PhpStorm.
 * User: tuhin
 * Date: 10/28/18
 * Time: 6:27 PM
 */

namespace Modules\PMS\Repositories;


use App\Repositories\AbstractBaseRepository;
use App\Traits\CrudTrait;
use Modules\PMS\Entities\ProjectRequestForward;

class ProjectRequestForwardRepository extends AbstractBaseRepository
{
    protected $modelName = ProjectRequestForward::class;
}