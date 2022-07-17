<?php

namespace Modules\HRM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreEmployeeTrainingRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected $errorBag = "trainingError";

    public function rules(Request $request)
    {
        $this->redirect = '/hrm/employee/create?employee=' . $request->training[0]['employee_id'] . '#training';

        return [
            'training.*.course_name' => 'required|max:300',
            'training.*.organization_name' => 'required|max:300',
            'training.*.duration' => 'required',
            'training.*.result' => 'required|max:300',
            'training.*.organization_country' => 'nullable|max:300',
            'training.*.organization_website' => 'nullable|max:300',
            'training.*.achievement' => 'nullable|max:300',
            'training.*.training_year' => 'min:4|max:4',
            'employee_id' => 'required',
            'training.*.category' => 'required|max:255',
            'training.*.region' => 'required',
            'training.*.nominating_authority' => 'required'
        ];
    }

    public function messages()
    {
        $messages = [
            'training.*.course_name.required' => 'Please enter course name',
            'training.*.organization_name.required' => 'Please enter organization name',
            'training.*.duration.required' => 'Please enter duration',
            'training.*.result.required' => 'Please enter result',
            'training.*.training_year.min' => 'Year should be in 4 digits',
            'training.*.training_year.max' => 'Year should be in 4 digits',
            'employee_id.required' => trans('hrm::employee.employee_id_validation'),
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
