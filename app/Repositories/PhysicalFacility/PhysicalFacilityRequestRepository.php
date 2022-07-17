<?php
/**
 * Created by PhpStorm.
 * User: Shohag
 * Date: 4/14/20
 * Time: 9:05 PM
 */

namespace App\Repositories\Remark;

use App\Entities\PhysicalFacilityRequest;
use App\Repositories\AbstractBaseRepository;

class PhysicalFacilityRequestRepository extends AbstractBaseRepository
{
    protected $modelName = PhysicalFacilityRequest::class;
}
