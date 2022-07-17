<?php

namespace Modules\MMS\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PrescriptionRequest extends FormRequest
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
//                'patient_id' => 'required|max:50',
//                'name' => 'required|max:50',
//                'age' => 'required|numeric|max:100',
//                'mobile_no' => 'required',
//                'gender' => 'required',
//                'type' => 'required',
//                'relation' => 'max:50',
                'acknowledgement_slip' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3072'
            ];
        } else {
            return [
                'patient_id' => 'required|max:50',
//                'name' => 'required|max:50',
//                'age' => 'required|numeric|max:100|min:1',
//                'mobile_no' => 'required',
//                'gender' => 'required',
//                'type' => 'required',
//                'relation' => 'max:50',
                'acknowledgement_slip' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3072'
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
