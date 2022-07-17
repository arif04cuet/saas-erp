<?php

namespace Modules\HRM\Listeners;

use App\Entities\Notification\Notification;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Modules\HRM\Entities\MailNotification;
use Modules\HRM\Events\CalendarEventPosted;
use Modules\HRM\Services\EmployeeService;

class NotifyEmployeesOfCalendarEvent implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * @var EmployeeService
     */
    private $employeeService;

    /**
     * Create the event listener.
     *
     * @param EmployeeService $employeeService
     */
    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    /**
     * Handle the event.
     *
     * @param CalendarEventPosted $event
     * @return void
     */
    public function handle(CalendarEventPosted $event)
    {
        $calendarEvent = $event->calendarEvent;

        $this->employeeService->findAll()
            ->filter(function ($e) {
                return $e->user && !is_null(optional($e->user)->email);
            })
            ->each(function ($emp) use ($calendarEvent) {
                $startDate = Carbon::parse($calendarEvent->start)->format('d/m/Y');
                $endDate = Carbon::parse($calendarEvent->end)->format('d/m/Y');

                $message = "$calendarEvent->title starts: $startDate ends: $endDate";
                $url = route('calendar-event.show', $calendarEvent->id);

                Notification::create([
                    'type_id' => 1, // TODO: create CalendarEvent notification type
                    'ref_table_id' => $calendarEvent->id,
                    'from_user_id' => Auth::id(),
                    'to_user_id' => $emp->user->id,
                    'message' => $message,
                    'item_url' => $url
                ]);

                MailNotification::create([
                    'email' => optional($emp->user)->email ?? '',
                    'title' => $calendarEvent->title,
                    'message' => $message,
                    'item_url' => $url,
                ]);
            });
    }
}
