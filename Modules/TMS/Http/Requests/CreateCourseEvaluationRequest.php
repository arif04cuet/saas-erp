<?php

namespace Modules\TMS\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Modules\TMS\Entities\CourseEvaluationQuestionnaire;
use Modules\TMS\Entities\CourseEvaluationSubSection;

class CreateCourseEvaluationRequest extends FormRequest
{
    private $course;
    private $trainee;

    /**
     * @param Request $request
     * @return array
     */
    public function rules(Request $request)
    {
//        dd($request->all());
        $this->course = $request->course;
        $this->trainee = $request->trainee;

        return $this->buildRules();
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'questionnaires.*.required' => 'Select one of the values above',
            'questionnaires.*.max' => 'At most 500 characters',
        ];
    }

    private function buildRules()
    {
        $sections = $this->course->evaluationSections
            ->pluck('id')
            ->toArray();
//        dd($sections);
        $objectiveSectionId = $sections[0];
        unset($sections[0]); // just because the first one is the objective. So no need to retrieve the question from sub sections
//        $subSections = CourseEvaluationSubSection::whereIn('course_evaluation_section_id', $sections)
//            ->get()
//            ->pluck('id')
//            ->toArray();

//        $questionnaires = CourseEvaluationQuestionnaire::where('is_optional', false)
//            ->whereIn('course_evaluation_sub_section_id', $subSections)
//            ->get()
//            ->pluck('id')
//            ->toArray();
//
//        $textAreaQuestionnaires = CourseEvaluationQuestionnaire::where('type', 'textarea')
//            ->whereIn('course_evaluation_sub_section_id', $subSections)
//            ->get()
//            ->pluck('id')
//            ->toArray();

        $rules = [];

//        foreach ($questionnaires as $key => $questionnaire) {
//            $rules['questionnaires.' . $questionnaire] = 'required';
//        }

        // retrieving objective
        $objectiveSubSections = CourseEvaluationSubSection::whereIn('course_evaluation_section_id', [$objectiveSectionId])
            ->get()
            ->pluck('id')
            ->toArray();

        foreach ($objectiveSubSections as $objectiveSubSectionId) {
            if (count($this->course->objectives) > 0) {
                foreach ($this->course->objectives as $key => $objective) {
                    $rules['objectives.' . $objective->id. '|'.$objectiveSubSectionId] = 'required';
                }
            }
        }


//        foreach ($textAreaQuestionnaires as $key => $questionnaire) {
//            $rules['questionnaires.' . $questionnaire] = 'max:500';
//        }
//        dd($rules);
        return $rules;
    }
}
