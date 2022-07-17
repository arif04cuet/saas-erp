<?php

namespace Modules\TMS\Policies;

use App\Entities\User;
use App\Entities\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class TrainingVenuePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        //
    }

    public function view(User $user)
    {
        return true;
        //return false;
    }

    /**
     * Determine whether the user can create roles.
     *
     * @param \App\Entities\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
        //return true;
    }

    /**
     * Determine whether the user can update the role.
     *
     * @param \App\Entities\User $user
     * @param \App\Entities\Role $role
     * @return mixed
     */
    public function update(User $user, Role $role)
    {
        return true;
        //return true;
    }

    /**
     * Determine whether the user can delete the role.
     *
     * @param \App\Entities\User $user
     * @param \App\Entities\Role $role
     * @return mixed
     */
    public function delete(User $user, Role $role)
    {
        // return $user->hasAnyRole(['ROLE_DIRECTOR_GENERAL', 'ROLE_DIRECTOR_ADMIN', 'ROLE_DIRECTOR_TRAINING']);
        return true;
    }

    /**
     * Determine whether the user can restore the role.
     *
     * @param \App\Entities\User $user
     * @param \App\Entities\Role $role
     * @return mixed
     */
    public function restore(User $user, Role $role)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the role.
     *
     * @param \App\Entities\User $user
     * @param \App\Entities\Role $role
     * @return mixed
     */
    public function forceDelete(User $user, Role $role)
    {
        // return $user->hasAnyRole(['ROLE_DIRECTOR_GENERAL', 'ROLE_DIRECTOR_ADMIN', 'ROLE_DIRECTOR_TRAINING']);
        return true;
    }

    public function before(User $user)
    {
        // dd('hi');
        return $user->hasAnyRole([
            'ROLE_DIRECTOR_GENERAL',
            'ROLE_DIRECTOR_ADMIN',
            'ROLE_DIRECTOR_TRAINING',
            'ROLE_FACULTY'
        ]);
    }

}
