<?php

namespace Modules\RMS\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\HRM\Entities\Employee;

class ResearchRequestReceiver extends Model
{
    protected $table = 'research_request_receivers';
    protected $fillable = ['to', 'research_request_id'];

    public function employeeDetails() {
        return $this->belongsTo(Employee::class , 'to', 'id');
    }
}
