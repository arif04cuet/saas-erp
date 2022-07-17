<?php

namespace Modules\IMS\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\HRM\Entities\Department;
use Modules\HRM\Entities\Employee;
use Modules\HRM\Entities\Section;

class InventoryLocation extends Model
{
    protected $fillable = ['name', 'department_id', 'type', 'section_id', 'description', 'admin'];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function inventories()
    {
        return $this->hasMany(Inventory::class, 'location_id', 'id');
    }

    public function getName()
    {
        return $this->name . (is_numeric($this->department_id) ? ' - ' . $this->department->name : '');
    }

    public function adminEmployee()
    {
        return $this->belongsTo(Employee::class, 'admin', 'id')->withDefault();
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id', 'id')->withDefault();
    }

}
