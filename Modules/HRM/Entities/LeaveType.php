<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
    protected $fillable = ['amount', 'maximum_allowed_days'];

    public function purposes()
    {
        return $this->hasMany(LeaveTypePurpose::class, 'leave_type_id', 'id');
    }
}
