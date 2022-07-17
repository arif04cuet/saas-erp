<?php

namespace Modules\TMS\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Routing\Controller;
use Modules\HM\Services\HostelService;
use Modules\TMS\Entities\Training;
use Modules\TMS\Services\TrainingsService;

class TrainingPreparationController extends Controller
{
    /**
     * @var TrainingsService
     */
    private $trainingsService;
    /**
     * @var HostelService
     */
    private $hostelService;

    /**
     * TrainingPreparationController constructor.
     * @param TrainingsService $trainingsService
     * @param HostelService $hostelService
     */
    public function __construct(TrainingsService $trainingsService, HostelService $hostelService)
    {
        $this->trainingsService = $trainingsService;
        $this->hostelService = $hostelService;
    }

    public function index()
    {
        $trainings = $this->trainingsService->getTrainingsBasedOnDate(Carbon::today());

        return view('tms::training.preparation.index', compact('trainings'));
    }

    public function hostel(Training $training)
    {
        $hostelDropDowns = $this->hostelService->findAll()->pluck('name', 'id');

        return view('tms::training.preparation.hostel.create', compact('training', 'hostelDropDowns'));
    }

    public function cafeteria(Training $training)
    {
        return view('tms::training.preparation.cafeteria.create', compact('training'));
    }

    public function venue(Training $training)
    {
        return view('tms::training.preparation.venue.create', compact('training'));
    }
}
