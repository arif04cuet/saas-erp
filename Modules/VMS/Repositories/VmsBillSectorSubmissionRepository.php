<?php


namespace Modules\VMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Carbon\Carbon;
use Modules\HRM\Entities\Employee;
use Modules\VMS\Entities\VmsBillSectorSubmission;

class VmsBillSectorSubmissionRepository extends AbstractBaseRepository
{

    protected $modelName = VmsBillSectorSubmission::class;


    public function getSubmittedBillSectorOfMonth(Employee $employee, Carbon $date)
    {
        $currentMonthFirstDate = $date->startOfMonth()->format('Y-m-d');
        $currentMonthLastDate = $date->lastOfMonth()->format('Y-m-d');
        return $this->getModel()->newQuery()
            ->whereEmployeeId($employee->id)
            ->whereBetween('date', [$currentMonthFirstDate, $currentMonthLastDate])
            ->get();
    }
}
