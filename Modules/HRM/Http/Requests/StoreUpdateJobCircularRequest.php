<?php

namespace Modules\HRM\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Modules\HRM\Rules\SalaryRange;

class StoreUpdateJobCircularRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //$maxYear = Carbon::today()->subYears(18)->format('Y');
        //$minYear = Carbon::today()->subYears(50)->format('Y');

        //$minMaxYearValidation = "date_format:Y|after_or_equal:$minYear|before_or_equal:$maxYear";

        return [
            'title' => 'required|min:10|max:100',
            'vacancy_no' => 'required|min:1|max:30',
            'job_nature' => 'required',
            'salary' => ['nullable', new SalaryRange],
            'salary_grade' => 'required',
            'designation_id' => 'required',
            'reference_number' => 'required|max:50|min:1',
            'application_deadline' => 'required',
            'job_location' => 'required|max:50',
            'educational_requirement' => 'required|max:1000',
            'experience_requirement' => 'required|max:1000',
            'job_responsibility' => 'required|max:1000',
            'other_requirements' => 'required|max:1000',
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
}
