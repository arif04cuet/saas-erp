<?php

namespace Modules\PMS\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\HRM\Entities\Employee;

class ProjectRequestReceiver extends Model
{
    protected $fillable = ['project_request_id', 'receiver'];

    protected $table = "project_request_receivers";

    public function employeeDetails() {
        return $this->belongsTo(Employee::class , 'receiver', 'id');
    }
}

