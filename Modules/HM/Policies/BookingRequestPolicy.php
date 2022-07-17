<?php

namespace Modules\HM\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class BookingRequestPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
}
