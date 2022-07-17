<?php

namespace Modules\IMS\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\HRM\Entities\Department;

class Warehouse extends Model
{
    protected $fillable = ['name', 'department_id', 'date'];
    protected $table = 'warehouses';

    public function departments()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }
}
