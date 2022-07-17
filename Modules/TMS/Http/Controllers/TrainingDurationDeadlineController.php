<?php

namespace Modules\TMS\Http\Controllers;

use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Modules\TMS\Entities\Training;
use Modules\TMS\Http\Requests\UpdateDurationDeadlineRequest;
use Modules\TMS\Services\TrainingsService;

class TrainingDurationDeadlineController extends Controller
{

    /**
     * @var TrainingsService
     */
    private $trainingsService;

    public function __construct(TrainingsService $trainingsService)
    {
        $this->trainingsService = $trainingsService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('tms::index');
    }

    /**
     * Show the form for creating a new resource.
     * @param Training $training
     * @return Response
     */
    public function create(Training $training)
    {
        return view('tms::training.duration.create', compact('training'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param Training $training
     * @return Factory|Application|View
     */
    public function show(Training $training)
    {
        $trainingStatus = $this->trainingsService->getStatus($training);
        return view('tms::training.duration.show', compact('training', 'trainingStatus'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param Training $training
     * @return Factory|Application|View
     */
    public function edit(Training $training)
    {
        $trainingStatus = $this->trainingsService->getStatus($training);
        return view('tms::training.duration.edit', compact('training', 'trainingStatus'));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateDurationDeadlineRequest $request
     * @param Training $training
     * @return RedirectResponse
     */
    public function update(UpdateDurationDeadlineRequest $request, Training $training)
    {
        try {
            $trainingStatus = $this->trainingsService->getStatus($training);
            // if ($trainingStatus != \Modules\TMS\Entities\Training::getStatuses()['draft']
            //     && $trainingStatus != \Modules\TMS\Entities\Training::getStatuses()['upcoming']) {
            //     throw  new Exception(trans('tms::training.flash_messages.timeline_change'));
            // }
            $duration = $this->trainingsService->updateTrainingDurationDeadline($training, $request->all());
            if ($duration) {
                Session::flash('success', trans('labels.save_success'));
            } else {
                Session::flash('error', trans('labels.save_fail'));
            }
            return redirect()->route('training.durationDeadline.show', $training->id);

        } catch (Exception $exception) {
            Log::error($exception->getMessage() . " Trace: " . $exception->getTraceAsString());
            Session::flash('error', trans('tms::training.flash_messages.timeline_change'));
            return redirect()->route('training.durationDeadline.show', $training->id);
        }

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
