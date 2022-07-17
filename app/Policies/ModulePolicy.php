<?php

namespace App\Policies;

use App\Entities\User;
use App\Entities\Role;
use App\Models\Module;
use Illuminate\Auth\Access\HandlesAuthorization;

class ModulePolicy
{
    use HandlesAuthorization;

    const MODEL = 'Module';

    public function viewAny(User $user)
    {
        return $user->hasPermission('viewAny', self::MODEL);
    }


    public function view(User $user)
    {
        return $user->hasPermission('view', self::MODEL);
    }

    /**
     * Determine whether the user can create roles.
     *
     * @param  \App\Entities\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermission('create', self::MODEL);
    }

    /**
     * Determine whether the user can update the role.
     *
     * @param  \App\Entities\User  $user
     * @param  \App\Entities\Role  $role
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->hasPermission('update', self::MODEL);
    }

    /**
     * Determine whether the user can delete the role.
     *
     * @param  \App\Entities\User  $user
     * @param  \App\Entities\Role  $role
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->hasPermission('delete', self::MODEL);
    }

    /**
     * Determine whether the user can restore the role.
     *
     * @param  \App\Entities\User  $user
     * @param  \App\Entities\Role  $role
     * @return mixed
     */
    public function restore(User $user, Role $role)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the role.
     *
     * @param  \App\Entities\User  $user
     * @param  \App\Entities\Role  $role
     * @return mixed
     */
    public function forceDelete(User $user, Role $role)
    {
        return true;
    }


    public function before($user, $ability)
    {
        // if ($user->hasRole('ROLE_SUPER_ADMIN')) {
        //     return true;
        // }
    }
}
