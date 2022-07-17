<?php
/**
 * Created by PhpStorm.
 * User: BS100
 * Date: 11/5/2018
 * Time: 11:44 AM
 */

namespace Modules\HRM\Repositories;


use App\Repositories\AbstractBaseRepository;
use Modules\HRM\Entities\EmployeeResearchInfo;

class EmployeeResearchRepository extends AbstractBaseRepository {
protected $modelName = EmployeeResearchInfo::class;
}