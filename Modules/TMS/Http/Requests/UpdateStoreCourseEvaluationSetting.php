<?php

namespace Modules\TMS\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Modules\TMS\Entities\TrainingCourse;

class UpdateStoreCourseEvaluationSetting extends FormRequest
{
    private $httpRequest;
    /**
     * @param Request $request
     * @return array
     */
    public function rules(Request $request)
    {
        $this->httpRequest = $request;
        $courseStartDate = $this->getCourseStartDate($this->httpRequest);

        return [
            'status' => 'nullable',
            'start_date' => 'date_format:d/m/Y|required_with:status' . $this->getAfterOrEqual(),
            'end_date' => 'date_format:d/m/Y|required_with:status' . $this->getAfterOrEqual('end_date'),
        ];
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
        $courseStartDate = $this->getCourseStartDate($this->httpRequest);
        $startDate = $this->request->get('start_date');
        $endDate = $this->request->get('end_date');

        return [
            'start_date.after_or_equal' => trans(
                'tms::course_evaluation.settings.errors.fields.start_date.after_or_equal',
                [
                    'attribute' => $courseStartDate
                ]
            ),
            'end_date.after_or_equal' => trans(
                'tms::course_evaluation.settings.errors.fields.end_date.after_or_equal',
                [
                    'attribute' => $this->compareDates($startDate, $endDate) ? $startDate : $courseStartDate
                ]
            ),
        ];
    }

    private function getCourseStartDate($request)
    {
        $courseStartDate = Carbon::today()->format('d/m/Y');

        $course = $request->course;

        if (optional($course)->start_date) {
            $courseStartDate = Carbon::parse($course->start_date)->format('d/m/Y');
        }

        return $courseStartDate;
    }

    private function getAfterOrEqual($key = "")
    {
        $rule = '';
        $startDate = $this->request->get('start_date');
        $endDate = $this->request->get('end_date');

        if($this->request->has('status')) {
            $rule .= ($key == 'end_date' ? ($this->compareDates($startDate, $endDate) ? '|after_or_equal:' . $startDate : '') : '');
            $rule .= '|after_or_equal:' . $this->getCourseStartDate($this->httpRequest);
        }

        return $rule;
    }

    private function compareDates($startDate, $endDate)
    {
        $comparingStartDate = Carbon::createFromFormat('d/m/Y', $startDate);
        $comparingEndDate = Carbon::createFromFormat('d/m/Y', $endDate);

        return $comparingEndDate->lessThan($comparingStartDate) ?: false;
    }
}
