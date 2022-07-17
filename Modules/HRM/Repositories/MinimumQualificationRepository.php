<?php
/**
 * Created by PhpStorm.
 * User: artisan33
 * Date: 9/1/19
 * Time: 5:11 PM
 */

namespace Modules\HRM\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\HRM\Entities\JobCircularQualificationRule;

class MinimumQualificationRepository extends AbstractBaseRepository
{
    protected $modelName = JobCircularQualificationRule::class;
}