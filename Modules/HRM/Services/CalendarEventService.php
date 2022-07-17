<?php


namespace Modules\HRM\Services;

use App\Traits\CrudTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Modules\HRM\Entities\MailNotification;
use Modules\HRM\Events\CalendarEventPosted;
use Modules\HRM\Repositories\CalendarEventRepository;
use Modules\HRM\Repositories\Employe;

class CalendarEventService
{
    use CrudTrait;

    private $calendarEventRepository;

    public function __construct(CalendarEventRepository $calendarEventRepository)
    {
        $this->calendarEventRepository = $calendarEventRepository;
        $this->setActionRepository($calendarEventRepository);
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            $data = $this->calculateEventDaysCount($data);

            $calendarEvent = $this->save($data);

            event(new CalendarEventPosted($calendarEvent));
            return $calendarEvent;
        });
    }

    public function updateEvent(array $data, $calendarEvent)
    {
        return DB::transaction(function () use ($data, $calendarEvent) {
            $data = $this->calculateEventDaysCount($data);

            $calendarEvent = $this->update($calendarEvent, $data);

            event(new CalendarEventPosted($calendarEvent));

            return $calendarEvent;
        });
    }

    public function getEventsFormattedInFullCalendar()
    {
        $data = [];
        $calendarEvents = $this->findAll();

        foreach ($calendarEvents as $calendarEvent) {
            array_push($data, [
                'title' => $calendarEvent->title,
                'start' => Carbon::parse($calendarEvent->start)->format('Y-m-d'),
                'end' => Carbon::parse($calendarEvent->end)->format('Y-m-d'),
                'url' => route('calendar-event.show', $calendarEvent->id),
            ]);
        }

        return $data;
    }

    public function getEvent($id)
    {
        return $this->findOne($id);
    }

    /**
     * @param Carbon $startDate
     * @param Carbon $endDate
     * @return mixed
     */
    public function getEventDaysCount(Carbon $startDate, Carbon $endDate): int
    {
        return $this->actionRepository->getModel()
            ->whereDate('start', '>=', $startDate)
            ->whereDate('end', '<=', $endDate)
            ->sum('days');
    }

    /**
     * @param array $data
     * @return array
     */
    public function calculateEventDaysCount(array $data): array
    {
        $data['start'] = Carbon::parse($data['start']);
        $data['end'] = Carbon::parse($data['end']);

        $data['days'] = $data['start']->diffInDays($data['end']);

        if ($data['days'] < 1) {
            $data['days'] = 1;
        } else {
            $data['days']++;
        }
        return $data;
    }
}
