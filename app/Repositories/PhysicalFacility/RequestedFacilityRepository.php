<?php
/**
 * Created by PhpStorm.
 * User: Shohag
 * Date: 4/14/20
 * Time: 9:02 PM
 */

namespace App\Repositories\Remark;

use App\Entities\RequestedFacility;
use App\Repositories\AbstractBaseRepository;

class RequestedFacilityRepository extends AbstractBaseRepository
{
    protected $modelName = RequestedFacility::class;
}
