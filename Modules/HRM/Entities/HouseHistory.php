<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;

class HouseHistory extends Model
{
    protected $fillable = ['house_details_id', 'employee_id', 'from_date', 'to_date', 'status'];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }
}
