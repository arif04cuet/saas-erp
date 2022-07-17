<?php

namespace Modules\HRM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\TMS\Services\TrainingsService;

class HRMTrainingController extends Controller
{
    private $trainingService;

    public function __construct(TrainingsService $trainingService)
    {
        $this->trainingService = $trainingService;
    }

    public function index($selectedTrainingId = null)
    {
        $trainings = $this->trainingService->findAll();
        $trainees = $selectedTrainingId? $this->trainingService->findOne($selectedTrainingId)->trainee : null;

        return view('hrm::training.index', compact('selectedTrainingId', 'trainings', 'trainees'));
    }

    public function create()
    {
        $trainings = $this->trainingService->findAll();

        return view('hrm::training.create', compact('trainings'));
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return view('hrm::show');
    }

    public function edit($id)
    {
        return view('hrm::edit');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
