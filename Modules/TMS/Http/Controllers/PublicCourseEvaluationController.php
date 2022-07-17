<?php

namespace Modules\TMS\Http\Controllers;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\TMS\Services\TraineeService;
use Modules\TMS\Services\TrainingsService;
use Symfony\Component\Console\Input\Input;

class PublicCourseEvaluationController extends Controller
{
    /**
     * @var TraineeService
     */
    private $traineeService;
    /**
     * @var TrainingsService
     */
    private $trainingsService;

    /**
     * TrainingPublicController constructor.
     * @param TraineeService $traineeService
     * @param TrainingsService $trainingsService
     */
    public function __construct(TraineeService $traineeService, TrainingsService $trainingsService)
    {
        $this->traineeService = $traineeService;
        $this->trainingsService = $trainingsService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('tms::training.course.public.index');
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View|string
     */
    public function show(Request $request)
    {
        $mobileNo = $request->input('mobile-no');

        if (is_null($mobileNo)) {
            return 'Please provide the mobile number';
        }

        $isFoundTrainee = $this->traineeService->findBy(['mobile' => $mobileNo])->first();

        if ($isFoundTrainee)
        {
            $traineeCourses = $this->traineeService->coursesWithEvaluationSettings($mobileNo);
            return view('tms::training.course.public.show', compact('traineeCourses'));
        }else
        {
            return redirect()->back()->withErrors(['not_registered_trainee' => trans('error.not_registered_trainee')]);
        }
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
