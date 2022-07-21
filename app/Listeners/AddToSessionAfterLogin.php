<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AddToSessionAfterLogin
{

    public function handle(Login $event)
    {
        $user = $event->user;
        if ($doptor = $user->doptor) {

            $doptorData = [
                'id' => $doptor->id,
                'name_bng' => $doptor->name_bng,
                'name_eng' => $doptor->name_eng,
            ];
            session()->put('user_doptor', $doptorData);
        }
    }
}
