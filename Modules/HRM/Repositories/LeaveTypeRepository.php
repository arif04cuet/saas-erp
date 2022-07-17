<?php

/**
 * Created by PhpStorm.
 * User: siaminflack
 * Date: 6/24/19
 * Time: 3:45 PM
 */

namespace Modules\HRM\Repositories;


use App\Repositories\AbstractBaseRepository;
use Modules\HRM\Constants\LeaveTypes;
use Modules\HRM\Entities\LeaveType;

class LeaveTypeRepository extends AbstractBaseRepository
{
    protected $modelName = LeaveType::class;


    public function getRestAndRecreationalLeave()
    {
        return $this->model->newQuery()->whereName(LeaveTypes::RestAndRecreationLeave)->first();
    }

    public function getAll()
    {
        return $this->model->all();
    }
}
