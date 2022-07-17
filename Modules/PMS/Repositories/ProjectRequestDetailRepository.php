<?php
/**
 * Created by PhpStorm.
 * User: tuhin
 * Date: 10/18/18
 * Time: 5:24 PM
 */

namespace Modules\PMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\PMS\Entities\ProjectRequestDetail;
use Modules\PMS\Entities\ProjectRequestForward;



class ProjectRequestDetailRepository extends AbstractBaseRepository
{
    protected $modelName = ProjectRequestDetail::class;
}