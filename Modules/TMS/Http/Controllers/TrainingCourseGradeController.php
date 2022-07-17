<?php

namespace Modules\TMS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\TMS\Entities\Training;
use Modules\TMS\Entities\TrainingCourse;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Support\Renderable;
use Modules\TMS\Entities\TrainingCourseGrade;
use Modules\TMS\Services\TrainingCourseGradeService;
use Modules\TMS\Services\TrainingCourseMarkAllotmentTypeService;
use Modules\TMS\Services\TrainingsService;
use Modules\TMS\Services\TrainingCourseService;
use Modules\TMS\Http\Requests\TrainingCourseGradeRequest;

class TrainingCourseGradeController extends Controller
{
    const Training_course_grade_VIEW = 'tms::training.course.grade';
    /**
     * @var
     */
    private $trainingCourseGradeService;
    private $trainingService;
    private $trainingCourseService;
    private $trainingCourseMarkAllotmentTypeService;

    public function __construct(
        TrainingCourseGradeService $trainingCourseGradeService,
        TrainingsService $trainingService,
        TrainingCourseService $trainingCourseService,
        TrainingCourseMarkAllotmentTypeService $trainingCourseMarkAllotmentTypeService
    )
    {
        $this->trainingCourseGradeService = $trainingCourseGradeService;
        $this->trainingService = $trainingService;
        $this->trainingCourseService = $trainingCourseService;
        $this->trainingCourseMarkAllotmentTypeService = $trainingCourseMarkAllotmentTypeService;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('tms::index');
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
     * @param Request $request
     */
    public function store(TrainingCourseGradeRequest $request)
    {
        // if ($this->TrainingCourseGradeService->store($request->all())) {
        //     return redirect()->route('training.category.index')->with('success', trans('labels.save_success'));
        // } else {
        //     return redirect()->route('training.category.index')->with('error',
        //         trans('labels.save_fail'));
        // }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Training $training, TrainingCourse $course)
    {
        $courseGradeEditRoute = route('trainings.courses.grade.edit', [$training->id, $course->id]);
        // dd($course->trainingCourseGrade->grading_mark);
        return view(self::Training_course_grade_VIEW . '.show', compact('training', 'course', 'courseGradeEditRoute'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Training $training, TrainingCourse $course)
    {
        $courseGrades = $this->trainingCourseService->trainingCourseGrade($course);
        $costTypes = $this->trainingCourseMarkAllotmentTypeService->formattedDropdown();
        return view(
            self::Training_course_grade_VIEW . '.edit',
            compact(
                'courseGrades',
                'training',
                'course',
                'costTypes'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(TrainingCourseGradeRequest $request, Training $training, TrainingCourse $course, TrainingCourseGrade $grade)
    {
        // dd($request->input('course_grade'));
        if($this->trainingCourseGradeService->update($course, $request->input('course_grade'))) {
            Session::flash('success', trans('labels.update_success'));
        }else {
            Session::flash('error', trans('labels.update_fail'));
        }
        return redirect()->route('trainings.courses.grade.show', [$training->id, $course->id]);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
