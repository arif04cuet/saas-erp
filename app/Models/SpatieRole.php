<?php

namespace App\Models;

use App\Models\Module;
use App\Traits\DoptorAbleTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class SpatieRole extends Role
{
    use DoptorAbleTrait;

    public function doptor()
    {
        return $this->belongsTo(Doptor::class);
    }

    public static function defaultRoles()
    {

        return [
            'ROLE_DIRECTOR_GENERAL',
            'ROLE_DIRECTOR_ADMIN',
            'ROLE_DIRECTOR_TRAINING',
            'ROLE_HOSTEL_MANAGER',
            'ROLE_RESEARCH_DIRECTOR',
            'ROLE_FACULTY',
            'ROLE_PROJECT_DIRECTOR',
            'ROLE_DIRECTOR_PROJECT',
            'ROLE_DEPARTMENT_HEAD',
            'ROLE_INVENTORY_REQUEST_SHARE',
            'ROLE_INVENTORY_REQUEST_APPROVE',
            'ROLE_INVENTORY_REQUEST_REJECT',
            'ROLE_INVENTORY_REQUEST_RECEIVE',
            'ROLE_INVENTORY_USER',
            'ROLE_CAFETERIA_MANAGER',
            'ROLE_VMS_LINE_MANAGER',
            'ROLE_VMS_MECHANIC',
            'ROLE_DOCTOR',
            'ROLE_HRM_SECTION_OFFICER',
            'ROLE_SUPER_ADMIN',
            'DOPTOR_SUPER_ADMIN',
        ];
    }
}
