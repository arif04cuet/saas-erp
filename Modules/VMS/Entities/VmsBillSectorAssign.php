<?php

namespace Modules\VMS\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\HRM\Entities\Employee;

class VmsBillSectorAssign extends Model
{
    protected $fillable = [
        'employee_id',
        'vms_bill_sector_id'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id')
            ->withDefault();
    }

    public function vmsBillSector()
    {
        return $this->belongsTo(VmsBillSector::class, 'vms_bill_sector_id', 'id')
            ->withDefault();
    }

}
