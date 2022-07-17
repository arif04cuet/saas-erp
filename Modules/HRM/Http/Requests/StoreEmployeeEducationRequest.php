<?php

namespace Modules\HRM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreEmployeeEducationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected $errorBag = "educationError";

    public function rules(Request $request)
    {
        $this->redirect = '/hrm/employee/create?employee=' . $request->education[0]['employee_id'] . '#education';

        return [
            'education.*.academic_institute_id' => 'required',
            'education.*.other_institute_name' => 'nullable|max:300',
            'education.*.academic_department_id' => 'required',
            'education.*.other_department_name' => 'nullable|max:300',
            'education.*.academic_degree_id' => 'required',
            'education.*.other_degree_name' => 'nullable|max:300',
            'education.*.passing_year' => 'required|min:4|max:4',
            'education.*.duration' => 'required',
            'education.*.result' => 'required|max:300',
            'education.*.achievement' => 'nullable|max:300',
            'education.*.employee_id' => 'required',
            'employee_id' => 'required'
        ];

    }

    public function messages()
    {
        $messages = [
            'education.*.academic_institute_id.required' => 'Please enter institute name',
            'education.*.academic_department_id.required' => 'Please enter department name ',
            'education.*.academic_degree_id.required' => 'Please enter degree name ',
            'education.*.passing_year.required' => 'Please enter passing year ',
            'education.*.passing_year.min' => 'Passing year should be in 4 digits ',
            'education.*.passing_year.max' => 'Passing year should be in 4 digits ',
            'education.*.duration.required' => 'Please enter duration ',
            'education.*.result.required' => 'Please enter result ',
            'employee_id.required' => trans('hrm::employee.employee_id_validation'),

        ];

        return $messages;
    }


    public function authorize()
    {
        return true;
    }
}
