<?php

namespace Modules\HRM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateEmployeeEducationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected $errorBag = "educationError";

    public function rules(Request $request)
    {
        $this->redirect = 'hrm/employee/' . $request->education[0]['employee_id'] . '/edit#education';

        return [
            'education.*.academic_institute_id' => 'required',
            'education.*.other_institute_name' => 'nullable|max:300',
            'education.*.academic_department_id' => 'required',
            'education.*.other_department_name' => 'nullable|max:300',
            'education.*.academic_degree_id' => 'required',
            'education.*.other_degree_name' => 'nullable|max:300',
            'education.*.passing_year' => 'required',
            'education.*.duration' => 'required',
            'education.*.result' => 'required|max:300',
            'education.*.achievement' => 'nullable|max:300',
        ];

    }

    public function messages()
    {
        $messages = [
            'education.*.academic_institute_id.required' => 'Please enter institute name',
            'education.*.academic_department_id.required' => 'Please enter department name ',
            'education.*.academic_degree_id.required' => 'Please enter degree name ',
            'education.*.passing_year.required' => 'Please enter passing year ',
            'education.*.duration.required' => 'Please enter duration ',
            'education.*.result.required' => 'Please enter result ',
        ];

        return $messages;
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
