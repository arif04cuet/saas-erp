<?php

namespace Modules\MMS\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PatientRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     * @param Request $request
     * @return string[]
     */
    public function rules(Request $request)
    {
        if ($this->method() == "PUT") {
            $id = $this->route()->parameters();
            return [
                'patient_id' => 'required|max:50|unique:patients,patient_id,' . $id['patient'],
                'name' => 'required|max:50',
                'age' => 'required|numeric|max:100|min:1',
                'mobile_no' => 'required',
                'gender' => 'required',
                'type' => 'required',
                'relation' => 'max:50'
            ];
        } else {
            return [
                'patient_id' => 'required|max:50|unique:patients,patient_id',
                'name' => 'required|max:50',
                'age' => 'required|numeric|max:100|min:1',
                'mobile_no' => 'required',
                'gender' => 'required',
                'type' => 'required',
                'relation' => 'max:50'
            ];
        }
    }

    /**
     * @return array
     */
    public function messages()
    {
        $messages = [
            'patient_id.unique' => trans('mms::patient.unique')
        ];

        return $messages;
    }

    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
