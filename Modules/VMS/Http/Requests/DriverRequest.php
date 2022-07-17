<?php

namespace Modules\VMS\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DriverRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name_english' => 'required|max:500',
            'name_bangla' => 'required|max:500',
            'date_of_birth' => 'nullable',
            'address' => 'nullable',
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
        return [
            'title_english.required' => trans('labels.This field is required'),
            'name_bangla.required' => trans('labels.This field is required'),
            'name_english.max' => trans('labels.max_length_validation_message', ['length' => 500]),
            'name_bangla.max' => trans('labels.max_length_validation_message', ['length' => 500]),
        ];

    }


}
