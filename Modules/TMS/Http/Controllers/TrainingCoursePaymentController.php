<?php

namespace Modules\TMS\Http\Controllers;

use Illuminate\Http\Request;
use Modules\TMS\Entities\Training;
use Modules\TMS\Entities\TrainingCourse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Support\Renderable;
use Modules\TMS\Services\TrainingCoursePaymentService;

class TrainingCoursePaymentController extends Controller
{
    const course_payment_view = 'tms::training.course.course_payment.';
     /**
     * @var TrainingCoursePaymentService
     */
    private $trainingCoursePaymentService;

    public function __construct(TrainingCoursePaymentService $trainingCoursePaymentService)
    {
        /** @var TrainingCoursePaymentService $trainingCoursePaymentService */
        $this->trainingCoursePaymentService = $trainingCoursePaymentService;
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
     * @param Trainee $trainee
     * @return Response
     */
    public function create(Training $training,TrainingCourse $course)
    {
        $member_names = ['1' => 'A', '2' => 'B', '3' => 'C'];
        return view('tms::training.course.course_payment.create', compact('training','course','member_names'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @param TrainingCourse $course
     * @return void
     */
    public function store(Request $request, Training $training, TrainingCourse $course)
    {
        $success = $this->trainingCoursePaymentService->storeTrainingCoursePaymentInfo($course, $request->all());
        if ($success){
            Session::flash('success', trans('labels.save_success'));
        }else{
            Session::flash('error', trans('labels.save_fail'));
        }
        return redirect()->route('trainings.courses.payment.show', [$training, $course]);
    }

    /**
     * Show the specified resource.
     * @param TrainingCourse $course
     * @return Response
     */
    public function show(Training $training,TrainingCourse $course)
    {
        $paymentEditRoute = route('trainings.courses.payment.edit', [$training->id, $course->id]);
        return view(self::course_payment_view.'show', compact('training','course','paymentEditRoute'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param TrainingCourse $course
     * @return Response
     */
    public function edit(Training $training,TrainingCourse $course)
    {
        $member_names = ['1' => 'A', '2' => 'B', '3' => 'C'];
        return view(self::course_payment_view.'edit', compact('training','course','member_names'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param TrainingCourse $course
     * @return void
     */
    public function update(Request $request, Training $training,TrainingCourse $course)
    {
        $success = $this->trainingCoursePaymentService->updateTrainingCoursePaymentInfo($course, $request->all());
        if ($success){
            Session::flash('success', trans('labels.save_success'));
        }else{
            Session::flash('error', trans('lables.save_error'));
        }
        return redirect()->route('trainings.courses.payment.show', [$training, $course]);
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
