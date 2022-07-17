<?php

namespace Modules\HRM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\HRM\Entities\CalendarEvent;
use Modules\HRM\Services\CalendarEventService;

class CalendarEventController extends Controller
{

    private $calendarEventService;

    public function __construct(CalendarEventService $calendarEventService)
    {
        $this->calendarEventService = $calendarEventService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $calendarEvents = $this->calendarEventService->findAll();
        return view('hrm::calendar.event.index', compact('calendarEvents'));
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function getEvents()
    {
        return $this->calendarEventService->getEventsFormattedInFullCalendar();
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('hrm::calendar.event.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $calendarEvent = $this->calendarEventService->store($request->all());
        if ($calendarEvent) {
            Session::flash('success', trans('labels.save_success'));
        } else {
            Session::flash('error', trans('labels.save_fail'));
        }

        return redirect()->route('calendar-event.index');
    }

    /**
     * Show the specified resource.
     * @param CalendarEvent $calendarEvent
     * @return Response
     */
    public function show(CalendarEvent $calendarEvent)
    {
        return view('hrm::calendar.event.show', compact('calendarEvent'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param CalendarEvent $calendarEvent
     * @return Response
     */
    public function edit(CalendarEvent $calendarEvent)
    {
        return view('hrm::calendar.event.edit', compact('calendarEvent'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param CalendarEvent $calendarEvent
     * @return Response
     */
    public function update(Request $request, CalendarEvent $calendarEvent)
    {
        $calendarEvent = $this->calendarEventService->updateEvent($request->all(), $calendarEvent);
        if ($calendarEvent) {
            Session::flash('success', trans('labels.update_success'));
        } else {
            Session::flash('error', trans('labels.update_fail'));
        }

        return redirect()->route('calendar-event.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param CalendarEvent $calendarEvent
     * @return Response
     * @throws \Exception
     */
    public function destroy(CalendarEvent $calendarEvent)
    {
        $isDeleted = $calendarEvent->delete();

        if ($isDeleted) {
            Session::flash('success', trans('labels.delete_success'));
        } else {
            Session::flash('error', trans('labels.delete_fail'));
        }

        return redirect()->route('calendar-event.index');
    }
}
