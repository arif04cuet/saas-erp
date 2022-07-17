<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\IMS\Entities\InventoryLocation;
use App\Traits\DoptorAbleTrait;

class Department extends Model
{

    use DoptorAbleTrait;

    protected $table = "departments";
    protected $fillable = ['name', 'department_code'];


    public static function getDepartmentHeadRoleName()
    {
        return config('hrm.department_head_role_name');

    }

    public function inventoryLocations()
    {
        return $this->hasMany(InventoryLocation::class, 'department_id', 'id')->orderBy('created_at', 'desc');
    }

    public function employees()
    {
        return $this->hasMany(Employee::class, 'department_id', 'id');
    }

    public function sections()
    {
        return $this->hasMany(Section::class);
    }

    public function head()
    {
        return $this->hasOne(Employee::class, 'department_id', 'id')
            ->where('is_divisional_director', 1);
    }
}
