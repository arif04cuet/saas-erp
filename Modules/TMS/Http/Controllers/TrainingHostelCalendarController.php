<?php

namespace Modules\TMS\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\TMS\Services\TrainingHostelCalenderService;
use Modules\TMS\Entities\Training;

class TrainingHostelCalendarController extends Controller
{
    /**
     * @var TrainingHostelCalenderService
     */
    private $service;

    /**
     * TrainingHostelCalendarController constructor.
     * @param TrainingHostelCalenderService $service
     */
    public function __construct(TrainingHostelCalenderService $service)
    {
        $this->service = $service;
    }


    public function show()
    {
        $hostels = $this->service->getHostelsForDropdown();
        $trainings = Training::all()->pluck('title', 'id');
        return view('tms::training.hostel.calendar.show', compact('hostels',
                'trainings'
            )
        );
    }

    public function getData(Training $training)
    {
        return $this->service->getDataForCalender($training);
    }
}
