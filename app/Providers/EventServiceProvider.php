<?php

namespace App\Providers;

use App\Events\InvitationSent;
use App\Events\NotifyCourseAdministration;
use App\Listeners\NotifyCourseAdministrationListener;
use App\Listeners\SendProposalInvitationEmailNotificaiton;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\HRM\Events\CalendarEventPosted;
use Modules\HRM\Listeners\NotifyEmployeesOfCalendarEvent;
use App\Events\MedicalInventory;
use App\Listeners\AddToSessionAfterLogin;
use App\Listeners\ClearSessionAfterLogout;
use App\Listeners\MedicalInventoryListener;
use App\Models\Doptor;
use App\Observers\DoptorObserver;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'App\Events\NotificationGeneration' => [
            'App\Listeners\SendNotification',
        ],
        InvitationSent::class => [
            SendProposalInvitationEmailNotificaiton::class
        ],

        'App\Events\MedicalRequisitionReceived' => [
            'App\Listeners\MedicalRequisitionReceiveListener'
        ],
        CalendarEventPosted::class => [
            NotifyEmployeesOfCalendarEvent::class
        ],
        NotifyCourseAdministration::class => [
            NotifyCourseAdministrationListener::class
        ],
        Login::class => [
            AddToSessionAfterLogin::class
        ],
        Logout::class => [
            ClearSessionAfterLogout::class
        ]
    ];

    protected $observers = [
        Doptor::class => [
            DoptorObserver::class
        ]
    ];


    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
