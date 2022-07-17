<?php


namespace Modules\HRM\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\HRM\Entities\EmployeeInterest;

class EmployeeInterestRepository extends AbstractBaseRepository 
{

    protected $modelName = EmployeeInterest::class;

    public function hasItemInList($interestId, $employeeId)
    {
        return $this->model->where('area_of_interest_id', $interestId)->where('employee_id', $employeeId)->count() ? true : false;
    }

    public function deleteIfItemNotInList($employeeId, $itemIds)
    {
        return $this->model->where('employee_id', $employeeId)->whereNotIn('area_of_interest_id', $itemIds)->delete();
    }


}
