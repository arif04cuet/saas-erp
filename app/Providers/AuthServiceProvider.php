<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Constants\DepartmentShortName;
use Illuminate\Support\Facades\Config;
use Modules\TMS\Policies\TraineePolicy;
use Modules\TMS\Traits\MenuAccessTrait;
use Modules\TMS\Policies\TrainingPolicy;
use Modules\TMS\Policies\TrainingVenuePolicy;
use Modules\TMS\Entities\Trainee;
use Modules\TMS\Entities\Training;
use App\Policies\RolePolicy;
use App\Policies\UserPolicy;
use App\Entities\Role;
use App\Entities\Permission;
use App\Models\Module;
use App\Models\SpatiePermission;
use App\Policies\ModulePolicy;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class AuthServiceProvider extends ServiceProvider
{
    use MenuAccessTrait;

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Role::class => RolePolicy::class,
        Module::class => ModulePolicy::class,
        User::class => UserPolicy::class,
        Training::class => TrainingPolicy::class,
        TrainingVenue::class => TrainingVenuePolicy::class,
        Trainee::class => TrainingPolicy::class,
    ];


    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $this->defineGates();

        $this->addAllPermissions();
    }

    public function rolePermission()
    {

        // $roleArr = auth()->user()->roles->map(function($role){
        //     $permissions = $role->permissions->pluck('name', 'id')->toArray();
        //     foreach($permissions as $key => $permission){
        //         return $roleAction[] = $permission;
        //     }
        // });
        $roleAction = [];
        $roleArr = auth()->user()->roles->pluck('name', 'id');
        foreach ($roleArr as $role) {
            $result = Role::where('name', $role)->first();
            $permissionArr = $result->permissions->pluck('name', 'id')->toArray();
            foreach ($permissionArr as $key => $permission) {
                $roleAction[] = $permission;
            }
        }
        return $roleAction;
    }

    public function defineGates()
    {

        Gate::define('admin-access', function ($user) {
            return $user->hasRole('ROLE_DIRECTOR_ADMIN');
        });

        Gate::define('accounts-access', function ($user) {
            if ($user->hasAnyRole(['ROLE_MINISTRY'])) {
                return false;
            }
            return $user->hasRole(['ROLE_DIRECTOR_ADMIN']);
        });
        Gate::define('medical-phamacist-access', function ($user) {
            if ($user->hasAnyRole(['ROLE_PHARMACIST'])) {
                return true;
            } else {
                return false;
            }
        });

        Gate::define('medical-doctor-access', function ($user) {
            if ($user->hasAnyRole(['ROLE_DOCTOR'])) {
                // return false;
                return true;
            } else {
                return false;
            }
            // return $user->hasRole(['ROLE_DIRECTOR_ADMIN']);
        });

        Gate::define('cafeteria-access', function ($user) {
            if ($user->hasAnyRole(['ROLE_PRESS_USER'])) {
                return false;
            }

            return true;
        });

        Gate::define('hm-access', function ($user) {
            return $user->hasAnyRole([
                'ROLE_DIRECTOR_GENERAL',
                'ROLE_DIRECTOR_ADMIN',
                'ROLE_HOSTEL_MANAGER',
                'ROLE_DIRECTOR_TRAINING'
            ]);
        });

        Gate::define('admin-hm-access', function ($user) {
            return $user->hasAnyRole(['ROLE_DIRECTOR_GENERAL', 'ROLE_DIRECTOR_ADMIN', 'ROLE_DIRECTOR_TRAINING']);
        });

        Gate::define('hrm-access', function ($user) {
            if ($user->hasAnyRole(['ROLE_MINISTRY']) || $user->hasAnyRole(['ROLE_PRESS_USER'])) {
                return false;
            }
            return true;
            //return $user->hasAnyRole(['ROLE_DIRECTOR_GENERAL', 'ROLE_DIRECTOR_ADMIN']);
        });

        Gate::define('hrm-user-access', function ($user) {
            return $user->hasAnyRole(['ROLE_DIRECTOR_GENERAL', 'ROLE_DIRECTOR_ADMIN', 'ROLE_HRM_USER']);
        });

        Gate::define('vms-access', function ($user) {
            if ($user->hasAnyRole(['ROLE_PRESS_USER'])) {
                return false;
            }

            return true;
            //return $user->hasAnyRole(['ROLE_DIRECTOR_GENERAL', 'ROLE_DIRECTOR_ADMIN']);
        });

        Gate::define('publication-access', function ($user) {
            return true;
            //return $user->hasAnyRole(['ROLE_DIRECTOR_GENERAL', 'ROLE_DIRECTOR_ADMIN']);
        });

        Gate::define('mms-access', function ($user) {
            if ($user->hasAnyRole(['ROLE_PRESS_USER'])) {
                return false;
            }

            return true;
            //return $user->hasAnyRole(['ROLE_DIRECTOR_GENERAL', 'ROLE_DIRECTOR_ADMIN']);
        });

        Gate::define('admin-vms-trip-approve', function ($user) {
            return $user->hasAnyRole(['ROLE_DIRECTOR_GENERAL', 'ROLE_DIRECTOR_ADMIN', 'ROLE_VMS_LINE_MANAGER']);
        });
        Gate::define('admin-vms-fuel-bill-approve', function ($user) {
            return $user->hasAnyRole(['ROLE_DIRECTOR_GENERAL', 'ROLE_DIRECTOR_ADMIN', 'ROLE_VMS_LINE_MANAGER']);
        });

        Gate::define('admin-vms-maintenance-requisition-approve', function ($user) {
            return $user->hasAnyRole([
                'ROLE_DIRECTOR_GENERAL',
                'ROLE_DIRECTOR_ADMIN',
                'ROLE_VMS_MECHANIC',
                'ROLE_VMS_LINE_MANAGER'
            ]);
        });


        Gate::define('pms-access', function ($user) {
            return $user->hasAnyRole([
                'ROLE_DIRECTOR_ADMIN',
                'ROLE_DIRECTOR_GENERAL',
                'ROLE_DIRECTOR_PROJECT',
                'ROLE_FACULTY'
            ]);
        });

        Gate::define('rms-access', function ($user) {
            return $user->hasAnyRole([
                'ROLE_DIRECTOR_ADMIN',
                'ROLE_DIRECTOR_GENERAL',
                'ROLE_RESEARCH_DIRECTOR',
                'ROLE_FACULTY'
            ]);
        });

        Gate::define('tms-access', function ($user) {
            return $user->hasAnyRole([
                'ROLE_DIRECTOR_ADMIN',
                'ROLE_DIRECTOR_TRAINING',
                'ROLE_DIRECTOR_GENERAL',
                'ROLE_FACULTY',
            ]);
        });

        Gate::define('ims-access', function ($user) {
            if ($user->hasAnyRole(['ROLE_PRESS_USER'])) {
                return false;
            }

            return true;
        });

        Gate::define('ims-dashboard-content-access', function ($user) {

            return $user->hasAnyRole(['ROLE_DIRECTOR_GENERAL']) || (!is_null($user->employee) && ($user->employee->employeeDepartment->short_code == DepartmentShortName::InventoryDivision));
        });

        Gate::define('tms-menu-access', function ($user) {
            $this->can = false;
            $this->isDirector($user);
            $this->isTrainingDivisionEmployee($user);
            $this->isTrainingCourseAdministrator($user);
            $this->isTrainingCourseResource($user);

            return $this->can;
        });

        Gate::define('hm-menu-access', function ($user) {
            return true;
        });

        Gate::define('tms-department-menu-access', function ($user) {
            $this->can = false;
            $this->isDirector($user);
            $this->isTrainingDivisionEmployee($user);
            $this->isTrainingCourseAdministrator($user);
            $this->isTrainingCourseResource($user);
            return $this->can;
        });

        Gate::define('tms-department-course-administration-menu-access', function ($user) {
            $this->can = false;
            $this->isDirector($user);
            $this->isTrainingDivisionEmployee($user);
            $this->isTrainingCourseAdministrator($user);
            $this->isTrainingCourseResource($user);
            return $this->can;
        });

        Gate::define('tms-access-medical', function ($user) {

            if ($user->employee->designation_id == 42) {
                return true;
            } else {
                return false;
            }
        });

        Gate::define('cafeteria-menu-access', function ($user) {

            $cafeteriaRoles = [
                Config::get('constants.cafeteria.roles.cafeteria_manager'),
                Config::get('constants.cafeteria.roles.cafeteria_user')
            ];

            return $user->hasAnyRole($cafeteriaRoles);
        });

        Gate::define('publication-menu-access', function ($user) {

            $publicationRoles = [
                Config::get('constants.publication.roles.publication_committee'),
                Config::get('constants.publication.roles.publication_section_officer'),
                'ROLE_DIRECTOR_ADMIN'
            ];

            return $user->hasAnyRole($publicationRoles);
        });

        Gate::define('guest_access', function ($user) {
            if ($user->hasAnyRole(['ROLE_PRESS_USER'])) {
                return false;
            }

            return true;
        });

        Gate::before(function ($user, $ability) {
            
            if ($user->isSuperAdmin()) {
                return true;
            }
        });
    }

    public function addAllPermissions()
    {
        if (Schema::hasTable((new SpatiePermission)->getTable())) {

            $allPermissions = SpatiePermission::allPermissions();

            $modules = Module::get()->pluck('slug', 'id')->toArray();
            $allPermissions = collect($allPermissions)
                ->filter(function ($permision) use ($modules) {
                    return array_search($permision['module'], $modules);
                })
                ->map(function ($permision) use ($modules) {
                    $permision['module_id'] = array_search($permision['module'], $modules);
                    $permision['guard_name'] = 'web';
                    unset($permision['module']);
                    return $permision;
                })
                ->toArray();

            SpatiePermission::upsert($allPermissions, ['name', 'guard_name', 'module_id']);
        }
    }
}
