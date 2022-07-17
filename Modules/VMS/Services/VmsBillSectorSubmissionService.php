<?php

namespace Modules\VMS\Services;

use App\Traits\CrudTrait;
use Carbon\Carbon;
use Modules\HRM\Entities\Employee;
use Modules\VMS\Repositories\VmsBillSectorSubmissionRepository;

class VmsBillSectorSubmissionService
{
    use CrudTrait;

    public function __construct(VmsBillSectorSubmissionRepository $vmsBillSectorSubmissionRepository)
    {
        $this->actionRepository = $vmsBillSectorSubmissionRepository;
    }

    public function calculatePendingFixedAmountOfEmployee(Employee $employee, Carbon $date)
    {
        $pendingBillSectors = $this->getPendingBillSectorOfEmployee($employee, $date);
        $totalBill = 0;
        $masterData = [];
        $data = [];
        foreach ($pendingBillSectors as $pendingBillSector) {
            $data['vms_bill_sector_id'] = $pendingBillSector->vms_bill_sector_id;
            $data['fixed_bill'] = optional($pendingBillSector->vmsBillSector)->amount ?? 0;
            $masterData[] = $data;
            $totalBill += $data['fixed_bill'];
        }
        $masterData['details'] = $masterData;
        $masterData['pending_fixed_bill'] = $totalBill;
        return $masterData;


    }

    public function getPendingBillSectorOfEmployee(Employee $employee, Carbon $date)
    {
        $assignedSectors = $employee->vmsBillSectorAssigns;
        $submittedSectors = $this->actionRepository->getSubmittedBillSectorOfMonth($employee, $date);
        $submittedSectorsId = $submittedSectors->pluck('vms_bill_sector_id');
        return $assignedSectors->filter(function ($assignedSector) use ($submittedSectorsId) {
            return !in_array($assignedSector->vms_bill_sector_id, $submittedSectorsId->toArray());
        });
    }
}

