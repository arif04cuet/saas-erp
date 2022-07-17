<?php

namespace App\Policies;

use App\Entities\User;
use App\Entities\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;
    const MODEL = 'User';

    /**
     * Determine whether the user can view the role.
     *
     * @param  \App\Entities\User  $user
     * @param  \App\Entities\Role  $role
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermission('viewAny', self::MODEL);
    }

    public function view(User $user)
    {
        return $user->hasPermission('view', self::MODEL);
    }

    /**
     * Determine whether the user can create users.
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
    public function update(User $user, Role $role)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the role.
     *
     * @param  \App\Entities\User  $user
     * @param  \App\Entities\Role  $role
     * @return mixed
     */
    public function delete(User $user, Role $role)
    {
        // return $user->hasAnyRole(['ROLE_DIRECTOR_GENERAL', 'ROLE_DIRECTOR_TRAINING']);
        return true;
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
        return $user->hasAnyRole(['ROLE_DIRECTOR_GENERAL', 'ROLE_DIRECTOR_TRAINING']);
    }

    public function before($user, $ability)
    {
        if ($user->hasRole('ROLE_SUPER_ADMIN')) {
            return true;
        }
    }
}
