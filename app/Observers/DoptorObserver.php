<?php

namespace App\Observers;

use App\Models\Doptor;
use App\Models\SpatieRole;

class DoptorObserver
{
    public $afterCommit = true;

    /**
     * Handle the Doptor "created" event.
     *
     * @param  \App\Models\Doptor  $doptor
     * @return void
     */
    public function created(Doptor $doptor)
    {
        //
    }

    /**
     * Handle the Doptor "updated" event.
     *
     * @param  \App\Models\Doptor  $doptor
     * @return void
     */
    public function updated(Doptor $doptor)
    {
    }

    /**
     * Handle the Doptor "updated" event.
     *
     * @param  \App\Models\Doptor  $doptor
     * @return void
     */
    public function saved(Doptor $doptor)
    {
        $this->addDefaultRoles($doptor);
    }

    /**
     * Handle the Doptor "deleted" event.
     *
     * @param  \App\Models\Doptor  $doptor
     * @return void
     */
    public function deleted(Doptor $doptor)
    {
        //
    }

    /**
     * Handle the Doptor "restored" event.
     *
     * @param  \App\Models\Doptor  $doptor
     * @return void
     */
    public function restored(Doptor $doptor)
    {
        //
    }

    /**
     * Handle the Doptor "force deleted" event.
     *
     * @param  \App\Models\Doptor  $doptor
     * @return void
     */
    public function forceDeleted(Doptor $doptor)
    {
        //
    }

    //helper functions
    public function addDefaultRoles($doptor)
    {
        $defaultsRoles = SpatieRole::defaultRoles();
        $roles = collect($defaultsRoles)
            ->map(function ($role) use ($doptor) {
                return [
                    'name' => $role,
                    'label' => $role,
                    'doptor_id' => $doptor->id,
                    'guard_name' => 'web'
                ];
            })
            ->toArray();

        SpatieRole::upsert($roles, ['name', 'guard_name', 'doptor_id']);
    }
}
