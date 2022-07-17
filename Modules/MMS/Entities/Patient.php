<?php

namespace Modules\MMS\Entities;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = ['patient_id', 'name', 'age', 'mobile_no', 'gender', 'relation', 'type', 'employee_id'];
}
