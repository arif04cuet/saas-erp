<?php

namespace Modules\TMS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\TMS\Entities\Training;
use Modules\TMS\Services\TrainingCourseModuleBatchSessionScheduleService;

class TrainingScheduleSessionController extends Controller
{
    private $trainingCourseModuleBatchSessionScheduleService;

    public function __construct(
        TrainingCourseModuleBatchSessionScheduleService $trainingCourseModuleBatchSessionScheduleService
    )
    {
        $this->trainingCourseModuleBatchSessionScheduleService = $trainingCourseModuleBatchSessionScheduleService;
    }

    /**
     * @param Training $training
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Training $training)
    {

        $scheduledSessions = $this->trainingCourseModuleBatchSessionScheduleService->scheduledSessions($training);

        $filters = $this->trainingCourseModuleBatchSessionScheduleService->filters($scheduledSessions);
        // dd($scheduledSessions, $filters);

        $filterKeys = array_column($filters->toArray(), 'key');
        $filterKeys = array_filter($filterKeys, function ($key) { return $key !== "training";});
        $filterKeys = array_values($filterKeys);

        return view(
            'tms::training.schedule.index',
            compact(
                'training',
                'scheduledSessions',
                'filters',
                'filterKeys'
            )
        );
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('tms::create');
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
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('tms::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('tms::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
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
