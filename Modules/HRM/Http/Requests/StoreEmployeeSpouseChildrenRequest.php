<?php

namespace Modules\HRM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreEmployeeSpouseChildrenRequest extends FormRequest
{
    protected $errorBag = "spouseChildrenError";
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        $this->redirect = '/hrm/employee/create?employee=' . $request->employee_id . '#spouse-children';

        $null = null;

        return [
            'employee_id' => 'required',
            'spouse.date_of_birth' => 'different:' . $null
        ];
    }

    public function messages()
    {
        return [
            'employee_id.required' => trans('hrm::employee.employee_id_validation'),
            'spouse.date_of_birth.required' => trans('hrm::employee.employee_id_validation'),
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
