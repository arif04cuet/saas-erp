<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;

class EmployeeSpouseChildrenInfo extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'type',
        'date_of_birth',
        'employee_id',
        'is_attestation_letter_submitted',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id')->withDefault();
    }
}
