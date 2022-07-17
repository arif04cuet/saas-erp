<?php

namespace Modules\HRM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreEmployeePersonalInfoRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected $errorBag = 'PersonalInfo';
    protected $redirect;

    public function rules(Request $request)
    {
        $this->redirect = '/hrm/employee/create?employee=' . $request->employee_id . '#personal';

        return [
            'mother_name' => 'required|max:300',
            'employee_id' => 'required',
            'job_joining_date' => 'required',
            'date_of_birth' => 'required',
            'marital_status' => 'required',
            'husband_name' => 'required_without:father_name|max:300',
            'father_name' => 'required_without:husband_name|max:300',
            'nid_number' => 'required|digits_between:10,17',
            'total_salary' => 'nullable|numeric|between:1,9999999',
            'number_of_children' => 'nullable|numeric|min:1',
        ];
    }

    public function messages()
    {
        return [
            'husband_name.required_without' => 'You must input either Husband\'s name or Father\'s name',
            'father_name.required_without' => 'You must input either Father\'s name or Husband\'s name',
            'nid_number' => 'Wrong NID/Smart Card Number. Digits should be between 10 and 17',
            'employee_id.required' => trans('hrm::employee.employee_id_validation'),
            'total_salary.between' => trans('hrm::personal_info.total_salary_error_msg')
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
