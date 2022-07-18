<?php

namespace App\Models;

use App\Models\Module;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class SpatiePermission extends Permission
{
    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public static function allPermissions()
    {
        return [
            [
                'name' => 'hrm-user-access',
                'label' => 'hrm-user-access',
                'module' => 'hrm',
            ],
            [
                'name' => 'beneficiary_dashboard',
                'label' => 'Beneficiary dashboard',
                'module' => 'hrm',
            ],
            [
                'name' => 'impersonate_users',
                'label' => 'Impersonate User',
                'module' => 'hrm',
            ],

            [
                'name' => 'view_users',
                'label' => 'List User',
                'module' => 'hrm',
            ],

            [
                'name' => 'add_users',
                'label' => 'Create User',
                'module' => 'hrm',
            ],

            [
                'name' => 'update_users',
                'label' => 'Update User',
                'module' => 'hrm',
            ],

            [
                'name' => 'delete_users',
                'label' => 'Delete User',
                'module' => 'hrm',
            ],

            [
                'name' => 'view_roles',
                'label' => 'Role List',
                'module' => 'hrm',
            ],

            [
                'name' => 'add_roles',
                'label' => 'Create Role',
                'module' => 'hrm',
            ],

            [
                'name' => 'update_roles',
                'label' => 'Update Role',
                'module' => 'hrm',
            ],

            [
                'name' => 'delete_roles',
                'label' => 'Delete Role',
                'module' => 'hrm',
            ],

            [
                'name' => 'view_permissions',
                'label' => 'List Permission',
                'module' => 'hrm',
            ],

            [
                'name' => 'add_permissions',
                'label' => 'Create Permission',
                'module' => 'hrm',
            ],

            [
                'name' => 'update_permissions',
                'label' => 'Update Permission',
                'module' => 'hrm',
            ],

            [
                'name' => 'delete_permissions',
                'label' => 'Delete Permission',
                'module' => 'hrm',
            ],

            [
                'name' => 'view_modules',
                'label' => 'List Module',
                'module' => 'hrm',
            ],

            [
                'name' => 'add_modules',
                'label' => 'Create Module',
                'module' => 'hrm',
            ],

            [
                'name' => 'update_modules',
                'label' => 'Update Module',
                'module' => 'hrm',
            ],

            [
                'name' => 'delete_modules',
                'label' => 'Delete Module',
                'module' => 'hrm',
            ],

            [
                'name' => 'view_trainings',
                'label' => 'List Training',
                'module' => 'tms',
            ],

            [
                'name' => 'add_trainings',
                'label' => 'Create Training',
                'module' => 'tms',
            ],

            [
                'name' => 'update_trainings',
                'label' => 'Update Training',
                'module' => 'tms',
            ],

            [
                'name' => 'delete_trainings',
                'label' => 'Delete Training',
                'module' => 'tms',
            ],

            [
                'name' => 'view_training_courses',
                'label' => 'List Course',
                'module' => 'tms',
            ],

            [
                'name' => 'add_training_courses',
                'label' => 'Create Course',
                'module' => 'tms',
            ],

            [
                'name' => 'update_training_courses',
                'label' => 'Update Course',
                'module' => 'tms',
            ],

            [
                'name' => 'delete_training_courses',
                'label' => 'Delete Course',
                'module' => 'tms',
            ],

            [
                'name' => 'view_training_course_module_batch_session_schedules',
                'label' => 'List Session Schedule',
                'module' => 'tms',
            ],

            [
                'name' => 'add_training_course_module_batch_session_schedules',
                'label' => 'Create Session Schedule',
                'module' => 'tms',
            ],

            [
                'name' => 'update_training_course_module_batch_session_schedules',
                'label' => 'Update Session Schedule',
                'module' => 'tms',
            ],

            [
                'name' => 'delete_training_course_module_batch_session_schedules',
                'label' => 'Delete Session Schedule',
                'module' => 'tms',
            ],
            [
                'name' => 'view_tms_calendar',
                'label' => 'View Training calendar',
                'module' => 'tms',
            ],
            [
                'name' => 'admin-access',
                'label' => 'admin-access',
                'module' => 'tms',
            ],
            [
                'name' => 'accounts-access',
                'label' => 'accounts-access',
                'module' => 'hrm',
            ],
            [
                'name' => 'medical-phamacist-access',
                'label' => 'medical-phamacist-access',
                'module' => 'tms',
            ],
            [
                'name' => 'medical-doctor-access',
                'label' => 'medical-doctor-access',
                'module' => 'tms',
            ],
            [
                'name' => 'cafeteria-access',
                'label' => 'cafeteria-access',
                'module' => 'cafeteria',
            ],
            [
                'name' => 'hm-access',
                'label' => 'hm-access',
                'module' => 'hm',
            ],
            [
                'name' => 'admin-hm-access',
                'label' => 'admin-hm-access',
                'module' => 'hm',
            ],
            [
                'name' => 'hrm-access',
                'label' => 'hrm-access',
                'module' => 'hrm',
            ],
            [
                'name' => 'hrm-user-access',
                'label' => 'hrm-user-access',
                'module' => 'hrm',
            ],
            [
                'name' => 'vms-access',
                'label' => 'vms-access',
                'module' => 'vms',
            ],
            [
                'name' => 'tms-access',
                'label' => 'tms-access',
                'module' => 'tms',
            ],
            [
                'name' => 'ims-access',
                'label' => 'ims-access',
                'module' => 'ims',
            ],
            [
                'name' => 'ims-dashboard-content-access',
                'label' => 'ims-dashboard-content-access',
                'module' => 'ims',
            ],
            [
                'name' => 'tms-menu-access',
                'label' => 'tms-menu-access',
                'module' => 'tms',
            ],
            [
                'name' => 'hm-menu-access',
                'label' => 'hm-menu-access',
                'module' => 'hm',
            ],
            [
                'name' => 'tms-department-menu-access',
                'label' => 'tms-department-menu-access',
                'module' => 'tms',
            ],
            [
                'name' => 'tms-department-course-administration-menu-access',
                'label' => 'tms-department-course-administration-menu-access',
                'module' => 'tms',
            ],
            [
                'name' => 'tms-access-medical',
                'label' => 'tms-access-medical',
                'module' => 'tms',
            ],
            [
                'name' => 'cafeteria-menu-access',
                'label' => 'cafeteria-menu-access',
                'module' => 'cafeteria',
            ],
            [
                'name' => 'guest_access',
                'label' => 'guest_access',
                'module' => 'tms',
            ],

        ];
    }
}
