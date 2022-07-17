<?php

namespace App\Listeners;

use App\Events\Logout;
use Illuminate\Auth\Events\Logout as EventsLogout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ClearSessionAfterLogout
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\Logout  $event
     * @return void
     */
    public function handle(EventsLogout $event)
    {
        session()->forget('user_doptor');
    }
}
