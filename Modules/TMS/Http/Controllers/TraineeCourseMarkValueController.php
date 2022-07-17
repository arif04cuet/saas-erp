<?php

namespace Modules\TMS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\TMS\Entities\Trainee;
use Illuminate\Routing\Controller;
use Modules\TMS\Entities\Training;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Modules\TMS\Entities\TrainingCourse;
use Modules\TMS\Services\TraineeService;
use Modules\TMS\Entities\TraineeCourseMarkValue;
use Modules\TMS\Services\TraineeCourseMarkValueService;
use Modules\TMS\Http\Requests\TraineeCourseMarkValueRequest;
use Modules\TMS\Services\TrainingCourseMarkAllotmentService;

class TraineeCourseMarkValueController extends Controller
{
    const MARK_VALUE_VIEW = 'tms::training.course.mark_value.';

    private $markAllotmentService;
    private $traineeService;
    private $markValueService;

    /**
     * TraineeCourseMarkValueController constructor.
     * @param TrainingCourseMarkAllotmentService $markAllotmentService
     * @param TraineeService $traineeService
     * @param TraineeCourseMarkValueService $markValueService
     */
    public function __construct(
        TrainingCourseMarkAllotmentService $markAllotmentService,
        TraineeService $traineeService,
        TraineeCourseMarkValueService $markValueService
    ) {
        $this->markAllotmentService = $markAllotmentService;
        $this->traineeService = $traineeService;
        $this->markValueService = $markValueService;
    }

    public function show(Training $training, TrainingCourse $course)
    {
        $markAllotmentTypeTitles = $this->markAllotmentService->getMarkAllotmentTypeTitles($course);
        $traineesWithMarks = $this->traineeService->getAllTraineesAchievedMarks($training, $course);
        // $gradeCals = $this->getCourseGradingInfo($course, $totalMark);

        return view(self::MARK_VALUE_VIEW . '.show', compact(
                'training',
                'course',
                'traineesWithMarks',
                'markAllotmentTypeTitles',
            )
        );
    }
    public function showMarkValueIndividual(Training $training, TrainingCourse $course, Trainee $trainee)
    {
        $achievedMarks = $this->traineeService->getTraineeAchievedMarkDetails($course, $trainee);
        $markAllotmentTypeTitles = $this->markAllotmentService->getMarkAllotmentTypeTitles($course);
        // dd($achievedMarks);
        return view(self::MARK_VALUE_VIEW . '.show_individual', compact(
                'training',
                'course',
                'trainee',
                'achievedMarks',
                'markAllotmentTypeTitles'
            )
        );
    }

    public static function getCourseGradingInfo(TrainingCourse $course, $totalMark)
    {
        $gradingInfos = $course->trainingCourseGrade->map(function ($gradingInfo) {
            return
                (object)[
                    'grading_mark' => $gradingInfo->grading_mark,
                    'grade' => $gradingInfo->grade,
                ];

        });

        $gradeItem =  $gradingInfos->filter(function($item) use($totalMark){
            $gradingMarks = explode('-',$item->grading_mark);
            return  $totalMark >= $gradingMarks[0]  && $totalMark <= $gradingMarks[1];
        });
        return $grade = $gradeItem->first()->grade ?? '';


    }

    public function getCourseGradingInfoTwo(Training $training, TrainingCourse $course)
    {
        $trainees = $training->trainee->map(function($trainee) use ($course){
            return $items = TraineeCourseMarkValue::where('trainee_id', $trainee->id)->where('training_course_id',$course->id)->sum('value');
        });
        foreach($trainees as $totalMark) {
            $gradingInfos = $course->trainingCourseGrade->map(function ($gradingInfo){
                return
                    (object)[
                        'grading_mark' => $gradingInfo->grading_mark,
                        'grade' => $gradingInfo->grade,
                    ];
    
            })->filter(function($item) use($totalMark){
                $gradingMarks = explode('-',$item->grading_mark);
                return  (int)$totalMark >= $gradingMarks[0]  && (int)$totalMark <= $gradingMarks[1];
            });
            return $grade = $gradingInfos->first()->grade;
        }
    }

    public function generateSample(Training $training, TrainingCourse $course)
    {
        $markAllotmentTypes = $this->markAllotmentService->getMarkAllotmentTypes($course);
        $traineesWithMarks = $this->traineeService->getAllTraineesAchievedMarks($training, $course);

        $this->markAllotmentService->generateXlsx($traineesWithMarks, $markAllotmentTypes);

        $file = public_path() . "/files/mark_value_import_sample.xls";

        return \response()->download($file, 'mark_value_import_sample.xls');

    }

    public function import(Request $request, $courseId)
    {
        $file_mimes = array(
            'text/x-comma-separated-values',
            'text/comma-separated-values',
            'application/octet-stream',
            'application/vnd.ms-excel',
            'application/x-csv',
            'text/x-csv',
            'text/csv',
            'application/csv',
            'application/excel',
            'application/vnd.msexcel',
            'text/plain',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'application/wps-office.xlsx'
        );

        $file = null;
        $errorList = array();
        if ($request->hasFile(['import_file']) && in_array($_FILES['import_file']['type'], $file_mimes)) {
            $marksValue = $this->markAllotmentService->importCSV($request);
            if (sizeof($marksValue) && !sizeof($errorList)) {
                $this->markAllotmentService->storeImported($marksValue, $courseId);
            }
        } else {
            Session::flash('error', trans('tms::training_course.mark_value_import_file_error'));
        }

        return Redirect::back();
    }

    public function edit(Training $training, TrainingCourse $course, Trainee $trainee)
    {
        $achievedMarks = $this->traineeService->getTraineeAchievedMarks($trainee, $course);

        return view(self::MARK_VALUE_VIEW . '.edit', compact('training',
                'course',
                'trainee',
                'achievedMarks'
            )
        );
    }

    public function update(
        TraineeCourseMarkValueRequest $request,
        Training $training,
        TrainingCourse $course,
        Trainee $trainee
    ) {
        if ($this->markValueService->updateRequest($course, $request->all())) {
            Session::flash('success', trans('labels.update_success'));
        } else {
            Session::flash('error', trans('labels.update_fail'));
        }

        return redirect()->route('trainees.courses.marks.values.show', [$training->id, $course->id]);
    }
}
