<?php
/**
 * Created by PhpStorm.
 * User: BS100
 * Date: 10/22/2018
 * Time: 2:53 PM
 */

namespace Modules\HRM\Repositories;

use App\Repositories\AbstractBaseRepository;
use Illuminate\Support\Facades\DB;
use Modules\HRM\Entities\EmployeePersonalInfo;

class EmployeePersonalInfoRepository extends AbstractBaseRepository {
	protected $modelName = EmployeePersonalInfo::class;
}