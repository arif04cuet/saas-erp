<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;

class LeaveTypePurpose extends Model
{
    protected $fillable = ['leave_type_id', 'name', 'amount', 'maximum_allowed_days'];

    public function leaveType()
    {
        return $this->belongsTo(LeaveType::class, 'leave_type_id', 'id');
    }
}
