<?php
/**
 * Created by PhpStorm.
 * User: BS100
 * Date: 10/28/2018
 * Time: 5:39 PM
 */

namespace Modules\HRM\Repositories;


use App\Repositories\AbstractBaseRepository;
use Modules\HRM\Entities\Department;

class DepartmentRepository extends AbstractBaseRepository
{
    protected $modelName = Department::class;

    public function getDepartmentByCode($departmentCode)
    {
        return $this->model->newQuery()->whereDepartmentCode($departmentCode)->first();
    }

}
