<?php

namespace Modules\VMS\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\HRM\Entities\Employee;

class VmsBillSectorSubmission extends Model
{
    protected $fillable = [
        'date',
        'vms_bill_sector_id',
        'employee_id',
        'amount'
    ];

    protected $dates = ['date'];

    public function vmsBillSector()
    {
        return $this->belongsTo(VmsBillSector::class, 'vms_bill_sector_id')
            ->withDefault();
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id')->withDefault();
    }

}
